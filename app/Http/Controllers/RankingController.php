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
use App\Transformers\BeatmapsetTransformer;
use App\Transformers\CountryStatisticsTransformer;
use App\Transformers\SelectOptionTransformer;
use App\Transformers\SpotlightTransformer;
use App\Transformers\TeamStatisticsTransformer;
use App\Transformers\UserCompactTransformer;
use App\Transformers\UserStatisticsTransformer;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @group Ranking
 */
class RankingController extends Controller
{
    const MAX_RESULTS = 10000;
    const PAGE_SIZE = Model::PER_PAGE;
    // in display order
    const TYPES = [
        'global',
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
    }

    public static function url(
        array $params,
    ): string {
        return match ($params['type']) {
            'charts' => route('rankings', [
                'mode' => $params['mode'] ?? default_mode(),
                'type' => $params['type'],
            ]),
            'country' => route('rankings', [
                'mode' => $params['mode'] ?? default_mode(),
                'type' => $params['type'],
            ]),
            'daily_challenge' => route('daily-challenge.index'),
            'global' => route('rankings', [
                'mode' => $params['mode'] ?? default_mode(),
                'sort' => $params['sort'] ?? null,
                'type' => $params['type'],
            ]),
            'kudosu' => route('rankings.kudosu'),
            'multiplayer' => route('multiplayer.rooms.show', ['room' => 'latest']),
            'seasons' => route('seasons.show', ['season' => 'latest']),
            'team' => route('rankings', [
                'mode' => $params['mode'] ?? default_mode(),
                'type' => $params['type'],
                'sort' => $params['sort'] ?? null,
            ]),
        };
    }

    private static function getFilter(?string $filter): string
    {
        $filter ??= 'all';
        if (!in_array($filter, ['all', 'friends'], true)) {
            abort(422, 'invalid filter parameter specified');
        }

        return $filter;
    }

    private static function getSort(?string $sort, string $type): string
    {
        if (!in_array($type, ['global', 'team'], true) && $sort !== null) {
            abort(404, "sort option isn't available for {$type} ranking page");
        }

        $sort ??= 'performance';
        if (!in_array($sort, ['performance', 'score'], true)) {
            abort(422, 'invalid sort parameter specified');
        }

        return $sort;
    }

