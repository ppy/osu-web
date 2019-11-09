<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Models;

use DB;

/**
 * @property \Carbon\Carbon $created_date
 * @property int $failed_attempts
 * @property string $failed_ids
 * @property int $ip
 * @property \Carbon\Carbon|null $last_attempt
 * @property int $total_attempts
 * @property int $unique_ids
 */
class LoginAttempt extends Model
{
    protected $table = 'osu_login_attempts';
    protected $primaryKey = 'ip';
    public $timestamps = false;

    public static function isLocked($ip)
    {
        return self::where('ip', $ip)
            ->where('failed_attempts', '>', 5)
            ->exists();
    }

    public static function failedAttempt($ip, $user)
    {
        $userId = $user->user_id ?? 0;

        DB::insert(
            "INSERT INTO osu_login_attempts (ip, failed_ids)
                VALUES (?, ?)
                ON DUPLICATE KEY UPDATE
                    failed_attempts = failed_attempts + 1,
                    total_attempts = total_attempts + 1,
                    failed_ids = CONCAT(failed_ids, ',', ?),
                    last_attempt = CURRENT_TIMESTAMP",
            [$ip, $userId, $userId]);
    }
}
