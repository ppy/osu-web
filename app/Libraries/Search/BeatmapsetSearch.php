<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\FunctionScore;
use App\Libraries\Elasticsearch\QueryHelper;
use App\Libraries\Elasticsearch\RecordSearch;
use App\Models\ArtistTrack;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Follow;
use App\Models\Solo;
use App\Models\Tag;
use App\Models\User;
use Ds\Set;

class BeatmapsetSearch extends RecordSearch
{
    private array $tokens;

    private static function isQuoted(string $value): bool
    {
        return str_starts_with($value, '"') && str_ends_with($value, '"');
    }

    public function __construct(?BeatmapsetSearchParams $params = null)
    {
        parent::__construct(
            Beatmapset::esIndexName(),
            $params ?? new BeatmapsetSearchParams(),
            Beatmapset::class
        );

        $this->tokens = QueryHelper::tokenize($params->queryString ?? '');
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery()
    {
        static $fullMatchFields = [
            'artist',
            'artist_unicode',
            'creator',
            'title',
            'title_unicode',
        ];

        static $partialMatchFields = [
            ...$fullMatchFields,
            'artist.*',
            'artist_unicode.*',
            'title.*',
            'title_unicode.*',
            'tags^0.5',
        ];

        $query = new BoolQuery();

        if (!empty($this->tokens['include'])) {
            $includeString = implode(' ', $this->tokens['include']);

            // the subscoping is not necessary but prevents unintentional accidents when combining other matchers
            $query->must(new BoolQuery()
                // results must contain at least one of the terms and boosted by containing all of them,
                // or match the id of the beatmapset.
                ->shouldMatch(1)
                ->should(['term' => ['_id' => ['value' => $includeString, 'boost' => 100]]])
                ->should([
                    'multi_match' => [
                        'fields' => $partialMatchFields,
                        'type' => 'most_fields',
                        'query' => $includeString,
                    ],
                ])
                ->should([
                    'nested' => [
                        'path' => 'beatmaps',
                        'query' => ['match' => ['beatmaps.top_tags' => ['query' => $includeString, 'operator' => 'and', 'boost' => 0.5]]],
                    ],
                ]));
        }

        // exclusion should be full matches only, and only on the main beatmapset fields.
        if (!empty($this->tokens['exclude'])) {
            $query->mustNot([
                'multi_match' => [
                    'fields' => $fullMatchFields,
                    'query' => implode(' ', $this->tokens['exclude']),
                ],
            ]);
        }

        $this->addBlockedUsersFilter($query);
        $this->addFeaturedArtistFilter($query);
        $this->addFeaturedArtistsFilter($query);
        $this->addFollowsFilter($query);
        $this->addGenreFilter($query);
        $this->addLanguageFilter($query);
        $this->addExtraFilter($query);
        $this->addNsfwFilter($query);
        $this->addRankedFilter($query);
        $this->addSpotlightsFilter($query);

        $nested = new BoolQuery();
        $this->addDifficultyFilter($nested);
        $this->addStatusFilter($query, $nested);
        $this->addManiaKeysFilter($nested);
        $this->addModeFilter($nested);
        $this->addPlayedFilter($query, $nested);
        $this->addRankFilter($nested);
        $this->addRecommendedFilter($nested);
        $this->addTagsFilter($nested);

        $this->addSimpleFilters($query, $nested);
        $this->addCreatorFilter($query, $nested);
        $this->addTextFilter($query, 'artist', ['artist', 'artist_unicode']);
        $this->addTextFilter($query, 'source', ['source']);
        $this->addTextFilter($query, 'title', ['title', 'title_unicode']);

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
            ->withPackTags()
            ->with(['beatmaps' => function ($q) {
                return $q->withMaxCombo();
            }])->get();
    }

    private function addBlockedUsersFilter($query)
    {
        $query->mustNot(['terms' => ['user_id' => $this->params->blockedUserIds()]]);
    }

    private function addCreatorFilter(BoolQuery $query, BoolQuery $nested): void
    {
        $value = $this->params->creator;

        if (!present($value)) {
            return;
        }

        $user = User::lookup($value);

        if ($user === null) {
            $this->addTextFilter($query, 'creator', ['creator']);
        } else {
            $nested->filter(['term' => ['beatmaps.user_id' => $user->getKey()]]);
        }
    }

    private function addDifficultyFilter(BoolQuery $nested)
    {
        if ($this->params->difficulty !== null) {
            $nested->must(['match' => ['beatmaps.version' => ['query' => $this->params->difficulty, 'operator' => 'and']]]);
        }
    }

    private function addExtraFilter($query)
    {
        foreach ($this->params->extra as $val) {
            $query->filter(['term' => [$val => true]]);
        }
    }

    private function addFeaturedArtistFilter($query)
    {
        if ($this->params->featuredArtist !== null) {
            $trackIds = ArtistTrack::where('artist_id', $this->params->featuredArtist)->pluck('id');
            $query->filter(['terms' => ['track_id' => $trackIds]]);
        }
    }

    private function addFeaturedArtistsFilter($query)
    {
        if ($this->params->showFeaturedArtists) {
            $query->filter(['exists' => ['field' => 'track_id']]);
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
        if ($this->params->playedFilter === null) {
            return;
        }

        $ids = $this->getPlayedBeatmapIds();
        $chunks = array_chunk($ids, 10000);

        if ($this->params->playedFilter === 'played') {
            if (count($ids) === 0) { // avoids the should empty list matching everything case.
                return $query->filter(['match_none' => (object) []]);
            }

            $boolQuery = new BoolQuery();
            foreach ($chunks as $chunk) {
                $boolQuery->should(['terms' => ['beatmaps.beatmap_id' => $chunk]]);
            }
            $nested->filter($boolQuery);
        } elseif ($this->params->playedFilter === 'unplayed') {
            // The inverse of nested:filter/must is must_not:nested, not nested:must_not
            // https://github.com/elastic/elasticsearch/issues/26264#issuecomment-323668358
            foreach ($chunks as $chunk) {
                $query->mustNot([
                    'nested' => [
                        'path' => 'beatmaps',
                        'query' => ['terms' => ['beatmaps.beatmap_id' => $chunk]],
                    ],
                ]);
            }
        }
    }

    private function addRankFilter($query)
    {
        if (empty($this->params->rank)) {
            return;
        }

        $ids = $this->getPlayedBeatmapIds($this->params->rank);
        if (count($ids) === 0) { // avoids the should empty list matching everything case.
            return $query->filter(['match_none' => (object) []]);
        }

        $chunks = array_chunk($ids, 10000);
        $boolQuery = new BoolQuery();
        foreach ($chunks as $chunk) {
            $boolQuery->should(['terms' => ['beatmaps.beatmap_id' => $chunk]]);
        }
        $query->filter($boolQuery);
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
            'accuracy' => ['field' => 'beatmaps.diff_overall', 'type' => 'range'],
            'ar' => ['field' => 'beatmaps.diff_approach', 'type' => 'range'],
            'bpm' => ['field' => 'beatmaps.bpm', 'type' => 'range'],
            'countNormal' => ['field' => 'beatmaps.countNormal', 'type' => 'range'],
            'countSlider' => ['field' => 'beatmaps.countSlider', 'type' => 'range'],
            'created' => ['field' => 'submit_date', 'type' => 'range'],
            'cs' => ['field' => 'beatmaps.diff_size', 'type' => 'range'],
            'difficultyRating' => ['field' => 'beatmaps.difficultyrating', 'type' => 'range'],
            'drain' => ['field' => 'beatmaps.diff_drain', 'type' => 'range'],
            'favouriteCount' => ['field' => 'favourite_count', 'type' => 'range'],
            'totalLength' => ['field' => 'beatmaps.total_length', 'type' => 'range'],
            'statusRange' => ['field' => 'beatmaps.approved', 'type' => 'range'],
            'updated' => ['field' => 'last_update', 'type' => 'range'],
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

    private function addSpotlightsFilter($query)
    {
        if ($this->params->showSpotlights) {
            $query->filter(['term' => ['spotlight' => true]]);
        }
    }

    // statuses are non scoring for the query context.
    private function addStatusFilter($mainQuery, $beatmapQuery)
    {
        $queryForFilter = $beatmapQuery;
        $query = new BoolQuery();

        switch ($this->params->status) {
            case 'any':
                break;
            case 'ranked':
                $query
                    ->should(['match' => ['beatmaps.approved' => Beatmapset::STATES['ranked']]])
                    ->should(['match' => ['beatmaps.approved' => Beatmapset::STATES['approved']]]);
                break;
            case 'loved':
                $query->must(['match' => ['beatmaps.approved' => Beatmapset::STATES['loved']]]);
                break;
            case 'favourites':
                if ($this->params->user !== null) {
                    $favs = model_pluck($this->params->user->favouriteBeatmapsets(), 'beatmapset_id', Beatmapset::class);
                }
                $query->must(['ids' => ['values' => $favs ?? []]]);
                $queryForFilter = $mainQuery;
                break;
            case 'qualified':
                $query->should(['match' => ['beatmaps.approved' => Beatmapset::STATES['qualified']]]);
                break;
            case 'pending':
                $query
                    ->must(['match' => ['beatmaps.approved' => Beatmapset::STATES['pending']]]);
                break;
            case 'wip':
                $query->must(['match' => ['beatmaps.approved' => Beatmapset::STATES['wip']]]);
                break;
            case 'graveyard':
                $query->must(['match' => ['beatmaps.approved' => Beatmapset::STATES['graveyard']]]);
                break;
            case 'mine':
                $query->must(['term' => ['beatmaps.user_id' => $this->params->user->getKey()]]);
                break;
            default: // null, etc
                $query
                    ->should(['match' => ['beatmaps.approved' => Beatmapset::STATES['ranked']]])
                    ->should(['match' => ['beatmaps.approved' => Beatmapset::STATES['approved']]])
                    ->should(['match' => ['beatmaps.approved' => Beatmapset::STATES['loved']]]);
                break;
        }

        $queryForFilter->filter($query);
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

        $subQuery->should([
            'multi_match' => [
                'fields' => $searchFields,
                'query' => $value,
                'operator' => 'and',
                'type' => static::isQuoted($value) ? 'phrase' : 'most_fields',
            ],
        ]);

        $query->must($subQuery);
    }

    private function addTagsFilter(BoolQuery $query): void
    {
        $tags = $this->params->tags;
        if ($tags === null) {
            return;
        }

        // workaround multi tag parsing when there's an empty tag.
        $tags = array_reject_null($tags);

        $tagMap = [];
        foreach ($tags as $tag) {
            $key = mb_strtolower(mb_trim($tag, '"'));
            $tagMap[$key] = $tag;
        }

        $exactTags = Tag::whereIn('name', array_keys($tagMap))->limit(10)->pluck('name');

        foreach ($exactTags as $tag) {
            $query->filter(['term' => ['beatmaps.top_tags.raw' => $tag]]);
            unset($tagMap[mb_strtolower($tag)]);
        }

        foreach (array_values($tagMap) as $tag) {
            $query->filter(['match' => ['beatmaps.top_tags' => ['query' => $tags, 'operator' => 'and']]]);
        }
    }

    private function getPlayedBeatmapIds(?array $rank = null)
    {
        $query = Solo\Score
            ::indexable()
            ->where('user_id', $this->params->user->getKey())
            ->whereIn('ruleset_id', $this->getSelectedModes());

        $showLegacyOnly = ScoreSearchParams::showLegacyForUser($this->params->user) ?? false;
        if ($showLegacyOnly) {
            $scoreField = 'legacy_total_score';
            $query->where('legacy_score_id', '>', 0);
        } else {
            $scoreField = 'total_score';
        }

        if ($rank === null) {
            return $query->distinct('beatmap_id')->pluck('beatmap_id')->all();
        }

        $topScores = [];
        foreach ($query->get() as $score) {
            $prevScore = $topScores[$score->beatmap_id] ?? null;

            $scoreValue = $score->$scoreField;
            if ($scoreValue !== null && ($prevScore === null || $prevScore->$scoreField < $scoreValue)) {
                $topScores[$score->beatmap_id] = $score;
            }
        }

        if ($showLegacyOnly) {
            foreach ($topScores as $beatmapId => $score) {
                $topScores[$beatmapId] = $score->makeLegacyEntry();
            }
        }

        $ret = [];
        $rankSet = new Set($rank);
        foreach ($topScores as $beatmapId => $score) {
            if ($rankSet->contains($score->rank)) {
                $ret[] = $beatmapId;
            }
        }

        return $ret;
    }

    private function getSelectedModes()
    {
        return $this->params->mode === null ? array_values(Beatmap::MODES) : [$this->params->mode];
    }
}