    private static function getVariant(?string $variant, $ruleset): ?string
    {
        if ($variant === 'all') {
            return null;
        }

        if (!Beatmap::isVariantValid($ruleset, $variant)) {
            abort(422, 'invalid variant parameter specified');
        }

        return $variant;
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
     * @urlParam ruleset string required [Ruleset](#ruleset). Example: mania
     * @urlParam type string required [RankingType](#rankingtype). Example: global
     *
     * @queryParam country string Filter ranking by country code. Only available for `type` of `global`. Example: JP
     * @queryParam cursor [Cursor](#cursor). No-example
     * @queryParam filter Either `all` (default) or `friends`. Example: all
     * @queryParam spotlight The id of the spotlight if `type` is `charts`. Ranking for latest spotlight will be returned if not specified. No-example
     * @queryParam variant Filter ranking to specified mode variant. For `ruleset` of `mania`, it's either `4k` or `7k`. Only available for `type` of `global`. Example: 4k
     */
    public function index(?string $mode = null, ?string $type = null, ?string $sort = null)
    {
        $rawParams = \Request::instance()->query->all();
        // it's more convenient to lump both route (path) and query params in one array
        $params = compact('mode', 'sort', 'type');

        if ($mode === null) {
            return ujs_redirect(route('rankings', [
                ...$rawParams,
                ...$params,
                'mode' => default_mode(),
                'type' => 'global',
            ]));
        }

        if ($type === null) {
            return ujs_redirect(route('rankings', [
                ...$rawParams,
                ...$params,
                'type' => 'global',
            ]));
        }

        if (!Beatmap::isModeValid($mode)) {
            abort(404, 'invalid ruleset specified');
        }

        $isApi = is_api_request();
        if ($params['type'] === 'performance' || $params['type'] === 'score') {
            $params['sort'] = $params['type'];
            $params['type'] = 'global';

            if (!$isApi) {
                return ujs_redirect(route('rankings', [...$rawParams, ...$params]));
            }
        }
        if (!in_array($params['type'], ['chart', 'country', 'global', 'team'], true)) {
            abort(404, 'invalid type specified');
        }

        $params['sort'] = static::getSort($params['sort'], $params['type']);

        $rulesetId = Beatmap::modeInt($params['mode']);

        switch ($params['type']) {
            case 'charts':
                return $this->spotlight($params, $rawParams, $isApi);
            case 'country':
                $stats = CountryStatistics::where('display', 1)
                    ->with('country')
                    ->where('mode', $rulesetId)
                    ->orderByDesc('performance');
                break;
            case 'team':
                $sortColumns = [
                    'performance' => 'performance',
                    'score' => 'ranked_score',
                ];
                $sortColumn = $sortColumns[$params['sort']];
                $stats = TeamStatistics::where('ranked_score', '>', 0)
                    ->where('ruleset_id', $rulesetId)
                    ->whereHas('team')
                    ->withCount('members')
                    ->with('team')
                    ->orderBy($sortColumn, 'desc');
                break;
            case 'global':
                $params['country'] = get_string($rawParams['country'] ?? null);
                $params['filter'] = static::getFilter($rawParams['filter'] ?? null);
                $params['variant'] = static::getVariant($rawParams['variant'] ?? null, $mode);

                if ($params['country'] !== null) {
                    $countryStats = CountryStatistics::where('display', true)
                        ->where('country_code', $params['country'])
                        ->where('mode', $rulesetId)
                        ->firstOrFail();
                }

                $class = UserStatistics\Model::getClass($mode, $params['variant']);
                $stats = $class::with(['user', 'user.country', 'user.team'])
                    ->where('rank_score', '>', 0)
                    ->whereHas('user', fn ($q) => $q->default());

                if ($params['country'] === null) {
                    // force to order by rank(ed)_score instead of sucking down entire users table first.
                    $forceIndex = [
                        'performance' => 'rank_score',
                        'score' => 'ranked_score',
                    ];
                } else {
                    $stats->where('country_acronym', $params['country']);
                    // preferrable to rank(ed)_score when filtering by country.
                    // On a few countries the default index is slightly better but much worse on the rest.
                    $forceIndex = [
                        'performance' => 'country_acronym_2',
                        'score' => 'country_ranked_score',
                    ];
                }
                $sortColumns = [
                    'performance' => 'rank_score',
                    'score' => 'ranked_score',
                ];
                $stats->orderByDesc($sortColumns[$params['sort']]);

                if ($params['filter'] === 'friends') {
                    $stats->friendsOf(\Auth::user());
                    // still uses temporary table and filesort but over a more limited number of rows.
                    $forceIndex = null;
                }

                if (isset($forceIndex)) {
                    $table = (new $class())->getTable();
                    $stats->from(DB::raw("{$table} FORCE INDEX ({$forceIndex[$params['sort']]})"));
                }
                break;
        }

        $maxResults = $this->maxResults($rulesetId, $countryStats ?? null, $stats, $params);
        $maxPages = ceil($maxResults / static::PAGE_SIZE);
        $page = get_int(cursor_from_params($rawParams)['page'] ?? null)
            ?? get_int($rawParams['page'] ?? null)
            ?? 1;
        $page = \Number::clamp($page, 1, $maxPages);

        $stats = $stats->limit(static::PAGE_SIZE)
            ->offset(static::PAGE_SIZE * ($page - 1))
            ->get();

        $showRankChange =
            $params['type'] === 'global' &&
            $params['sort'] === 'performance' &&
            $params['country'] === null &&
            $params['filter'] === 'all' &&
            $params['variant'] === null;

        if ($showRankChange) {
            $stats->loadMissing('rankHistory.currentStart');

            foreach ($stats as $stat) {
                // Set rankHistory.user.statistics{ruleset} relation
                $stat->rankHistory?->setRelation('user', $stat->user);
                $stat->user->setRelation(User::statisticsRelationName($mode), $stat);
            }
        }

        if ($isApi) {
            switch ($params['type']) {
                case 'country':
                    $ranking = json_collection($stats, new CountryStatisticsTransformer(), ['country']);
                    break;

                case 'team':
                    $ranking = json_collection($stats, new TeamStatisticsTransformer(), ['member_count', 'team']);
                    break;

                case 'global':
                    $includes = UserStatisticsTransformer::RANKING_INCLUDES;

                    if ($params['country'] !== null) {
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
                ...cursor_for_response(
                    empty($ranking) || $page >= $maxPages ? null : ['page' => $page + 1],
                ),
                'ranking' => $ranking,
                'total' => $maxResults,
            ];
        }

        $scores = new LengthAwarePaginator(
            $stats,
            $maxPages * static::PAGE_SIZE,
            static::PAGE_SIZE,
            $page,
            ['path' => route('rankings', $params)],
        );

        $countryStats ??= null;

        return ext_view(
            "rankings.{$params['type']}",
            compact('countryStats', 'params', 'scores', 'sort', 'showRankChange'),
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

    private function maxResults(int $rulesetId, ?CountryStatistics $countryStats, Builder $stats, array $params): int
    {
        switch ($params['type']) {
            case 'country':
                return CountryStatistics::where('display', true)
                    ->where('mode', $rulesetId)
                    ->count();

            case 'team':
                return $stats->count();

            case 'global':
                if ($params['filter'] === 'friends') {
                    return $stats->count();
                }

                $maxResults = static::MAX_RESULTS;

                // use slower row count as there's no statistics entry for variants
                if ($params['variant'] !== null) {
                    sort($params);
                    $cacheKey = 'ranking_count:'.json_encode($params);

                    return cache_remember_mutexed(
                        $cacheKey,
                        300,
                        $maxResults,
                        fn () => min($stats->count(), $maxResults),
                    );
                }

                return $countryStats === null
                    ? $maxResults
                    : min($countryStats->user_count, $maxResults);
        }
    }

    private function spotlight(array $params, array $rawParams, bool $isApi)
    {
        $params['filter'] = static::getFilter($rawParams['filter'] ?? null);
        $params['spotlight'] = get_int($rawParams['spotlight'] ?? null);

        $spotlights = Spotlight::orderBy('chart_id', 'desc')->get();

        $spotlight = $params['spotlight'] === null
            ? ($spotlights->first() ?? abort(404))
            : Spotlight::findOrFail($params['spotlight']);
        $params['spotlight'] = $spotlight->getKey();

        if ($spotlight->hasMode($params['mode'])) {
            $beatmapsets = $spotlight->beatmapsets($params['mode'])->with('beatmaps')->get();
            $scores = $spotlight->ranking($params['mode']);

            if ($params['filter'] === 'friends') {
                $scores->friendsOf(\Auth::user());
            }

            $scores = $scores->get();
        } else {
            if ($isApi) {
                abort(404, "ruleset {$params['mode']} isn't available for the specified spotlight");
            }

            $beatmapsets = collect();
            $scores = collect();
            $scoreCount = 0;
        }

        if ($isApi) {
            return [
                // transformer can't do nested includes with params properly.
                // https://github.com/thephpleague/fractal/issues/239
                'beatmapsets' => json_collection(
                    $beatmapsets,
                    new BeatmapsetTransformer(),
                    ['beatmaps'],
                ),
                'ranking' => json_collection(
                    $scores,
                    new UserStatisticsTransformer(),
                    UserStatisticsTransformer::RANKING_INCLUDES,
                ),
                'spotlight' => json_item(
                    $spotlight,
                    new SpotlightTransformer(),
                    ["participant_count:mode({$params['mode']})"],
                ),
            ];
        }

        $scoreCount ??= $spotlight->participantCount($params['mode']);
        $selectOptionTransformer = new SelectOptionTransformer();
        $selectOptions = [
            'currentItem' => json_item($spotlight, $selectOptionTransformer),
            'items' => json_collection($spotlights, $selectOptionTransformer),
            'type' => 'spotlight',
        ];

        return ext_view(
            'rankings.charts',
            compact(
                'beatmapsets',
                'scoreCount',
                'scores',
                'selectOptions',
                'spotlight',
                'params',
            ),
        );
    }
}
