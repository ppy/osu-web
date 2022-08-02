<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\RecordSearch;
use App\Models\Solo\Score;
use Ds\Set;
use Illuminate\Database\Eloquent\Collection;
use LaravelRedis;

class ScoreSearch extends RecordSearch
{
    public $connectionName = 'solo_scores';

    protected $source = false;

    public function __construct(?ScoreSearchParams $params = null)
    {
        parent::__construct(
            config('osu.elasticsearch.prefix').'solo_scores',
            $params ?? new ScoreSearchParams(),
            Score::class
        );
    }

    public function indexAll(string $schema): void
    {
        $queue = "osu-queue:score-index-{$schema}";
        $this->recordType::select('id')->chunkById(100, function (Collection $scores) use ($queue): void {
            LaravelRedis::lpush($queue, ...array_map(
                fn (Score $score): string => json_encode(['ScoreId' => $score->getKey()]),
                $scores->all(),
            ));
        });
    }

    public function setSchema(string $schema): void
    {
        LaravelRedis::set('osu-queue:score-index:'.config('osu.elasticsearch.prefix').'schema', $schema);
    }

    public function getQuery(): BoolQuery
    {
        $query = new BoolQuery();

        if ($this->params->rulesetId !== null) {
            $query->filter(['term' => ['ruleset_id' => $this->params->rulesetId]]);
        }
        if ($this->params->beatmapIds !== null && count($this->params->beatmapIds) > 0) {
            $query->filter(['terms' => ['beatmap_id' => $this->params->beatmapIds]]);
        }
        if ($this->params->userId !== null) {
            $query->filter(['term' => ['user_id' => $this->params->userId]]);
        }
        if ($this->params->excludeMods !== null && count($this->params->excludeMods) > 0) {
            $query->mustNot(['terms' => ['mods' => $this->params->excludeMods]]);
        }

        $this->addModsFilter($query);

        switch ($this->params->getType()) {
            case 'country':
                $query->filter(['term' => ['country_code' => $this->params->getCountryCode()]]);
                break;
            case 'friend':
                $query->filter(['terms' => ['user_id' => $this->params->getFriendIds()]]);
                break;
        }

        $beforeTotalScore = $this->params->beforeTotalScore ?? $this->params->beforeScore?->data->totalScore;
        if ($beforeTotalScore !== null) {
            $scoreQuery = (new BoolQuery())->shouldMatch(1);
            $scoreQuery->should((new BoolQuery())->filter(['range' => [
                'total_score' => ['gt' => $beforeTotalScore],
            ]]));
            if ($this->params->beforeScore !== null) {
                $scoreQuery->should((new BoolQuery())
                    ->filter(['range' => ['id' => ['lt' => $this->params->beforeScore->getKey()]]])
                    ->filter(['term' => ['total_score' => $beforeTotalScore]]));
            }

            $query->must($scoreQuery);
        }

        return $query;
    }

    private function addModsFilter(BoolQuery $query): void
    {
        $mods = $this->params->mods;
        if ($mods === null || count($mods) === 0) {
            return;
        }

        $modsHelper = app('mods');
        $allMods = $this->params->rulesetId === null
            ? $modsHelper->allIds
            : new Set(array_keys($modsHelper->mods[$this->params->rulesetId]));
        $allMods->remove('PF', 'SD', 'MR');

        $allSearchMods = [];
        foreach ($mods as $mod) {
            if ($mod === 'NM') {
                $noModSubQuery ??= (new BoolQuery())->mustNot(['terms' => ['mods' => $allMods->toArray()]]);
                continue;
            }
            $modsSubQuery ??= new BoolQuery();
            $searchMods = [$mod];
            $impliedBy = array_search_null($mod, $modsHelper::IMPLIED_MODS);
            if ($impliedBy !== null) {
                $searchMods[] = $impliedBy;
            }
            $modsSubQuery->filter(['terms' => ['mods' => $searchMods]]);
            $allSearchMods = [...$allSearchMods, ...$searchMods];
        }

        if (isset($modsSubQuery)) {
            $excludedMods = array_values(array_diff($allMods->toArray(), $allSearchMods));
            if (count($excludedMods) > 0) {
                $modsSubQuery->mustNot(['terms' => ['mods' => $excludedMods]]);
            }
        }

        foreach ([$noModSubQuery ?? null, $modsSubQuery ?? null] as $subQuery) {
            if ($subQuery !== null) {
                $shouldSubQueries ??= (new BoolQuery())->shouldMatch(1);
                $shouldSubQueries->should($subQuery);
            }
        }

        if (isset($shouldSubQueries)) {
            $query->must($shouldSubQueries);
        }
    }
}
