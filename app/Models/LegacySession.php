<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    protected $table = 'phpbb_sessions';
    protected $primaryKey = 'session_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $dateFormat = 'U';
    protected $dates = ['session_last_visit', 'session_start', 'session_time'];
    public $timestamps = false;

    protected $casts = [
        'session_admin' => 'boolean',
        'session_autologin' => 'boolean',
        'session_viewonline' => 'boolean',
        'verified' => 'boolean',
    ];

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
