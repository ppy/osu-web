<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property int $count
 * @property int $name
 */
class Count extends Model
{
    protected $table = 'osu_counts';
    protected $primaryKey = 'name';

    public $timestamps = false;

    public static function currentRankStart(string $mode): int
    {
        return static::firstOrCreate(['name' => "pp_rank_column_{$mode}"], ['count' => 0]);
    }

    public static function totalUsers()
    {
        return static::firstOrCreate(['name' => 'usercount'], ['count' => 0]);
    }

    public static function lastMailUserNotificationIdSent()
    {
        return static::firstOrCreate(['name' => 'last_mail_user_notification_id_sent'], ['count' => 0]);
    }
}
