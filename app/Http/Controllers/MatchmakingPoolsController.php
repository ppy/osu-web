<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\MatchmakingUserEloHistory;
use App\Models\User;
use App\Transformers\MatchmakingUserEloHistoryTransformer;

class MatchmakingPoolsController extends Controller
{
    public function userChart($poolId, $userId): array
    {
        $poolId = get_int($poolId) ?? abort(422);

        $user = User::default()->findOrFail($userId);

        $chart = MatchmakingUserEloHistory::daily($poolId, $user->getKey(), 90);

        return ['user_elo_history' => json_collection($chart, new MatchmakingUserEloHistoryTransformer())];
    }
}
