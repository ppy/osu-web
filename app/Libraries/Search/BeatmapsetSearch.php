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
use App\Models\Follow;
use App\Models\Score;

class BeatmapsetSearch extends RecordSearch
{
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
        static $partialMatchFields = [
            'artist',
            'artist.*',
            'artist_unicode',
            'artist_unicode.*',
            'creator',
            'title',
            'title.*',
            'title_unicode',
            'title_unicode.*',
            'tags^0.5',
        ];

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

        $this->addArtistIdFilter($query);
        $this->addBlacklistFilter($query);
        $this->addBlockedUsersFilter($query);
        $this->addFeaturedArtistsFilter($query);
        $this->addFollowsFilter($query);
        $this->addGenreFilter($query);
        $this->addLanguageFilter($query);
        $this->addExtraFilter($query);
        $this->addNsfwFilter($query);
        $this->addRankedFilter($query);
        $this->addStatusFilter($query);

        $nested = new BoolQuery();
        $this->addManiaKeysFilter($nested);
        $this->addModeFilter($nested);
        $this->addPlayedFilter($query, $nested);
        $this->addRankFilter($nested);
        $this->addRecommendedFilter($nested);

        $this->addSimpleFilters($query, $nested);
        $this->addTextFilter($query, 'artist', ['artist', 'artist_unicode']);
        $this->addTextFilter($query, 'creator', ['creator']);

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

    private function addArtistIdFilter($query)
    {
        $artistId = $this->params->artistId;

        if ($artistId) {
            $query->filter(['term' => ['artist_id' => $artistId]]);
        }
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

    private function addFeaturedArtistsFilter($query)
    {
        if ($this->params->showFeaturedArtists) {
            $query->filter(['exists' => ['field' => 'artist_id']]);
        }
    }

    private function addFollowsFilter($query)
    {
        if ($this->params->showFollows && $this->params->user !== null) {
            $followIds = Follow::where(['subtype' => 'mapping', 'user_id' => $this->params->user->getKey()])->pluck('notifiable_id')->all();

            $query->filter(['terms' => ['user_id' => $followIds]]);
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

    private function addManiaKeysFilter(BoolQuery $nestedQuery): void
    {
        if ($this->params->keys === null) {
            return;
        }

        $nestedQuery
            ->filter(['range' => ['beatmaps.diff_size' => $this->params->keys]])
            ->filter(['term' => ['beatmaps.playmode' => Beatmap::MODES['mania']]]);
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

    private function addNsfwFilter($query)
    {
        if (!$this->params->includeNsfw) {
            $query->filter(['term' => ['nsfw' => false]]);
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

    private function addRankedFilter(BoolQuery $query): void
    {
        if ($this->params->ranked !== null) {
            $query
                ->filter(['terms' => ['approved' => [
                    Beatmapset::STATES['ranked'],
                    Beatmapset::STATES['approved'],
                    Beatmapset::STATES['loved'],
                ]]])->filter(['range' => ['approved_date' => $this->params->ranked]]);
        }
    }

    private function addSimpleFilters(BoolQuery $query, BoolQuery $nested): void
    {
        static $filters = [
            'ar' => ['field' => 'beatmaps.diff_approach', 'type' => 'range'],
            'bpm' => ['field' => 'bpm', 'type' => 'range'],
            'created' => ['field' => 'submit_date', 'type' => 'range'],
            'cs' => ['field' => 'beatmaps.diff_size', 'type' => 'range'],
            'difficultyRating' => ['field' => 'beatmaps.difficultyrating', 'type' => 'range'],
            'drain' => ['field' => 'beatmaps.diff_drain', 'type' => 'range'],
            'hitLength' => ['field' => 'beatmaps.hit_length', 'type' => 'range'],
            'statusRange' => ['field' => 'beatmaps.approved', 'type' => 'range'],
            // (unsupported) 'divisor' => ['field' => ???, 'type' => 'range'],
        ];

        static $nestedPrefix = 'beatmaps.';
        $nestedPrefixLength = strlen($nestedPrefix);

        foreach ($filters as $prop => $options) {
            if ($this->params->$prop === null) {
                continue;
            }

            $q = substr($options['field'], 0, $nestedPrefixLength) === $nestedPrefix ? $nested : $query;
            $q->filter([$options['type'] => [$options['field'] => $this->params->$prop]]);
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

    private function addTextFilter(BoolQuery $query, string $paramField, array $fields): void
    {
        $value = $this->params->$paramField;

        if (!present($value)) {
            return;
        }

        $subQuery = (new BoolQuery())->shouldMatch(1);

        $searchFields = [];
        foreach ($fields as $field) {
            $searchFields[] = $field;
            $searchFields[] = "{$field}.*";

            $subQuery->should(['term' => ["{$field}.raw" => ['value' => $value, 'boost' => 100]]]);
        }

        $subQuery->should(QueryHelper::queryString($value, $searchFields, 'and'));

        $query->must($subQuery);
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
