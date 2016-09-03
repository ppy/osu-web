<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

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
