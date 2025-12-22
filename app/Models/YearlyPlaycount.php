<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

/**
 * @property int $playcount
 * @property int $year
 */
class YearlyPlaycount extends Model
{
    public $timestamps = false;
    protected $table = 'yearly_playcount';

    public static function getPosition(int $year, int $userId): array
    {
        $users = \Cache::remember(
            "yearly_playcount_users:{$year}",
            3600,
            fn () => max(1, static::where('year', $year)->count()),
        );

        $yearString = substr((string) $year, 2, 2);
        $playcount = (int) UserMonthlyPlaycount
            ::where('user_id', $userId)
            ->whereBetween('year_month', ["{$yearString}01", "{$yearString}12"])
            ->sum('playcount');
        $pos = static::where('year', $year)->where('playcount', '>', $playcount)->count();

        return [
            'playcount' => $playcount,
            'pos' => $pos + 1,
            'top_percent' => max(0.01, $pos / $users),
        ];
    }
}
