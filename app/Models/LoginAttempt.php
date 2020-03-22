<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use DB;
use Exception;

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
    public $incrementing = false;
    public $timestamps = false;

    public static function appendFailedIds($user, $state)
    {
        $userId = static::getUserId($user);
        $newFailedId = DB::getPdo()->quote("{$userId}($state)");

        return DB::raw("CONCAT(failed_ids, ',', {$newFailedId})");
    }

    public static function findOrDefault($ip)
    {
        try {
            return static::find($ip) ?? static::create([
                'ip' => $ip,
                'failed_ids' => '',
                'unique_ids' => 0,
                'failed_attempts' => 0,
                'total_attempts' => 0,
            ]);
        } catch (Exception $e) {
            if (is_sql_unique_exception($e)) {
                return static::findOrDefault($ip);
            }

            throw $e;
        }
    }

    public static function getUserId($user)
    {
        return optional($user)->getKey() ?? 0;
    }

    public static function hashInvalidPassword($password)
    {
        // The goal is just to allow same password (or other passwords
        // with colliding hash) to be excluded from being counted as additional
        // attempt.
        return substr(sha1('osu_unique_'.md5($password)), 8, 12);
    }

    public static function isLocked($ip)
    {
        $record = static::find($ip);

        if ($record === null) {
            return false;
        }

        if ($record->unique_ids > 50) {
            return true;
        }

        return $record->failed_attempts > config('osu.user.max_login_attempts');
    }

    public static function logAttempt($ip, $user, $type, $password = null)
    {
        $state = $type;

        if ($password !== null) {
            $state .= ':'.static::hashInvalidPassword($password);
        }

        $record = static::findOrDefault($ip);

        if ($record->containsUser($user, $state)) {
            return;
        }

        $updates = [
            'failed_ids' => static::appendFailedIds($user, $state),
            'total_attempts' => db_unsigned_increment('total_attempts', 1),
            'last_attempt' => DB::raw('CURRENT_TIMESTAMP'),
        ];

        $isUserVerification = $type === 'verify';
        $userRecorded = $record->containsUser($user);
        $newRecord = $record->failed_attempts === 0;

        if (!$userRecorded) {
            $updates['unique_ids'] = db_unsigned_increment('unique_ids', 1);
        }

        if (!$isUserVerification) {
            if ($userRecorded || $newRecord) {
                $updates['failed_attempts'] = db_unsigned_increment('failed_attempts', 1);
            } else {
                $updates['failed_attempts'] = DB::raw('GREATEST(1, LEAST(20000, failed_attempts)) * 3');
            }
        }

        static::where('ip', $ip)->update($updates);
    }

    public static function logLoggedIn($ip, $user)
    {
        $record = static::find($ip);

        if ($record === null) {
            return;
        }

        $updates = [];

        if (!$record->containsUser($user, 'success')) {
            $updates['failed_attempts'] = db_unsigned_increment('failed_attempts', -1);
        }

        if (!$record->containsUser($user)) {
            $updates['unique_ids'] = db_unsigned_increment('unique_ids', 1);
        }

        $updates['failed_ids'] = static::appendFailedIds($user, 'success');

        static::where('ip', $ip)->update($updates);
    }

    public function containsUser($user, $state = null)
    {
        $key = ','.static::getUserId($user).'(';

        if ($state !== null) {
            $key .= $state;

            if (!ends_with($state, ':')) {
                $key .= ')';
            }
        }

        return strpos($this->failed_ids, $key) !== false;
    }
}
