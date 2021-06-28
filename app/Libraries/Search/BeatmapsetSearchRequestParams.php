<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Exceptions\InvariantException;
use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\Sort;
use App\Models\Beatmap;
use App\Models\Genre;
use App\Models\Language;
use App\Models\User;

class BeatmapsetSearchRequestParams extends BeatmapsetSearchParams
{
    const AVAILABLE_STATUSES = ['any', 'leaderboard', 'ranked', 'qualified', 'loved', 'favourites', 'pending', 'graveyard', 'mine'];
    const AVAILABLE_EXTRAS = ['video', 'storyboard'];
    const AVAILABLE_GENERAL = ['recommended', 'converts', 'follows'];
    const AVAILABLE_PLAYED = ['any', 'played', 'unplayed'];
    const AVAILABLE_RANKS = ['XH', 'X', 'SH', 'S', 'A', 'B', 'C', 'D'];

    const LEGACY_STATUS_MAP = [
        '0' => 'ranked',
        '2' => 'favourites',
        '3' => 'qualified',
        '4' => 'pending',
        '5' => 'graveyard',
        '6' => 'mine',
        '7' => 'any',
        '8' => 'loved',
    ];

    const SORT_FIELD_MAP = [
        'artist' => 'artist.raw',
        'creator' => 'creator.raw',
        'difficulty' => 'beatmaps.difficultyrating',
        'favourites' => 'favourite_count',
        'nominations' => 'nominations',
        'plays' => 'play_count',
        'ranked' => 'approved_date',
        'rating' => 'rating',
        'relevance' => '_score',
        'title' => 'title.raw',
        'updated' => 'last_update',
    ];

    private $requestQuery;

    /** @var string|null */
    private $sortField;
    /** @var string|null */
    private $sortOrder;

    public function __construct(array $request, ?User $user = null)
    {
        parent::__construct();

        static $validExtras = ['video', 'storyboard'];
        static $validRanks = ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH'];

        $this->user = $user;
        $this->page = get_int($request['page'] ?? null);
        $this->from = $this->pageAsFrom($this->page);
        $this->requestQuery = $request['q'] ?? $request['query'] ?? null;

        $sort = $request['sort'] ?? null;

        if (priv_check_user($this->user, 'BeatmapsetAdvancedSearch')->can()) {
            $this->parseQuery();
            $status = presence($request['s'] ?? null);
            $this->status = static::LEGACY_STATUS_MAP[$status] ?? $status;

            $this->genre = get_int($request['g'] ?? null);
            $this->language = get_int($request['l'] ?? null);
            $this->extra = array_intersect(
                explode('.', $request['e'] ?? null),
                $validExtras
            );

            $this->mode = get_int($request['m'] ?? null);
            if (!in_array($this->mode, Beatmap::MODES, true)) {
                $this->mode = null;
            }

            $generals = explode('.', $request['c'] ?? null) ?? [];
            $this->includeConverts = in_array('converts', $generals, true);
            $this->showFollows = in_array('follows', $generals, true);
            $this->showRecommended = in_array('recommended', $generals, true);

            $includeNsfw = get_bool($request['nsfw'] ?? null);
            if (!isset($includeNsfw) && $user !== null && $user->userProfileCustomization !== null) {
                $includeNsfw = $user->userProfileCustomization->beatmapset_show_nsfw;
            }

            if (isset($includeNsfw)) {
                $this->includeNsfw = $includeNsfw;
            }
        } else {
            $sort = null;
        }

        $this->parseSort($sort);
        $this->searchAfter = $this->getSearchAfter($request['cursor'] ?? null);

        // Supporter-only options.
        $this->rank = array_intersect(
            explode('.', $request['r'] ?? null),
            $validRanks
        );

        $this->playedFilter = $request['played'] ?? null;
        if (!in_array($this->playedFilter, static::PLAYED_STATES, true)) {
            $this->playedFilter = null;
        }
    }

    public static function getAvailableFilters()
    {
        $languages = Language::listing();
        $genres = Genre::listing();

        $modes = [['id' => null, 'name' => trans('beatmaps.mode.any')]];
        foreach (Beatmap::MODES as $name => $id) {
            $modes[] = ['id' => $id, 'name' => trans("beatmaps.mode.{$name}")];
        }

        $extras = [];
        $general = [];
        $played = [];
        $ranks = [];
        $statuses = [];

        foreach (static::AVAILABLE_EXTRAS as $id) {
            $extras[] = ['id' => $id, 'name' => trans("beatmaps.extra.{$id}")];
        }

        foreach (static::AVAILABLE_GENERAL as $id) {
            $general[] = ['id' => $id, 'name' => trans("beatmaps.general.{$id}")];
        }

        foreach (static::AVAILABLE_PLAYED as $id) {
            $played[] = ['id' => $id, 'name' => trans("beatmaps.played.{$id}")];
        }

        foreach (static::AVAILABLE_RANKS as $id) {
            $ranks[] = ['id' => $id, 'name' => trans("beatmaps.rank.{$id}")];
        }

        foreach (static::AVAILABLE_STATUSES as $id) {
            $statuses[] = ['id' => $id, 'name' => trans("beatmaps.status.{$id}")];
        }

        $nsfw = [
            ['id' => false, 'name' => trans('beatmaps.nsfw.exclude')],
            ['id' => true, 'name' => trans('beatmaps.nsfw.include')],
        ];

        return compact('extras', 'general', 'genres', 'languages', 'modes', 'nsfw', 'played', 'ranks', 'statuses');
    }

