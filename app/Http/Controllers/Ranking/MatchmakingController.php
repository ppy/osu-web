<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Ranking;

use App\Http\Controllers\Controller;
use App\Models\Beatmap;
use App\Models\MatchmakingPool;

class MatchmakingController extends Controller
{
    const SORTS = [
        'points' => [['total_points', 'DESC'], ['rating', 'DESC']],
        'rating' => [['rating', 'DESC'], ['total_points', 'DESC']],
    ];

    public function show(?string $rulesetName = null, ?string $poolId = null)
    {
        $rulesetName ??= default_mode();
        $rulesetId = Beatmap::MODES[$rulesetName] ?? abort(422, 'invalid ruleset parameter');

        $poolsQuery = MatchmakingPool::where([
            'ruleset_id' => $rulesetId,
            'type' => 'ranked_play',
        ])->orderByDesc('active')->orderByDesc('id');

        if ($poolId === null) {
            $pool = $poolsQuery->firstOrFail();

            return ujs_redirect(route('rankings.matchmaking', ['mode' => $rulesetName, 'pool' => $pool->getKey()]));
        }

        $pools = $poolsQuery->get();

        $pool = $pools->findOrFail($poolId);
        $scores = $pool
            ->allUserStats()
            ->with('user.team')
            ->default()
            ->orderByDesc('rating')
            ->paginate()
            ->withQueryString();

        return ext_view('rankings.matchmaking', compact(
            'pool',
            'pools',
            'rulesetName',
            'scores',
        ));
    }
}
