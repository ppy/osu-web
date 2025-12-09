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

        $poolsQuery = MatchmakingPool::where(['ruleset_id' => $rulesetId])->orderByDesc('active')->orderByDesc('id');

        if ($poolId === null) {
            $pool = $poolsQuery->firstOrFail();

            return ujs_redirect(route('rankings.matchmaking', ['mode' => $rulesetName, 'pool' => $pool->getKey()]));
        }

        $pools = $poolsQuery->get();

        $pool = $pools->findOrFail($poolId);
        $query = $pool->allUserStats()->with('user.team')->default();

        $sort = get_string(request('sort'));
        if (!array_key_exists($sort, static::SORTS)) {
            $sort = 'rating';
        }
        foreach (static::SORTS[$sort] as $dbSort) {
            $query->orderBy(...$dbSort);
        }
        $scores = $query->paginate()->withQueryString();

        return ext_view('rankings.matchmaking', compact(
            'pool',
            'pools',
            'rulesetName',
            'scores',
            'sort',
        ));
    }
}
