<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits;

use App\Libraries\Score\FetchDedupedScores;
use App\Libraries\Search\ScoreSearchParams;
use App\Models\Beatmap;
use App\Models\Solo\Score;
use Illuminate\Database\Eloquent\Collection;

trait UserScoreable
{
    private array $beatmapBestScoreIds = [];
    private array $beatmapBestScores = [];

    public function aggregatedScoresBest(string $mode, null | true $legacyOnly, int $size): array
    {
        return (new FetchDedupedScores('beatmap_id', ScoreSearchParams::fromArray([
            'exclude_without_pp' => true,
            'is_legacy' => $legacyOnly,
            'limit' => $size,
            'ruleset_id' => Beatmap::MODES[$mode],
            'sort' => 'pp_desc',
            'user_id' => $this->getKey(),
        ]), "aggregatedScoresBest_{$mode}"))->all();
    }

    public function beatmapBestScoreIds(string $mode, null | true $legacyOnly)
    {
        $key = $mode.'-'.($legacyOnly ? '1' : '0');

        if (!isset($this->beatmapBestScoreIds[$key])) {
            // aggregations do not support regular pagination.
            // always fetching 100 to cache; we're not supporting beyond 100, either.
            $this->beatmapBestScoreIds[$key] = cache_remember_mutexed(
                "search-cache:beatmapBestScoresSolo:{$this->getKey()}:{$key}",
                $GLOBALS['cfg']['osu']['scores']['es_cache_duration'],
                [],
                function () use ($key, $legacyOnly, $mode) {
                    $this->beatmapBestScores[$key] = $this->aggregatedScoresBest($mode, $legacyOnly, 100);

                    return array_column($this->beatmapBestScores[$key], 'id');
                },
                function () {
                    // TODO: propagate a more useful message back to the client
                    // for now we just mark the exception as handled.
                    return true;
                }
            );
        }

        return $this->beatmapBestScoreIds[$key];
    }

    public function beatmapBestScores(string $mode, int $limit, int $offset, array $with, null | true $legacyOnly): Collection
    {
        $ids = $this->beatmapBestScoreIds($mode, $legacyOnly);
        $key = $mode.'-'.($legacyOnly ? '1' : '0');

        if (isset($this->beatmapBestScores[$key])) {
            $results = new Collection(array_slice($this->beatmapBestScores[$key], $offset, $limit));
        } else {
            $ids = array_slice($ids, $offset, $limit);
            $results = Score::whereKey($ids)->orderByField('id', $ids)->default()->get();
        }

        $results->load($with);
        // make outdated index less obvious
        $results = $results->sortBy('pp');

        // fill in positions for weighting
        // also preload the user relation
        $position = $offset;
        foreach ($results as $result) {
            $result->weight = pow(0.95, $position);
            $result->setRelation('user', $this);
            $position++;
        }

        return $results;
    }
}
