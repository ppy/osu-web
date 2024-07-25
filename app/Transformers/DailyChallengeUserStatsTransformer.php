<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\DailyChallengeUserStats;

class DailyChallengeUserStatsTransformer extends TransformerAbstract
{
    public function transform(DailyChallengeUserStats $stats): array
    {
        return [
            'daily_streak_best' => $stats->daily_streak_best ?? 0,
            'daily_streak_current' => $stats->daily_streak_current ?? 0,
            'last_update' => json_time($stats->last_update),
            'last_weekly_streak' => json_time($stats->last_weekly_streak),
            'playcount' => $stats->playcount ?? 0,
            'top_10p_placements' => $stats->top_10p_placements ?? 0,
            'top_50p_placements' => $stats->top_50p_placements ?? 0,
            'user_id' => $stats->user_id,
            'weekly_streak_best' => $stats->weekly_streak_best ?? 0,
            'weekly_streak_current' => $stats->weekly_streak_current ?? 0,
        ];
    }
}
