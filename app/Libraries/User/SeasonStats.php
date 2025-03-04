<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Models\Season;
use App\Models\User;
use App\Transformers\SeasonDivisionTransformer;
use App\Transformers\SeasonTransformer;

class SeasonStats
{
    public static function get(User $user, Season $season): ?array
    {
        return \Cache::remember(
            static::seasonCacheKey($user->getKey(), $season->getKey()),
            600,
            function () use ($season, $user) {
                $score = $season->userScores()
                    ->whereBelongsTo($user)
                    ->first();

                if ($score === null) {
                    return null;
                }

                $rank = $season->userScores()
                    ->where('user_id', '<>', $score->user_id)
                    ->where('total_score', '>=', $score->total_score)
                    ->count() + 1;

                foreach ($season->divisionsWithMaxRanks() as $division) {
                    if ($rank <= $division['max_rank']) {
                        $userDivision = $division['division'];
                        break;
                    }
                }

                if (!isset($userDivision)) {
                    return null;
                }

                return [
                    'division' => json_item($userDivision, new SeasonDivisionTransformer()),
                    'rank' => $rank,
                    'season' => json_item($season, new SeasonTransformer()),
                    'total_score' => $score->total_score,
                ];
            }
        );
    }

    public static function resetCache(int $userId, int $seasonId): bool
    {
        return \Cache::forget(static::seasonCacheKey($userId, $seasonId));
    }

    private static function seasonCacheKey(int $userId, int $seasonId): string
    {
        return "season_stats:{$userId}:{$seasonId}";
    }
}
