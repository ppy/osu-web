<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\FunctionScore;
use App\Libraries\Elasticsearch\Queryable;
use App\Libraries\Elasticsearch\QueryHelper;
use App\Libraries\Elasticsearch\RecordSearch;
use App\Models\ArtistTrack;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Follow;
use App\Models\Solo;
use App\Models\User;
use Ds\Set;

/**
 * @property-read BeatmapsetSearchParams $params TODO: this should be protected
 */
class BeatmapsetSearch extends RecordSearch
{
    private BeatmapsetSearchOptions $excludes;
    private BeatmapsetSearchOptions $includes;
    private BoolQuery $nested;
    private BoolQuery $nestedMustNot;
    private array $tokens;

    private static function isExactTag(string $value): bool
    {
        return mb_strpos($value, '/') !== false;
    }

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

        $this->tokens = QueryHelper::tokenise($params->queryString ?? '');
        $this->excludes = $this->params->excludes;
        $this->includes = $this->params->includes;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery(): Queryable
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

        $this->query = new BoolQuery();
        $this->nested = new BoolQuery();
        $this->nestedMustNot = new BoolQuery()->shouldMatch(1);

        if (!empty($this->tokens['include'])) {
            $implodedInclude = implode(' ', $this->tokens['include']);
            // the subscoping is not necessary but prevents unintentional accidents when combining other matchers
            $boolQuery = new BoolQuery()
                // results boosted by containing all terms, or match the id of the beatmapset.
                ->shouldMatch(1)
                ->should(['term' => ['_id' => ['value' => $implodedInclude, 'boost' => 100]]])
                ->should([
                    'multi_match' => [
                        'fields' => $fullMatchFields,
                        'type' => 'phrase',
                        'query' => $implodedInclude,
                    ],
                ]);

            // Look for maybe relevant results.
            // "Something like this but I'm not exactly sure" kind of search.
            foreach ($this->tokens['include'] as $include) {
                $isQuoted = static::isQuoted($include);
                $boolQuery
                    ->should([
                        'multi_match' => [
                            'boost' => $isQuoted ? 1 : 1 / count($this->tokens['include']),
                            'fields' => $isQuoted ? $fullMatchFields : $partialMatchFields,
                            'type' => $isQuoted ? 'phrase' : 'cross_fields',
                            'query' => $include,
                        ],
                    ])
                    ->should([
                        'nested' => [
                            'path' => 'beatmaps',
                            'query' => ['match' => ['beatmaps.top_tags' => ['query' => $include, 'operator' => 'and', 'boost' => 0.5]]],
                        ],
                    ]);
            }

            $this->query->must($boolQuery);
        }

        // exclusion should be full matches only, and only on the main beatmapset fields.
        if (!empty($this->tokens['exclude'])) {
            foreach ($this->tokens['exclude'] as $exclude) {
                $this->query->mustNot([
                    'multi_match' => [
                        'fields' => $fullMatchFields,
                        'type' => static::isQuoted($exclude) ? 'phrase' : 'most_fields',
                        'query' => $exclude,
                    ],
                ]);
            }
        }

        // top level
        $this->addBlockedUsersFilter();
        $this->addFeaturedArtistFilter();
        $this->addFeaturedArtistsFilter();
        $this->addFollowsFilter();
        $this->addGenreFilter();
        $this->addLanguageFilter();
        $this->addExtraFilter();
        $this->addNsfwFilter();
        $this->addRankedFilter();
        $this->addSpotlightsFilter();

        // nested
        $this->addDifficultyFilter();
        $this->addStatusFilter();
        $this->addManiaKeysFilter();
        $this->addModeFilter();
        $this->addPlayedFilter();
        $this->addRankFilter();
        $this->addRecommendedFilter();
        $this->addTagsFilter();

        $this->addSimpleFilters();
        $this->addCreatorFilter();

        foreach ([true, false] as $include) {
            $this->addTextFilter('artist', ['artist', 'artist_unicode'], $include);
            $this->addTextFilter('source', ['source'], $include);
            $this->addTextFilter('title', ['title', 'title_unicode'], $include);
        }

        $this->query->filter([
            'nested' => [
                'path' => 'beatmaps',
                'query' => $this->nested->toArray(),
            ],
        ]);