    public function getSort(): ?string
    {
        if ($this->sortField !== null && $this->sortOrder !== null) {
            return "{$this->sortField}_{$this->sortOrder}";
        }
    }

    public function isLoginRequired(): bool
    {
        return present($this->requestQuery);
    }

    private function getDefaultSortField(): string
    {
        if (present($this->queryString) || present($this->artist) || present($this->creator)) {
            return 'relevance';
        }

        if ($this->status === 'qualified') {
            return 'ranked';
        }

        if (in_array($this->status, ['pending', 'graveyard', 'mine'], true)) {
            return 'updated';
        }

        return 'ranked';
    }

    /**
     * Extract search_after out of cursor param. Cursor values that are not part of the sort are ignored.
     *
     * The search_after value passed to elasticsearch needs to be the same length as the number of
     * sorts given.
     */
    private function getSearchAfter($cursor): ?array
    {
        if (!is_array($cursor)) {
            return null;
        }

        $searchAfter = [];
        /** @var Sort $sort */
        foreach ($this->sorts as $sort) {
            $value = $cursor[$sort->field] ?? null;
            if ($value === null) {
                throw new InvariantException('Cursor parameters do not match sort parameters.');
            }

            $searchAfter[] = $value;
        }

        return $searchAfter;
    }

    private function parseQuery(): void
    {
        static $optionMap = [
            'ar' => 'ar',
            'artist' => 'artist',
            'bpm' => 'bpm',
            'created' => 'created',
            'creator' => 'creator',
            'cs' => 'cs',
            'dr' => 'drain',
            'keys' => 'keys',
            'length' => 'hitLength',
            'od' => 'accuracy',
            'ranked' => 'ranked',
            'stars' => 'difficultyRating',
            'status' => 'statusRange',
        ];

        $parsed = BeatmapsetQueryParser::parse($this->requestQuery);

        $this->queryString = $parsed['keywords'];

        foreach ($parsed['options'] as $optionKey => $optionValue) {
            $propName = $optionMap[$optionKey] ?? null;

            if ($propName !== null) {
                $this->$propName = $optionValue;
            }
        }
    }

    private function parseSort(?string $value): void
    {
        $array = explode('_', $value);
        $this->sortField = $array[0];
        $this->sortOrder = $array[1] ?? null;

        if (!array_key_exists($this->sortField, static::SORT_FIELD_MAP)) {
            $this->sortField = $this->getDefaultSortField();
        }

        if (!in_array($this->sortOrder, ['asc', 'desc'], true)) {
            $this->sortOrder = 'desc';
        }

        $this->setSorts();
    }

    /**
     * Set sort parameters for the elasticsearch query.
     */
    private function setSorts(): void
    {
        // additional options
        static $orderOptions = [
            'beatmaps.difficultyrating' => [
                'asc' => ['mode' => 'min'],
                'desc' => ['mode' => 'max'],
            ],
        ];

        $sort = new Sort(static::SORT_FIELD_MAP[$this->sortField], $this->sortOrder);

        // assign sort modes if any.
        $options = ($orderOptions[$sort->field] ?? [])[$sort->order] ?? [];

        // use relevant mode when sorting on nested field
        if (starts_with($sort->field, 'beatmaps.')) {
            $sortFilter = new BoolQuery();

            if (!$this->includeConverts) {
                $sortFilter->filter(['term' => ['beatmaps.convert' => false]]);
            }

            if ($this->mode !== null) {
                $sortFilter->filter(['term' => ['beatmaps.playmode' => $this->mode]]);
            }

            $options['nested'] = [
                'path' => 'beatmaps',
                'filter' => $sortFilter->toArray(),
            ];
        }

        if ($options !== []) {
            $sort->extras = $options;
        }

        $this->sorts = [$sort];

        // append/prepend extra sort orders.
        if ($sort->field === 'nominations') {
            $this->sorts[] = new Sort('hype', $sort->order);
        } elseif ($sort->field === 'approved_date' && $this->status === 'qualified') {
            array_unshift($this->sorts, new Sort('queued_at', $sort->order));
        }

        // generic tie-breaker.
        $this->sorts[] = new Sort('_id', $sort->order);
    }
}
