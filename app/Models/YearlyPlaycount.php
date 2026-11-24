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
        static $cacheDuration = 86400;
        $users = (int) \Cache::remember(
            "yearly_playcount_users:{$year}",
            $cacheDuration,
            fn () => max(1, static::where('year', $year)->count()),
        );

        $playcount = (int) UserMonthlyPlaycount
            ::where('user_id', $userId)
            ->whereBetween('year_month', static::makeRange($year))
            ->sum('playcount');
        $posFn = fn () => static::where('year', $year)->where('playcount', '>', $playcount)->count();
        $pos = $playcount < 10000
            ? (int) \Cache::remember("yearly_playcount_users:{$year}:{$playcount}", $cacheDuration, $posFn)
            : $posFn();

        return [
            'playcount' => $playcount,
            'pos' => $pos + 1,
            'top_percent' => $pos / $users,
        ];
    }

    public static function generate(int $year): void
    {
        $model = new static();
        $table = $model->getTable();
        $monthlyTable = new UserMonthlyPlaycount()->getTable();
        $model->getConnection()->statement(<<<EOS
            INSERT INTO {$table} (year, playcount)
            SELECT {$year}, SUM(playcount) FROM {$monthlyTable} WHERE `year_month` BETWEEN ? AND ? GROUP by user_id
            EOS, static::makeRange($year));
    }

    private static function makeRange(int $year): array
    {
        $year = (int) substr((string) $year, 2, 2);
        $startYear = $year - 1;

        return ["{$startYear}12", "{$year}11"];
    }
}
