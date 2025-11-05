<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Ranking;

use App\Http\Controllers\Controller;
use App\Models\Beatmap;
use App\Models\MatchmakingUserStats;

class QuickplayController extends Controller
{
    public function show(?string $rulesetName = null)
    {
        if ($rulesetName === null) {
            return ujs_redirect(route('rankings.quickplay', ['mode' => default_mode()]));
        }

        $rulesetId = Beatmap::MODES[$rulesetName] ?? abort(422, 'invalid ruleset parameter');

        static $sorts = [
            'points' => [['total_points', 'DESC'], ['rating', 'DESC']],
            'rating' => [['rating', 'DESC'], ['total_points', 'DESC']],
        ];

        $sort = $sorts[request('sort')] ?? $sorts['rating'];

        $query = MatchmakingUserStats
            ::where('ruleset_id', $rulesetId)
            ->with('user.team')
            ->whereHas('user', fn ($q) => $q->default())
            ->where('elo_data->contest_count', '>=', 5);
        foreach ($sorts[request('sort')] ?? $sorts['rating'] as $sort) {
            $query->orderBy(...$sort);
        }
        $scores = $query->paginate();

        return ext_view('rankings.quickplay', compact(
            'scores',
            'rulesetName',
        ));
    }
}
