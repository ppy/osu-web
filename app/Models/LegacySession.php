<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property bool $session_admin
 * @property bool $session_autologin
 * @property string $session_forwarded_for
 * @property string $session_id
 * @property string $session_ip
 * @property int $session_last_visit
 * @property string $session_page
 * @property int $session_start
 * @property int $session_time
 * @property int $session_user_id
 * @property bool $session_viewonline
 * @property bool $verified
 */
class LegacySession extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'session_admin' => 'boolean',
        'session_autologin' => 'boolean',
        'session_last_visit' => 'datetime',
        'session_start' => 'datetime',
        'session_time' => 'datetime',
        'session_viewonline' => 'boolean',
        'verified' => 'boolean',
    ];
    protected $dateFormat = 'U';
    protected $keyType = 'string';
    protected $primaryKey = 'session_id';
    protected $table = 'phpbb_sessions';

    public static function loadFromRequest($request)
    {
        $queryWhere = static::queryWhereFromRequest($request);

        if ($queryWhere !== null) {
            return static::where($queryWhere)->first();
        }
    }

    public static function queryWhereFromRequest($request)
    {
        $sessionId = $request->cookie('phpbb3_2cjk5_sid');
        $sessionIdSign = $request->cookie('phpbb3_2cjk5_sid_check');

        if ($sessionId === null || $sessionIdSign === null) {
            return;
        }

        if (!hash_equals(static::signId($sessionId), $sessionIdSign)) {
            return;
        }

        return [
            'session_id' => $sessionId,
            'session_ip' => $request->getClientIp(),
        ];
    }

    public static function signId($id)
    {
        return hash_hmac('sha1', $id, config('osu.legacy.shared_interop_secret'));
    }
}
