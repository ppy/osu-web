<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Libraries\OneTimeKey;
use App\Models\Beatmap;
use App\Models\User;
use App\Transformers\UserCompactTransformer;

class OneTimeKeyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['check']]);
        $this->middleware('verify-user', ['except' => ['check']]);
    }

    public function check()
    {
        $userId = OneTimeKey::retrieve(get_string(request('key'))) ?? abort(422);
        $user = User::findOrFail($userId);
        $matchmakingUserStats = $user
            ->matchmakingStats()
            ->whereHas('pool', fn ($q) => $q->where('active', true))
            ->with('pool')
            ->get();

        // TODO: actual transformer json after moving out the rank
        // attributes somewhere else
        $matchmakingUserStatsJson = [];
        foreach ($matchmakingUserStats as $entry) {
            $matchmakingUserStatsJson[] = [
                'pool_id' => $entry->pool_id,
                'rating' => $entry->rating,
                'ruleset_id' => $entry->pool->ruleset_id,
                'variant_id' => $entry->pool->variant_id,
            ];
        }

        $pp = [];
        foreach (Beatmap::VARIANT_BY_ID as $rulesetId => $variants) {
            foreach ($variants as $variantId => $variantName) {
                $statistics = $user->statistics(Beatmap::modeStr($rulesetId), variant: presence($variantName));

                if ($statistics !== null) {
                    $pp[] = [
                        'pp' => $statistics->rank_score,
                        'ruleset_id' => $rulesetId,
                        'variant_id' => $variantId,
                    ];
                }
            }
        }

        return [
            'matchmaking_user_stats' => $matchmakingUserStatsJson,
            'stats' => $pp,
            'user' => json_item($user, new UserCompactTransformer(), UserCompactTransformer::CARD_INCLUDES),
        ];
    }

    public function create()
    {
        $key = OneTimeKey::currentKey(\Auth::user());

        return ext_view('one_time_key.create', compact('key'));
    }

    public function store()
    {
        $key = OneTimeKey::generate(\Auth::user());

        return ujs_redirect(route('one-time-key'));
    }
}
