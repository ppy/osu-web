<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Beatmap;
use App\Models\Country;
use App\Models\CountryStatistics;
use App\Models\Model;
use App\Models\Spotlight;
use App\Models\TeamStatistics;
use App\Models\User;
use App\Models\UserStatistics;
use App\Transformers\SelectOptionTransformer;
use App\Transformers\TeamStatisticsTransformer;
use App\Transformers\UserCompactTransformer;
use App\Transformers\UserStatisticsTransformer;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @group Ranking
 */
class RankingController extends Controller
{
    private $country;
    private $countryStats;
    private array $defaultViewVars;
    private $params;
    private $friendsOnly;

    const MAX_RESULTS = 10000;
    const PAGE_SIZE = Model::PER_PAGE;
    const RANKING_TYPES = ['performance', 'charts', 'score', 'country', 'team'];
    const SPOTLIGHT_TYPES = ['charts'];
    // in display order
    const TYPES = [
        'performance',
        'score',
        'country',
        'team',
        'multiplayer',
        'daily_challenge',
        'seasons',
        'charts',
        'kudosu',
    ];

    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public');

        $this->middleware(function ($request, $next) {
            $this->params = [
                ...get_params($request->all(), null, [
                    'country', // overridden later for view
                    'filter',
                    'spotlight:int', // will be overriden by spotlight object for view
                    'variant',
                ]),
                ...get_params($request->route()->parameters(), null, [
                    'mode',
                    'sort',
                    'type',
                ], ['null_missing' => true]),
            ];

            // these parts of the route are optional.
            $mode = $this->params['mode'];
            $type = $this->params['type'];

            $this->params['filter'] = $this->params['filter'] ?? null;
            $this->friendsOnly = auth()->check() && $this->params['filter'] === 'friends';
            $this->setVariantParam();

            $this->defaultViewVars = array_merge([
                'hasPager' => !in_array($type, static::SPOTLIGHT_TYPES, true),
                // so variable capture in selector function doesn't die when spotlight is null.
                'spotlight' => null,
            ], $this->params);

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

            if (isset($this->params['country']) && static::hasCountryFilter($type)) {
                $this->countryStats = CountryStatistics::where('display', 1)
                    ->where('country_code', $this->params['country'])
                    ->where('mode', Beatmap::modeInt($mode))
                    ->first();

                if ($this->countryStats === null) {
                    return ujs_redirect(route('rankings', ['mode' => $mode, 'type' => $type]));
                }

                $this->country = $this->countryStats->country;
            }

            $this->defaultViewVars['country'] = $this->country;
            if (static::hasCountryFilter($type)) {
                $this->defaultViewVars['countries'] = json_collection(
                    Country::whereHasRuleset($mode)->get(),
                    new SelectOptionTransformer(),
                );
            }

            return $next($request);
        }, ['except' => ['kudosu']]);
    }

    public static function url(
        string $type,
        string $rulesetName,
        ?Country $country = null,
        ?Spotlight $spotlight = null,
        ?string $sort = null,
    ): string {
        return match ($type) {
            'country' => route('rankings', ['mode' => $rulesetName, 'type' => $type]),
            'daily_challenge' => route('daily-challenge.index'),
            'kudosu' => route('rankings.kudosu'),
            'multiplayer' => route('multiplayer.rooms.show', ['room' => 'latest']),
            'seasons' => route('seasons.show', ['season' => 'latest']),
            default => route('rankings', [
                'country' => $country !== null && static::hasCountryFilter($type) ? $country->getKey() : null,
                'mode' => $rulesetName,
                'sort' => $sort,
                'spotlight' => $spotlight !== null && $type === 'charts' ? $spotlight->getKey() : null,
                'type' => $type,
            ]),
        };
    }

    private static function hasCountryFilter(string $type): bool
    {
        return $type === 'performance' || $type === 'score';
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
     * @urlParam mode string required [Ruleset](#ruleset). Example: mania
     * @urlParam type string required [RankingType](#rankingtype). Example: performance
     *
     * @queryParam country string Filter ranking by country code. Only available for `type` of `performance`. Example: JP
     * @queryParam cursor [Cursor](#cursor). No-example
     * @queryParam filter Either `all` (default) or `friends`. Example: all
     * @queryParam spotlight The id of the spotlight if `type` is `charts`. Ranking for latest spotlight will be returned if not specified. No-example
     * @queryParam variant Filter ranking to specified mode variant. For `mode` of `mania`, it's either `4k` or `7k`. Only available for `type` of `performance`. Example: 4k
     */
    public function index($mode, $type, ?string $sort = null)
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
        } elseif ($type === 'team') {
            $sort = $sort === 'score' ? 'score' : 'performance';
            $sortColumn = $sort === 'score' ? 'ranked_score' : 'performance';
            $stats = TeamStatistics::where('ranked_score', '>', 0)
                ->where('ruleset_id', $modeInt)
                ->whereHas('team')
                ->withCount('members')
                ->with('team')
                ->orderBy($sortColumn, 'desc');
        } else {
            $class = UserStatistics\Model::getClass($mode, $this->params['variant']);
            $table = (new $class())->getTable();
            $stats = $class
                ::with(['user', 'user.country', 'user.team'])
                ->where('rank_score', '>', 0)
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
                if ($this->country !== null) {
                    $stats->where('country_acronym', $this->country['acronym']);
                    // preferrable to ranked_score when filtering by country.
                    // On a few countries the default index is slightly better but much worse on the rest.
                    $forceIndex = 'country_ranked_score';
                } else {
                    // force to order by ranked_score instead of sucking down entire users table first.
                    $forceIndex = 'ranked_score';
                }

                $stats->orderBy('ranked_score', 'desc');
            }

            if ($this->friendsOnly) {
                $stats->friendsOf(auth()->user());
                // still uses temporary table and filesort but over a more limited number of rows.
                $forceIndex = null;
            }

            if (isset($forceIndex)) {
                $stats->from(DB::raw("{$table} FORCE INDEX ($forceIndex)"));
            }
        }

        $maxResults = $this->maxResults($modeInt, $stats);
        $maxPages = ceil($maxResults / static::PAGE_SIZE);
        $params = get_params(\Request::all(), null, ['cursor.page:int', 'page:int']);
        $page = \Number::clamp($params['cursor']['page'] ?? $params['page'] ?? 1, 1, $maxPages);

        $stats = $stats->limit(static::PAGE_SIZE)
            ->offset(static::PAGE_SIZE * ($page - 1))
            ->get();

        $showRankChange =
            $type === 'performance' &&
            $this->country === null &&
            !$this->friendsOnly &&
            $this->params['variant'] === null;

        if ($showRankChange) {
            $stats->loadMissing('rankHistory.currentStart');

            foreach ($stats as $stat) {
                // Set rankHistory.user.statistics{ruleset} relation
                $stat->rankHistory?->setRelation('user', $stat->user);
                $stat->user->setRelation(User::statisticsRelationName($mode), $stat);
            }
        }

        if (is_api_request()) {
            switch ($type) {
                case 'country':
                    $ranking = json_collection($stats, 'CountryStatistics', ['country']);
                    break;

                case 'team':
                    $ranking = json_collection($stats, new TeamStatisticsTransformer(), ['member_count', 'team']);
                    break;

                default:
                    $includes = UserStatisticsTransformer::RANKING_INCLUDES;

                    if ($this->country !== null) {
                        $includes[] = 'country_rank';
                        $startRank = (max($page, 1) - 1) * static::PAGE_SIZE + 1;
                        foreach ($stats as $index => $entry) {
                            $entry->countryRank = $startRank + $index;
                        }
                    }

                    if ($showRankChange) {
                        $includes[] = 'rank_change_since_30_days';
                    }

                    $ranking = json_collection($stats, new UserStatisticsTransformer(), $includes);
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
                'sort' => $sort,
                'type' => $type,
                'variant' => $this->params['variant'],
            ])]
        );

        return ext_view(
            "rankings.{$type}",
            array_merge(
                $this->defaultViewVars,
                compact('scores', 'sort', 'showRankChange'),
            ),
        );
    }

    /**
     * Get Kudosu Ranking
     *
     * Gets the kudosu ranking.
     *
     * ---
     *
     * ### Response format
     *
     * Field   | Type            | Description
     * ------- | --------------- | -----------
     * ranking | [User](#user)[] | Includes `kudosu`.
     *
     * @queryParam page Ranking page. Example: 1
     */
    public function kudosu()
    {
        static $maxResults = 1000;

        $maxPage = $maxResults / static::PAGE_SIZE;
        $page = min(get_int(request('page')) ?? 1, $maxPage);

        $scores = User::default()
            ->with('team')
            ->orderBy('osu_kudostotal', 'desc')
            ->paginate(static::PAGE_SIZE, ['*'], 'page', $page, $maxResults);

        if (is_json_request()) {
            return ['ranking' => json_collection(
                $scores,
                new UserCompactTransformer(),
                'kudosu',
            )];
        }

        return ext_view('rankings.kudosu', compact('scores'));
    }

    public function spotlight($mode)
    {
        $chartId = get_int($this->params['spotlight'] ?? null);

        $spotlights = Spotlight::orderBy('chart_id', 'desc')->get();
        if ($chartId === null) {
            $spotlight = $spotlights->first() ?? abort(404);
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
                return [
                    // transformer can't do nested includes with params properly.
                    // https://github.com/thephpleague/fractal/issues/239
                    'beatmapsets' => json_collection($beatmapsets, 'Beatmapset', ['beatmaps']),
                    'ranking' => json_collection(
                        $scores->get(),
                        new UserStatisticsTransformer(),
                        UserStatisticsTransformer::RANKING_INCLUDES,
                    ),
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

        $selectOptionTransformer = new SelectOptionTransformer();
        $selectOptions = [
            'currentItem' => json_item($spotlight, $selectOptionTransformer),
            'items' => json_collection($spotlights, $selectOptionTransformer),
            'type' => 'spotlight',
        ];

        return ext_view(
            'rankings.charts',
            array_merge($this->defaultViewVars, compact(
                'beatmapsets',
                'scoreCount',
                'scores',
                'selectOptions',
                'spotlight',
            ))
        );
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

        if ($this->params['type'] === 'team') {
            return TeamStatistics::where('ruleset_id', $modeInt)->where('ranked_score', '>', 0)->count();
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