        if (!empty($this->tokens['exclude'])) {
            $this->query = [
                'boosting' => [
                    'positive' => $this->query->toArray(),
                    'negative' => [
                        'match' => ['tags' => implode(' ', $this->tokens['exclude'])],
                    ],
                    'negative_boost' => 0.5,
                ],
            ];
        }

        // The inverse of nested:filter/must is must_not:nested, not nested:must_not
        // https://github.com/elastic/elasticsearch/issues/26264#issuecomment-323668358
        if (!$this->nestedMustNot->isEmpty()) {
            $this->query->mustNot([
                'nested' => [
                    'path' => 'beatmaps',
                    'query' => $this->nestedMustNot->toArray(),
                ],
            ]);
        }

        if (present($this->params->queryString)) {
            $this->query = (new FunctionScore($this->query))
                ->applyFunction([
                    'field_value_factor' => [
                        'field' => 'favourite_count',
                        'missing' => 0,
                        'modifier' => 'ln2p',
                    ],
                ]);
        }

        return $this->query;
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

    private function addBlockedUsersFilter()
    {
        $this->query->mustNot(['terms' => ['user_id' => $this->params->blockedUserIds()]]);
    }

    private function addCreatorFilter(): void
    {
        $value = $this->includes->creator;

        if (present($value)) {
            $user = User::lookup($value);

            if ($user === null) {
                $this->addTextFilter('creator', ['creator']);
            } else {
                $this->nested->filter(['term' => ['beatmaps.user_id' => $user->getKey()]]);
            }
        }

        $value = $this->excludes->creator;

        if (present($value)) {
            $user = User::lookup($value);

            if ($user === null) {
                $this->addTextFilter('creator', ['creator'], false);
            } else {
                $this->nestedMustNot->should(['term' => ['beatmaps.user_id' => $user->getKey()]]);
            }
        }
    }

    private function addDifficultyFilter()
    {
        if ($this->includes->difficulty !== null) {
            $params = static::isQuoted($this->includes->difficulty)
                ? ['match_phrase' => ['beatmaps.version' => $this->includes->difficulty]]
                : ['match' => ['beatmaps.version' => ['query' => $this->includes->difficulty, 'operator' => 'and']]];
            $this->nested->must($params);
        }

        // difficulty excludes if any single beatmap matches since requiring all the difficulties to have the matching phrase would be weird.
        if ($this->excludes->difficulty !== null) {
            $matcher = static::isQuoted($this->excludes->difficulty) ? 'match_phrase' : 'match';
            $this->nestedMustNot->should([$matcher => ['beatmaps.version' => $this->excludes->difficulty]]);
        }
    }

    private function addExtraFilter()
    {
        foreach ($this->params->extra as $val) {
            $this->query->filter(['term' => [$val => true]]);
        }
    }

    private function addFeaturedArtistFilter()
    {
        if ($this->includes->featuredArtist !== null) {
            $trackIds = ArtistTrack::where('artist_id', $this->includes->featuredArtist)->pluck('id');
            $this->query->filter(['terms' => ['track_id' => $trackIds]]);
        }

        if ($this->excludes->featuredArtist !== null) {
            $trackIds = ArtistTrack::where('artist_id', $this->excludes->featuredArtist)->pluck('id');
            $this->query->mustNot(['terms' => ['track_id' => $trackIds]]);
        }
    }

    private function addFeaturedArtistsFilter()
    {
        if ($this->params->showFeaturedArtists) {
            $this->query->filter(['exists' => ['field' => 'track_id']]);
        }
    }

    private function addFollowsFilter()
    {
        if ($this->params->showFollows && $this->params->user !== null) {
            $followIds = Follow::where(['subtype' => 'mapping', 'user_id' => $this->params->user->getKey()])->pluck('notifiable_id')->all();

            $this->query->filter(['terms' => ['user_id' => $followIds]]);
        }
    }

    private function addGenreFilter()
    {
        if ($this->params->genre !== null) {
            $this->query->filter(['term' => ['genre_id' => $this->params->genre]]);
        }
    }

    private function addLanguageFilter()
    {
        if ($this->params->language !== null) {
            $this->query->filter(['term' => ['language_id' => $this->params->language]]);
        }
    }

