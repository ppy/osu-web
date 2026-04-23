<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Ranking;

use App\Http\Controllers\Controller;
use App\Models\Beatmap;
use App\Models\MatchmakingPool;
use App\Models\Model;
use App\Transformers\MatchmakingPoolTransformer;
use App\Transformers\MatchmakingUserStatsTransformer;
use Illuminate\Pagination\LengthAwarePaginator;

class MatchmakingController extends Controller
{
    const SORTS = [
        'points' => [['total_points', 'DESC'], ['rating', 'DESC']],
        'rating' => [['rating', 'DESC'], ['total_points', 'DESC']],
    ];

    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public');
    }

    public function index(string $rulesetName)
    {
        $pools = $this->getPoolsQuery($rulesetName)->get();

        return json_collection($pools, new MatchmakingPoolTransformer());
    }

    public function show(?string $rulesetName = null, ?string $poolId = null)
    {
        $poolsQuery = $this->getPoolsQuery($rulesetName);

        if (is_api_request()) {
            // we can just query directly, since the api route
            // requires the pool id to be specified
            $pool = $poolsQuery->findOrFail($poolId);
        } else {
            if ($poolId === null) {
                $pool = $poolsQuery->firstOrFail();

                return ujs_redirect(route('rankings.matchmaking', ['mode' => $rulesetName, 'pool' => $pool->getKey()]));
            }

            $pools = $poolsQuery->get();
            $pool = $pools->findOrFail($poolId);
        }

        $scoresQuery = $pool
            ->allUserStats()
            ->with('user.team')
            ->default()
            ->orderByDesc('rating');

        $maxResults = $scoresQuery->count();
        $maxPages = ceil($maxResults / Model::PER_PAGE);
        $page = get_int(cursor_from_params(\Request::input())['page'] ?? null)
            ?? get_int(\Request::input('page'))
            ?? 1;
        $page = \Number::clamp($page, 1, $maxPages);

        $scores = $scoresQuery
            ->limit(Model::PER_PAGE)
            ->offset(Model::PER_PAGE * ($page - 1))
            ->get();

        if (is_api_request()) {
            return [
                ...cursor_for_response(
                    empty($scores) || $page >= $maxPages ? null : ['page' => $page + 1],
                ),
                'ranking' => json_collection($scores, new MatchmakingUserStatsTransformer(), MatchmakingUserStatsTransformer::RANKING_INCLUDES),
                'total' => $maxResults,
            ];
        } else {
            $scores = new LengthAwarePaginator(
                $scores,
                $maxResults,
                Model::PER_PAGE,
                $page,
                ['path' => route('rankings.matchmaking', ['mode' => $rulesetName, 'pool' => $pool->getKey()])],
            );

            return ext_view('rankings.matchmaking', compact(
                'pool',
                'pools',
                'rulesetName',
                'scores',
            ));
        }
    }

    private function getPoolsQuery(string $rulesetName)
    {
        $rulesetName ??= default_mode();
        $rulesetId = Beatmap::MODES[$rulesetName] ?? abort(422, 'invalid ruleset parameter');

        return MatchmakingPool::where([
            'ruleset_id' => $rulesetId,
            'type' => 'ranked_play',
        ])->orderByDesc('active')->orderByDesc('id');
    }
}
