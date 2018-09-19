<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

class LegacySession extends Model
{
    protected $table = 'phpbb_sessions';
    protected $primaryKey = 'session_id';
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
        $sessionId = $request->cookie('phpbb3_2cjk5_sid');
        $sessionIdSign = $request->cookie('phpbb3_2cjk5_sid_check');

        if ($sessionId === null || $sessionIdSign === null) {
            return;
        }

        if (!hash_equals(static::signId($sessionId), $sessionIdSign)) {
            return;
        }

        return static
            ::where('session_ip', $request->getClientIp())
            ->find($sessionId);
    }

    public static function signId($id)
    {
        return hash_hmac('sha1', $id, config('osu.legacy.shared_interop_secret'));
    }
}