    private function addManiaKeysFilter(): void
    {
        if ($this->includes->keys !== null) {
            $this->nested
                ->filter(['range' => ['beatmaps.diff_size' => $this->includes->keys]])
                ->filter(['term' => ['beatmaps.playmode' => Beatmap::MODES['mania']]]);
        }

        if ($this->excludes->keys !== null) {
            $this->nested->filter(['term' => ['beatmaps.playmode' => Beatmap::MODES['mania']]]);
            $this->nestedMustNot->should(
                (new BoolQuery())
                    ->filter(['range' => ['beatmaps.diff_size' => $this->excludes->keys]])
                    ->filter(['term' => ['beatmaps.playmode' => Beatmap::MODES['mania']]])
            );
        }
    }

    private function addModeFilter()
    {
        if (!$this->params->includeConverts) {
            $this->nested->filter(['term' => ['beatmaps.convert' => false]]);
        }

        if ($this->params->mode !== null) {
            $this->nested->filter(['term' => ['beatmaps.playmode' => $this->params->mode]]);
        }
    }

    private function addNsfwFilter()
    {
        if (!$this->params->includeNsfw) {
            $this->query->filter(['term' => ['nsfw' => false]]);
        }
    }

    private function addPlayedFilter()
    {
        if ($this->params->playedFilter === null) {
            return;
        }

        $ids = $this->getPlayedBeatmapIds();
        $chunks = array_chunk($ids, 10000);

        if ($this->params->playedFilter === 'played') {
            if (count($ids) === 0) { // avoids the should empty list matching everything case.
                return $this->query->filter(['match_none' => (object) []]);
            }

            $boolQuery = new BoolQuery();
            foreach ($chunks as $chunk) {
                $boolQuery->should(['terms' => ['beatmaps.beatmap_id' => $chunk]]);
            }
            $this->nested->filter($boolQuery);
        } elseif ($this->params->playedFilter === 'unplayed') {
            // The inverse of nested:filter/must is must_not:nested, not nested:must_not
            // https://github.com/elastic/elasticsearch/issues/26264#issuecomment-323668358
            foreach ($chunks as $chunk) {
                $this->nestedMustNot->should(['terms' => ['beatmaps.beatmap_id' => $chunk]]);
            }
        }
    }

    private function addRankFilter()
    {
        if (empty($this->params->rank)) {
            return;
        }

        $ids = $this->getPlayedBeatmapIds($this->params->rank);
        if (count($ids) === 0) { // avoids the should empty list matching everything case.
            return $this->query->filter(['match_none' => (object) []]);
        }

        $chunks = array_chunk($ids, 10000);
        $boolQuery = new BoolQuery();
        foreach ($chunks as $chunk) {
            $boolQuery->should(['terms' => ['beatmaps.beatmap_id' => $chunk]]);
        }
        $this->query->filter($boolQuery);
    }

    private function addRecommendedFilter()
    {
        if ($this->params->showRecommended && $this->params->user !== null) {
            // TODO: index convert difficulties and handle them.
            $difficulty = $this->params->getRecommendedDifficulty();
            $this->nested->filter([
                'range' => [
                    'beatmaps.difficultyrating' => [
                        'gte' => $difficulty - 0.5,
                        'lte' => $difficulty + 0.5,
                    ],
                ],
            ]);
        }
    }

    private function addRankedFilter(): void
    {
        static $approvedStates = [
            Beatmapset::STATES['ranked'],
            Beatmapset::STATES['approved'],
            Beatmapset::STATES['loved'],
        ];

        if ($this->includes->ranked !== null) {
            $this->query
                ->filter(['terms' => ['approved' => $approvedStates]])
                ->filter(['range' => ['approved_date' => $this->includes->ranked]]);
        }

        // ranked date exclusion assumes we're still looking for ranked maps.
        if ($this->excludes->ranked !== null) {
            $this->query
                ->filter(['terms' => ['approved' => $approvedStates]])
                ->mustNot(['range' => ['approved_date' => $this->excludes->ranked]]);
        }
    }

    private function addSimpleFilters(): void
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
            $isNested = substr($options['field'], 0, $nestedPrefixLength) === $nestedPrefix;
            if ($this->includes->$prop !== null) {
                $q = $isNested ? $this->nested : $this->query;
                $q->filter([$options['type'] => [$options['field'] => $this->includes->$prop]]);
            }

