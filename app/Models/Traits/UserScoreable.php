<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\SearchResponse;
use App\Libraries\Search\BasicSearch;
use App\Models\Score\Best;

trait UserScoreable
{
    private $beatmapBestScoreIds = [];

    public function aggregatedScoresBest(string $mode, int $size): SearchResponse
    {
        $index = config('osu.elasticsearch.prefix')."high_scores_{$mode}";

        $search = new BasicSearch($index, "aggregatedScoresBest_{$mode}");
        $search->connectionName = 'scores';
        $search
            ->size(0) // don't care about hits
            ->query(
                (new BoolQuery())
                    ->filter(['term' => ['user_id' => $this->getKey()]])
            )
            ->setAggregations([
                'by_beatmaps' => [
                    'terms' => [
                        'field' => 'beatmap_id',
                        // sort by sub-aggregation max_pp, with score_id as tie breaker
                        'order' => [['max_pp' => 'desc'], ['min_score_id' => 'asc']],
                        'size' => $size,
                    ],
                    'aggs' => [
                        'top_scores' => [
                            'top_hits' => [
                                'size' => 1,
                                'sort' => [['pp' => ['order' => 'desc']]],
                            ],
                        ],
                        // top_hits aggregation is not useable for sorting, so we need an extra aggregation to sort on.
                        'max_pp' => ['max' => ['field' => 'pp']],
                        'min_score_id' => ['min' => ['field' => 'score_id']],
                    ],
                ],
            ]);

        $response = $search->response();
        if ($search->getError() !== null) {
            throw $search->getError();
        }

        return $response;
    }

    public function beatmapBestScoreIds(string $mode)
    {
        if (!isset($this->beatmapBestScoreIds[$mode])) {
            // aggregations do not support regular pagination.
            // always fetching 100 to cache; we're not supporting beyond 100, either.
            $this->beatmapBestScoreIds[$mode] = cache_remember_mutexed(
                "search-cache:beatmapBestScores:{$this->getKey()}:{$mode}",
                config('osu.scores.es_cache_duration'),
                [],
                function () use ($mode) {
                    // FIXME: should return some sort of error on error
                    $buckets = $this->aggregatedScoresBest($mode, 100)->aggregations('by_beatmaps')['buckets'] ?? [];

                    return array_map(function ($bucket) {
                        return array_get($bucket, 'top_scores.hits.hits.0._id');
                    }, $buckets);
                },
                function () {
                    // TODO: propagate a more useful message back to the client
                    // for now we just mark the exception as handled.
                    return true;
                }
            );
        }

        return $this->beatmapBestScoreIds[$mode];
    }

    public function beatmapBestScores(string $mode, int $limit, int $offset = 0, $with = [])
    {
        $ids = array_slice($this->beatmapBestScoreIds($mode), $offset, $limit);
        $clazz = Best\Model::getClassByString($mode);

        $results = $clazz::whereIn('score_id', $ids)->orderByField('score_id', $ids)->with($with)->get();

        // fill in positions for weighting
        // also preload the user relation
        $position = $offset;
        foreach ($results as $result) {
            $result->position = $position;
            $result->weight = pow(0.95, $position);
            $result->setRelation('user', $this);
            $position++;
        }

        return $results;
    }
}
