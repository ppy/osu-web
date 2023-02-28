<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

/**
 * @property int $count
 * @property int $name
 */
class Count extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = 'name';
    protected $table = 'osu_counts';

    public static function currentRankStart(string $ruleset): static
    {
        $column = config('osu.scores.experimental_rank_as_default')
            ? "pp_rank_column_exp_{$ruleset}"
            : "pp_rank_column_{$ruleset}";

        return static::firstOrCreate(['name' => $column], ['count' => 0]);
    }

    public static function totalUsers(): static
    {
        return static::firstOrCreate(['name' => 'usercount'], ['count' => 0]);
    }

    public static function lastMailUserNotificationIdSent(): static
    {
        return static::firstOrCreate(['name' => 'last_mail_user_notification_id_sent'], ['count' => 0]);
    }
}
