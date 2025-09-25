<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\Sort;
use App\Libraries\Elasticsearch\Utils\SearchAfterParam;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Genre;
use App\Models\Language;
use App\Models\User;
use App\Models\UserProfileCustomization;

class BeatmapsetSearchRequestParams extends BeatmapsetSearchParams
{
    const AVAILABLE_STATUSES = ['any', 'leaderboard', 'ranked', 'qualified', 'loved', 'favourites', 'pending', 'wip', 'graveyard', 'mine'];
    const AVAILABLE_EXTRAS = ['video', 'storyboard'];
    const AVAILABLE_GENERAL = ['recommended', 'converts', 'follows', 'spotlights', 'featured_artists'];
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

        $params = get_params($request, null, [
            'c',
            'e',
            'g:int',
            'l:int',
            'm:int',
            'nsfw:bool',
            'page:int',
            'played',
            'q',
            'query',
            'r',
            's',
            'sort',
        ], ['null_missing' => true]);
        $this->user = $user;
        $this->page = $params['page'];
        $this->from = $this->pageAsFrom($this->page);
        $this->requestQuery = $params['q'] ?? $params['query'];

        $sort = $params['sort'];

        if (priv_check_user($this->user, 'BeatmapsetAdvancedSearch')->can()) {
            $this->parseQuery();
            $status = $params['s'];
            $this->status = static::LEGACY_STATUS_MAP[$status] ?? $status;

            $this->genre = $params['g'];
            $this->language = $params['l'];
            $this->extra = array_intersect(
                explode('.', $params['e'] ?? ''),
                $validExtras
            );

            $this->mode = $params['m'];
            if (!in_array($this->mode, Beatmap::MODES, true)) {
                $this->mode = null;
            }

            $generals = explode('.', $params['c'] ?? '');
            $this->includeConverts = in_array('converts', $generals, true);
            $this->showFeaturedArtists = in_array('featured_artists', $generals, true);
            $this->showFollows = in_array('follows', $generals, true);
            $this->showRecommended = in_array('recommended', $generals, true);
            $this->showSpotlights = in_array('spotlights', $generals, true);

            $this->includeNsfw = $params['nsfw']
                ?? UserProfileCustomization::forUser($user)['beatmapset_show_nsfw'];
        } else {
            $sort = null;
        }

        $this->parseSort($sort);
        $this->searchAfter = SearchAfterParam::make($this, cursor_from_params($request));

        // Supporter-only options.
        $this->rank = array_intersect(
            explode('.', $params['r'] ?? ''),
            $validRanks
        );

        $this->playedFilter = $params['played'];
        if (!in_array($this->playedFilter, static::PLAYED_STATES, true)) {
            $this->playedFilter = null;
        }
    }

    public static function getAvailableFilters()
    {
        $languages = Language::listing();
        $genres = Genre::listing();

        $modes = [['id' => null, 'name' => osu_trans('beatmaps.mode.any')]];
        foreach (Beatmap::MODES as $name => $id) {
            $modes[] = ['id' => $id, 'name' => osu_trans("beatmaps.mode.{$name}")];
        }

        $extras = [];
        $general = [];
        $played = [];
        $ranks = [];
        $statuses = [];

        foreach (static::AVAILABLE_EXTRAS as $id) {
            $extras[] = ['id' => $id, 'name' => osu_trans("beatmaps.extra.{$id}")];
        }

        foreach (static::AVAILABLE_GENERAL as $id) {
            $general[] = ['id' => $id, 'name' => osu_trans("beatmaps.general.{$id}")];
        }

        foreach (static::AVAILABLE_PLAYED as $id) {
            $played[] = ['id' => $id, 'name' => osu_trans("beatmaps.played.{$id}")];
        }

        foreach (static::AVAILABLE_RANKS as $id) {
            $ranks[] = ['id' => $id, 'name' => osu_trans("beatmaps.rank.{$id}")];
        }

        foreach (static::AVAILABLE_STATUSES as $id) {
            $statuses[] = ['id' => $id, 'name' => osu_trans("beatmaps.status.{$id}")];
        }

        $nsfw = [
            ['id' => false, 'name' => osu_trans('beatmaps.nsfw.exclude')],
            ['id' => true, 'name' => osu_trans('beatmaps.nsfw.include')],
        ];

        return compact('extras', 'general', 'genres', 'languages', 'modes', 'nsfw', 'played', 'ranks', 'statuses');
    }

    public function getSort(): ?string
    {
        if ($this->sortField !== null && $this->sortOrder !== null) {
            return "{$this->sortField}_{$this->sortOrder}";
        }

        return null;
    }

    public function isLoginRequired(): bool
    {
        return present($this->requestQuery);
    }

    private function getDefaultSortField(): string
    {
        if (present($this->queryString) || present($this->includes->artist) || present($this->includes->creator) || present($this->includes->title)) {
            return 'relevance';
        }

        if ($this->status === 'qualified') {
            return 'ranked';
        }

        if (in_array($this->status, ['pending', 'wip', 'graveyard', 'mine'], true)) {
            return 'updated';
        }

        return 'ranked';
    }

    private function parseQuery(): void
    {
        $parser = new BeatmapsetQueryParser($this->requestQuery);

        $this->queryString = $parser->keywords;
        $this->includes = $parser->includes;
        $this->excludes = $parser->excludes;
    }

    private function parseSort(?string $value): void
    {
        $array = explode('_', $value ?? '');
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
        $this->sorts[] = new Sort('id', $sort->order);

        foreach ($this->sorts as $sort) {
            if ((Beatmapset::CASTS[$sort->field] ?? null) === 'datetime') {
                $sort->extras['missing'] = 0;
            }
        }
    }
}
