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

    public function __construct(?BeatmapsetSearchParams $params = null)
    {
        parent::__construct(
            Beatmapset::esIndexName(),
            $params ?? new BeatmapsetSearchParams(),
            Beatmapset::class
        );

        $this->excludes = $this->params->excludes;
        $this->includes = $this->params->includes;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery(): Queryable
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

        $this->query = new BoolQuery();
        $this->nested = new BoolQuery();
        $this->nestedMustNot = new BoolQuery()->shouldMatch(1);

        if (present($this->params->queryString)) {
            $terms = explode(' ', $this->params->queryString);

            // the subscoping is not necessary but prevents unintentional accidents when combining other matchers
            $this->query->must(
                (new BoolQuery())
                    // results must contain at least one of the terms and boosted by containing all of them,
                    // or match the id of the beatmapset.
                    ->shouldMatch(1)
                    ->should(['term' => ['_id' => ['value' => $this->params->queryString, 'boost' => 100]]])
                    ->should(QueryHelper::queryString($this->params->queryString, $partialMatchFields, 'or', 1 / count($terms)))
                    ->should(QueryHelper::queryString($this->params->queryString, [], 'and'))
                    ->should([
                        'nested' => [
                            'path' => 'beatmaps',
                            'query' => QueryHelper::queryString($this->params->queryString, ['beatmaps.top_tags'], 'or', 0.5 / count($terms)),
                        ],
                    ])
            );
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
            $this->nested->filter(QueryHelper::queryString($this->includes->difficulty, ['beatmaps.version'], 'and'));
        }

        if ($this->excludes->difficulty !== null) {
            $this->nestedMustNot->should(QueryHelper::queryString($this->excludes->difficulty, ['beatmaps.version'], 'or'));
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
            $this->nestedMustNot->should(['terms' => ['track_id' => $trackIds]]);
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
            // TODO: needs checking; exclude keys but only on mania maps
            // TODO: this seems to make no sense to apply across a whole set?
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
        if ($this->params->playedFilter === 'played') {
            $this->nested->filter(['terms' => ['beatmaps.beatmap_id' => $this->getPlayedBeatmapIds()]]);
        } elseif ($this->params->playedFilter === 'unplayed') {
            // The inverse of nested:filter/must is must_not:nested, not nested:must_not
            // https://github.com/elastic/elasticsearch/issues/26264#issuecomment-323668358
            $this->query->mustNot([
                'nested' => [
                    'path' => 'beatmaps',
                    'query' => ['terms' => ['beatmaps.beatmap_id' => $this->getPlayedBeatmapIds()]],
                ],
            ]);
        }
    }

    private function addRankFilter()
    {
        if (empty($this->params->rank)) {
            return;
        }

        $this->nested->filter(['terms' => ['beatmaps.beatmap_id' => $this->getPlayedBeatmapIds($this->params->rank)]]);
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
        if ($this->includes->ranked !== null) {
            $this->query
                ->filter(['terms' => ['approved' => [
                    Beatmapset::STATES['ranked'],
                    Beatmapset::STATES['approved'],
                    Beatmapset::STATES['loved'],
                ]]])->filter(['range' => ['approved_date' => $this->includes->ranked]]);
        }

        // TODO: add ranked exclusion
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
            if ($this->includes->$prop === null) {
                continue;
            }

            $q = substr($options['field'], 0, $nestedPrefixLength) === $nestedPrefix ? $this->nested : $this->query;
            $q->filter([$options['type'] => [$options['field'] => $this->includes->$prop]]);
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
                if ($this->params->user !== null) {
                    $maps = $this->params->user->beatmaps()
                        ->select('beatmapset_id')
                        ->distinct()
                        ->pluck('beatmapset_id')
                        ->all();
                }
                $query->must(['ids' => ['values' => $maps ?? []]]);
                $queryForFilter = $this->query;
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

        $subQuery->should(QueryHelper::queryString($value, $searchFields, 'and'));

        if ($include) {
            $this->query->must($subQuery);
        } else {
            $this->nestedMustNot->should($subQuery);
        }
    }

    private function addTagsFilter(): void
    {
        $includeTags = $this->includes->tags;
        $excludeTags = $this->excludes->tags;

        if ($includeTags !== null) {
            // workaround multi tag parsing when there's an empty tag.
            $tags = array_reject_null($includeTags);

            // require exact match for full tags, partial otherwise.
            // "grid snap" - match grid AND snap in any order. e.g. snap/grid is allowed.
            // ""grid snap"" - match anything with "grid snap".
            // "geometric/grid snap" - explicitly match the tag.
            foreach ($tags as $tag) {
                if (mb_strpos($tag, '/') !== false) {
                    $this->nested->filter([
                        'term' => [
                            'beatmaps.top_tags.raw' => [
                                'case_insensitive' => true,
                                'value' => mb_trim($tag, '"'),
                            ],
                        ],
                    ]);
                } else {
                    $this->nested->filter(QueryHelper::queryString($tag, ['beatmaps.top_tags'], 'and'));
                }
            }
        }

        if ($excludeTags !== null) {
            $tags = array_reject_null($excludeTags);

            foreach ($tags as $tag) {
                if (mb_strpos($tag, '/') !== false) {
                    $this->nestedMustNot->should([
                        'term' => [
                            'beatmaps.top_tags.raw' => [
                                'case_insensitive' => true,
                                'value' => mb_trim($tag, '"'),
                            ],
                        ],
                    ]);
                } else {
                    $this->nestedMustNot->should(QueryHelper::queryString($tag, ['beatmaps.top_tags'], 'or'));
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
            return $query->distinct('beatmap_id')->pluck('beatmap_id');
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
