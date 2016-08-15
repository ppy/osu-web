<?php

/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
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

use Illuminate\Database\Eloquent\Model;

class LegacySession extends Model
{
    protected $table = 'phpbb_sessions';
    protected $primaryKey = 'session_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $dateFormat = 'U';
    protected $dates = ['session_last_visit', 'session_start', 'session_time'];
    protected $guarded = [];

    protected $casts = [
        'session_admin' => 'boolean',
        'session_autologin' => 'boolean',
        'session_viewonline' => 'boolean',
        'verified' => 'boolean',
    ];

    public static function loadFromRequest($request)
    {
        $sessionId = $request->cookie('phpbb3_2cjk5_sid');
        $sessionIdHash = $request->cookie('phpbb3_2cjk5_sid_check');

        if ($sessionId === null || $sessionIdHash === null) {
            return;
        }

        $computedSessionIdHash = hash_hmac('sha1', $sessionId, config('osu.legacy.shared_cookie_secret'));

        if ($sessionIdHash !== $computedSessionIdHash) {
            return;
        }

        return static
            ::where('session_ip', $request->getClientIp())
            ->find($sessionId);
    }
}
