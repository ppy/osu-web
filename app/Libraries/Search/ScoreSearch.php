<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\RecordSearch;
use App\Models\Solo\Score;
use Ds\Set;

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

        $mods = $this->params->mods;
        if ($mods !== null && count($mods) > 0) {
            $modsHelper = app('mods');
            $allMods = new Set(array_keys($modsHelper->mods[$this->params->rulesetId]));
            $allMods->remove('PF', 'SD', 'MR');

            if (in_array('NM', $mods, true)) {
                $mods = [];
            }

            $allSearchMods = [];
            foreach ($mods as $mod) {
                $searchMods = [$mod];
                $impliedBy = array_search_null($mod, $modsHelper::IMPLIED_MODS);
                if ($impliedBy !== null) {
                    $searchMods[] = $impliedBy;
                }
                $query->filter(['terms' => ['mods' => $searchMods]]);
                $allSearchMods = [...$allSearchMods, ...$searchMods];
            }

            $excludedMods = array_values(array_diff($allMods->toArray(), $allSearchMods));
            if (count($excludedMods) > 0) {
                $query->mustNot(['terms' => ['mods' => $excludedMods]]);
            }
        }

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
}
