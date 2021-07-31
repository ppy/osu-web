<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Beatmap;
use App\Models\Country;
use App\Models\CountryStatistics;
use App\Models\Spotlight;
use App\Models\UserStatistics;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @group Ranking
 */
class RankingController extends Controller
{
    private $country;
    private $countryStats;
    private $params;
    private $friendsOnly;

    const PAGE_SIZE = 50;
    const MAX_RESULTS = 10000;
    const RANKING_TYPES = ['performance', 'charts', 'score', 'country'];
    const SPOTLIGHT_TYPES = ['charts'];

    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public');

        $this->middleware(function ($request, $next) {
            $this->params = get_params(array_merge($request->all(), $request->route()->parameters()), null, [
                'country', // overridden later for view
                'filter',
                'mode',
                'spotlight:int', // will be overriden by spotlight object for view
                'type',
                'variant',
            ]);

            // these parts of the route are optional.
            $mode = $this->params['mode'] ?? null;
            $type = $this->params['type'] ?? null;

            $this->params['filter'] = $this->params['filter'] ?? null;
            $this->friendsOnly = auth()->check() && $this->params['filter'] === 'friends';
            $this->setVariantParam();

            view()->share('hasPager', !in_array($type, static::SPOTLIGHT_TYPES, true));
            view()->share('spotlight', null); // so variable capture in selector function doesn't die when spotlight is null.
            view()->share($this->params); // won't set null values

            if ($mode === null) {
                return ujs_redirect(route('rankings', ['mode' => default_mode(), 'type' => 'performance']));
            }

            if (!Beatmap::isModeValid($mode)) {
                abort(404);
            }

            if ($type === null) {
                return ujs_redirect(route('rankings', ['mode' => $mode, 'type' => 'performance']));
            }

            if (!in_array($type, static::RANKING_TYPES, true)) {
                abort(404);
            }

            if (isset($this->params['country']) && $type === 'performance') {
                $this->countryStats = CountryStatistics::where('display', 1)
                    ->where('country_code', $this->params['country'])
                    ->where('mode', Beatmap::modeInt($mode))
                    ->first();

                if ($this->countryStats === null) {
                    return ujs_redirect(route('rankings', ['mode' => $mode, 'type' => $type]));
                }

                $this->country = $this->countryStats->country;
            }

            view()->share('country', $this->country);

            return $next($request);
        });
    }

    /**
     * Get Ranking
     *
     * Gets the current ranking for the specified type and game mode.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [Rankings](#rankings)
     *
     * @urlParam mode string required [GameMode](#gamemode). Example: mania
     * @urlParam type string required [RankingType](#rankingtype). Example: performance
     *
     * @queryParam country Filter ranking by country code. Only available for `type` of `performance`. Example: JP
     * @queryParam cursor [Cursor](#cursor). No-example
     * @queryParam filter Either `all` (default) or `friends`. Example: all
     * @queryParam spotlight The id of the spotlight if `type` is `charts`. Ranking for latest spotlight will be returned if not specified. No-example
     * @queryParam variant Filter ranking to specified mode variant. For `mode` of `mania`, it's either `4k` or `7k`. Only available for `type` of `performance`. Example: 4k
     */
    public function index($mode, $type)
    {
        if ($type === 'charts') {
            return $this->spotlight($mode);
        }

        $modeInt = Beatmap::modeInt($mode);

        if ($type === 'country') {
            $stats = CountryStatistics::where('display', 1)
                ->with('country')
                ->where('mode', $modeInt)
                ->orderBy('performance', 'desc');
        } else {
            $class = UserStatistics\Model::getClass($mode, $this->params['variant']);
            $table = (new $class())->getTable();
            $stats = $class
                ::with(['user', 'user.country'])
                ->whereHas('user', function ($userQuery) {
                    $userQuery->default();
                });

            if ($type === 'performance') {
                if ($this->country !== null) {
                    $stats->where('country_acronym', $this->country['acronym']);
                    // preferrable to rank_score when filtering by country.
                    // On a few countries the default index is slightly better but much worse on the rest.
                    $forceIndex = 'country_acronym_2';
                } else {
                    // force to order by rank_score instead of sucking down entire users table first.
                    $forceIndex = 'rank_score';
                }

                $stats->orderBy('rank_score', 'desc');
            } else { // 'score'
                $stats->orderBy('ranked_score', 'desc');
                // force to order by ranked_score instead of sucking down entire users table first.
                $forceIndex = 'ranked_score';
            }

            if ($this->friendsOnly) {
                $stats->friendsOf(auth()->user());
                // still uses temporary table and filesort but over a more limited number of rows.
                $forceIndex = null;
            }

            if (isset($forceIndex)) {
                $stats->from(DB::raw("{$table} FORCE INDEX ($forceIndex)"));
            }

            if (is_api_request()) {
                $stats->with(['user.userProfileCustomization']);
            }
        }

        $maxResults = $this->maxResults($modeInt, $stats);
        $maxPages = ceil($maxResults / static::PAGE_SIZE);
        // TODO: less repeatedly getting params out of request.
        $page = clamp(get_int(request('cursor.page') ?? request('page')), 1, $maxPages);

        $stats = $stats->limit(static::PAGE_SIZE)
            ->offset(static::PAGE_SIZE * ($page - 1))
            ->get();

        if (is_api_request()) {
            switch ($type) {
                case 'country':
                    $ranking = json_collection($stats, 'CountryStatistics', ['country']);
                    break;

                default:
                    $ranking = json_collection($stats, 'UserStatistics', ['user', 'user.cover', 'user.country']);
                    break;
            }

            return [
                // TODO: switch to offset?
                'cursor' => empty($ranking) || ($page >= $maxPages) ? null : ['page' => $page + 1],
                'ranking' => $ranking,
                'total' => $maxResults,
            ];
        }

        $scores = new LengthAwarePaginator(
            $stats,
            $maxPages * static::PAGE_SIZE,
            static::PAGE_SIZE,
            $page,
            ['path' => route('rankings', [
                'filter' => $this->params['filter'],
                'mode' => $mode,
                'type' => $type,
                'variant' => $this->params['variant'],
            ])]
        );

        $countries = json_collection($this->getCountries($mode), 'Country', ['display']);

        return ext_view("rankings.{$type}", compact('countries', 'scores'));
    }

    public function spotlight($mode)
    {
        $chartId = $this->params['spotlight'] ?? null;

        $spotlights = Spotlight::orderBy('chart_id', 'desc')->get();
        if ($chartId === null) {
            $spotlight = $spotlights->first();
        } else {
            $spotlight = Spotlight::findOrFail($chartId);
        }

        if ($spotlight->hasMode($mode)) {
            $beatmapsets = $spotlight->beatmapsets($mode)->with('beatmaps')->get();
            $scores = $spotlight->ranking($mode);

            if ($this->friendsOnly) {
                $scores->friendsOf(auth()->user());
            }

            if (is_api_request()) {
                $scores = $scores->with(['user.userProfileCustomization'])->get();

                return [
                    // transformer can't do nested includes with params properly.
                    // https://github.com/thephpleague/fractal/issues/239
                    'beatmapsets' => json_collection($beatmapsets, 'Beatmapset', ['beatmaps']),
                    'ranking' => json_collection($scores, 'UserStatistics', ['user', 'user.cover', 'user.country']),
                    'spotlight' => json_item($spotlight, 'Spotlight', ["participant_count:mode({$mode})"]),
                ];
            } else {
                $scores = $scores->get();
                $scoreCount = $spotlight->participantCount($mode);
            }
        } else {
            if (is_api_request()) {
                abort(404);
            }

            $beatmapsets = collect();
            $scores = collect();
            $scoreCount = 0;
        }

        $selectOptions = [
            'selected' => $this->optionFromSpotlight($spotlight),
            'options' => $spotlights->map(function ($s) {
                return $this->optionFromSpotlight($s);
            }),
        ];

        return ext_view(
            'rankings.charts',
            compact('scores', 'scoreCount', 'selectOptions', 'spotlight', 'beatmapsets')
        );
    }

    private function getCountries(string $mode)
    {
        $relation = 'statistics'.title_case($mode);

        return Country::where('display', '>', 0)->whereHas($relation, function ($query) {
            $query->where('display', true);
        })->get();
    }

    private function optionFromSpotlight(Spotlight $spotlight): array
    {
        return ['id' => $spotlight->chart_id, 'text' => $spotlight->name];
    }

    private function maxResults($modeInt, $stats)
    {
        if ($this->friendsOnly) {
            return $stats->count();
        }

        if ($this->params['type'] === 'country') {
            return CountryStatistics::where('display', 1)
                ->where('mode', $modeInt)
                ->count();
        }

        $maxResults = static::MAX_RESULTS;

        if ($this->params['variant'] !== null) {
            $countryCode = optional($this->country)->getKey() ?? '_all';
            $cacheKey = "ranking_count:{$this->params['type']}:{$this->params['mode']}:{$this->params['variant']}:{$countryCode}";

            return cache_remember_mutexed($cacheKey, 300, $maxResults, function () use ($maxResults, $stats) {
                return min($stats->count(), $maxResults);
            });
        }

        if ($this->countryStats !== null) {
            return min($this->countryStats->user_count, $maxResults);
        }

        return $maxResults;
    }

    private function setVariantParam()
    {
        $variant = presence($this->params['variant'] ?? null);
        $type = $this->params['type'] ?? null;
        $mode = $this->params['mode'] ?? null;

        if ($type !== 'performance' || !Beatmap::isVariantValid($mode, $variant)) {
            $variant = null;
        }

        $this->params['variant'] = $variant;
    }
}