            if ($this->excludes->$prop !== null) {
                if ($isNested) {
                    $boolQuery = (new BoolQuery())->filter([$options['type'] => [$options['field'] => $this->excludes->$prop]]);
                    // converts can have different values so it needs to be specific when excluding
                    // or the exclude query will match the convert when it's not supposed to.
                    if (!$this->params->includeConverts) {
                        $boolQuery->filter(['term' => ['beatmaps.convert' => false]]);
                    } else if ($this->params->mode !== null) {
                        $boolQuery->filter(['term' => ['beatmaps.playmode' => $this->params->mode]]);
                    }

                    $this->nestedMustNot->should($boolQuery);
                } else {
                    $this->query->mustNot([$options['type'] => [$options['field'] => $this->excludes->$prop]]);
                }
            }
        }
    }

    private function addSpotlightsFilter()
    {
        if ($this->params->showSpotlights) {
            $this->query->filter(['term' => ['spotlight' => true]]);
        }
    }

    // statuses are non scoring for the query context.
    private function addStatusFilter()
    {
        $queryForFilter = $this->nested;
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
                $queryForFilter = $this->query;
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

    private function addTextFilter(string $paramField, array $fields, bool $include = true): void
    {
        $options = $include ? $this->includes : $this->excludes;
        $value = $options->$paramField;

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

        // TODO: change matching logic to match query string keywords?
        $subQuery->should([
            'multi_match' => [
                'fields' => $searchFields,
                'query' => $value,
                'operator' => 'and',
                'type' => static::isQuoted($value) ? 'phrase' : 'most_fields',
            ],
        ]);

        if ($include) {
            $this->query->must($subQuery);
        } else {
            $this->query->mustNot($subQuery);
        }
    }

    private function addTagsFilter(): void
    {
        $includeTags = $this->includes->tags;
        $excludeTags = $this->excludes->tags;

        if ($includeTags !== null) {
            // workaround multi tag parsing when there's an empty tag.
            $tags = array_reject_null($includeTags);
            // "geometric grid snap" - match any words in any tag
            // ""geometric grid snap"" - match the phrase in the same tag.
            // "geometric/grid snap" - explicitly match the tag.
            foreach ($tags as $tag) {
                $value = mb_trim($tag, '"');
                if (static::isExactTag($tag)) {
                    $this->nested->filter([
                        'term' => [
                            'beatmaps.top_tags.raw' => [
                                'case_insensitive' => true,
                                'value' => $value,
                            ],
                        ],
                    ]);
                } else if (static::isQuoted($tag)) {
                    $this->nested->filter([
                        'match_phrase' => [
                            'beatmaps.top_tags' => [
                                'query' => $value,
                            ],
                        ],
                    ]);
                } else {
                    $this->nested->filter([
                        'match' => [
                            'beatmaps.top_tags' => [
                                'query' => $value,
                                'operator' => 'and',
                            ],
                        ],
                    ]);
                }
            }
        }

        // Tag exclusion excludes only if all the beatmaps of the beatmapset match.
        if ($excludeTags !== null) {
            $tags = array_reject_null($excludeTags);
            // "geometric grid snap" - exclude if all words are matched in any tag
            // ""geometric grid snap"" - exclude if the exact phrase matches any part of the tag.
            // "geometric/grid snap" - exclude only if matches the whole tag.
            foreach ($tags as $tag) {
                $value = mb_trim($tag, '"');
                if (static::isExactTag($tag)) {
                    $this->nested->mustNot([
                        'term' => [
                            'beatmaps.top_tags.raw' => [
                                'case_insensitive' => true,
                                'value' => $value,
                            ],
                        ],
                    ]);
                } else if (static::isQuoted($tag)) {
                    $this->nested->mustNot([
                        'match_phrase' => [
                            'beatmaps.top_tags' => [
                                'query' => $value,
                            ],
                        ],
                    ]);
                } else {
                    $this->nested->mustNot([
                        'match' => [
                            'beatmaps.top_tags' => [
                                'query' => $value,
                                'operator' => 'and',
                            ],
                        ],
                    ]);
                }
            }
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
