<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\FunctionScore;
use App\Libraries\Elasticsearch\QueryHelper;
use App\Libraries\Elasticsearch\RecordSearch;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Score;

class BeatmapsetSearch extends RecordSearch
{
    public $recommendedDifficulty;

    /**
     * @param BeatmapsetSearchParams $params
     */
    public function __construct(?BeatmapsetSearchParams $params = null)
    {
        parent::__construct(
            Beatmapset::esIndexName(),
            $params ?? new BeatmapsetSearchParams(),
            Beatmapset::class
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery()
    {
        static $partialMatchFields = ['artist', 'artist.*', 'artist_unicode', 'creator', 'title', 'title.raw', 'title.*', 'title_unicode', 'tags^0.5'];

        $query = new BoolQuery();

        if (present($this->params->queryString)) {
            $terms = explode(' ', $this->params->queryString);

            // the subscoping is not necessary but prevents unintentional accidents when combining other matchers
            $query->must(
                (new BoolQuery())
                    // results must contain at least one of the terms and boosted by containing all of them,
                    // or match the id of the beatmapset.
                    ->shouldMatch(1)
                    ->should(['term' => ['_id' => ['value' => $this->params->queryString, 'boost' => 100]]])
                    ->should(QueryHelper::queryString($this->params->queryString, $partialMatchFields, 'or', 1 / count($terms)))
                    ->should(QueryHelper::queryString($this->params->queryString, [], 'and'))
            );
        }

        $this->addBlacklistFilter($query);
        $this->addBlockedUsersFilter($query);
        $this->addGenreFilter($query);
        $this->addLanguageFilter($query);
        $this->addExtraFilter($query);
        $this->addStatusFilter($query);

        $nested = new BoolQuery();
        $this->addModeFilter($nested);
        $this->addPlayedFilter($query, $nested);
        $this->addRankFilter($nested);
        $this->addRecommendedFilter($nested);

        $query->filter([
            'nested' => [
                'path' => 'beatmaps',
                'query' => $nested->toArray(),
            ],
        ]);

        if (present($this->params->queryString)) {
            $query = (new FunctionScore($query))
                ->applyFunction([
                    'field_value_factor' => [
                        'field' => 'favourite_count',
                        'missing' => 0,
                        'modifier' => 'ln2p',
                    ],
                ]);
        }

        return $query;
    }

    public function records()
    {
        return $this
            ->response()
            ->records()
            ->with(['beatmaps' => function ($q) {
                return $q->withMaxCombo();
            }])->get();
    }

    private function addBlacklistFilter($query)
    {
        static $fields = ['artist', 'source', 'tags'];
        $bool = new BoolQuery();

        foreach ($fields as $field) {
            $bool->mustNot([
                'terms' => [
                    $field => [
                        'index' => config('osu.elasticsearch.prefix').'blacklist',
                        'type' => 'blacklist', // FIXME: change to _doc after upgrading from 6.1
                        'id' => 'beatmapsets',
                        // can be changed to per-field blacklist as different fields should probably have different restrictions.
                        'path' => 'keywords',
                    ],
                ],
            ]);
        }

        $query->filter($bool);
    }

    private function addBlockedUsersFilter($query)
    {
        $query->mustNot(['terms' => ['user_id' => $this->params->blockedUserIds()]]);
    }

    private function addExtraFilter($query)
    {
        foreach ($this->params->extra as $val) {
            $query->filter(['term' => [$val => true]]);
        }
    }

    private function addGenreFilter($query)
    {
        if ($this->params->genre !== null) {
            $query->filter(['term' => ['genre_id' => $this->params->genre]]);
        }
    }

    private function addLanguageFilter($query)
    {
        if ($this->params->language !== null) {
            $query->filter(['term' => ['language_id' => $this->params->language]]);
        }
    }

    private function addModeFilter($query)
    {
        if (!$this->params->includeConverts) {
            $query->filter(['term' => ['beatmaps.convert' => false]]);
        }

        if ($this->params->mode !== null) {
            $query->filter(['term' => ['beatmaps.playmode' => $this->params->mode]]);
        }
    }

    private function addPlayedFilter($query, $nested)
    {
        if ($this->params->playedFilter === 'played') {
            $nested->filter(['terms' => ['beatmaps.beatmap_id' => $this->getPlayedBeatmapIds()]]);
        } elseif ($this->params->playedFilter === 'unplayed') {
            // The inverse of nested:filter/must is must_not:nested, not nested:must_not
            // https://github.com/elastic/elasticsearch/issues/26264#issuecomment-323668358
            $query->mustNot([
                'nested' => [
                    'path' => 'beatmaps',
                    'query' => ['terms' => ['beatmaps.beatmap_id' => $this->getPlayedBeatmapIds()]],
                ],
            ]);
        }
    }

    private function addRankFilter($query)
    {
        if (empty($this->params->rank)) {
            return;
        }

        $query->filter(['terms' => ['beatmaps.beatmap_id' => $this->getPlayedBeatmapIds($this->params->rank)]]);
    }

    private function addRecommendedFilter($query)
    {
        if ($this->params->showRecommended && $this->params->user !== null) {
            // TODO: index convert difficulties and handle them.
            $difficulty = $this->params->getRecommendedDifficulty();
            $query->filter([
                'range' => [
                    'beatmaps.difficultyrating' => [
                        'gte' => $difficulty - 0.5,
                        'lte' => $difficulty + 0.5,
                    ],
                ],
            ]);
        }
    }

    // statuses are non scoring for the query context.
    private function addStatusFilter($mainQuery)
    {
        $query = new BoolQuery();

        switch ($this->params->status) {
            case 'any':
                break;
            case 'ranked':
                $query
                    ->should(['match' => ['approved' => Beatmapset::STATES['ranked']]])
                    ->should(['match' => ['approved' => Beatmapset::STATES['approved']]]);
                break;
            case 'loved':
                $query->must(['match' => ['approved' => Beatmapset::STATES['loved']]]);
                break;
            case 'favourites':
                $favs = model_pluck($this->params->user->favouriteBeatmapsets(), 'beatmapset_id', Beatmapset::class);
                $query->must(['ids' => ['values' => $favs]]);
                break;
            case 'qualified':
                $query->should(['match' => ['approved' => Beatmapset::STATES['qualified']]]);
                break;
            case 'pending':
                $query
                    ->should(['match' => ['approved' => Beatmapset::STATES['wip']]])
                    ->should(['match' => ['approved' => Beatmapset::STATES['pending']]]);
                break;
            case 'graveyard':
                $query->must(['match' => ['approved' => Beatmapset::STATES['graveyard']]]);
                break;
            case 'mine':
                if ($this->params->user !== null) {
                    $maps = model_pluck($this->params->user->beatmapsets(), 'beatmapset_id');
                }
                $query->must(['ids' => ['values' => $maps ?? []]]);
                break;
            default: // null, etc
                $query
                    ->should(['match' => ['approved' => Beatmapset::STATES['ranked']]])
                    ->should(['match' => ['approved' => Beatmapset::STATES['approved']]])
                    ->should(['match' => ['approved' => Beatmapset::STATES['loved']]]);
                break;
        }

        $mainQuery->filter($query);
    }

    private function getPlayedBeatmapIds(?array $rank = null)
    {
        $unionQuery = null;

        $select = $rank === null ? 'beatmap_id' : ['beatmap_id', 'score', 'rank'];

        foreach ($this->getSelectedModes() as $mode) {
            $newQuery = Score\Best\Model::getClass($mode)
                ::forUser($this->params->user)
                ->select($select);

            if ($unionQuery === null) {
                $unionQuery = $newQuery;
            } else {
                $unionQuery->union($newQuery);
            }
        }

        if ($rank === null) {
            return model_pluck($unionQuery, 'beatmap_id');
        } else {
            $allScores = $unionQuery->get();
            $beatmapRank = collect();

            foreach ($allScores as $score) {
                $prevScore = $beatmapRank[$score->beatmap_id] ?? null;

                if ($prevScore === null || $prevScore->score < $score->score) {
                    $beatmapRank[$score->beatmap_id] = $score;
                }
            }

            return $beatmapRank->whereInStrict('rank', $rank)->pluck('beatmap_id')->all();
        }
    }

    private function getSelectedModes()
    {
        return $this->params->mode === null ? array_values(Beatmap::MODES) : [$this->params->mode];
    }
}
