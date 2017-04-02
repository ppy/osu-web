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

use Cache;

class BanchoStats extends Model
{
    protected $table = 'osu_banchostats';
    protected $primaryKey = 'banchostats_id';

    public $timestamps = false;

    public static function cachedStats()
    {
        return Cache::remember('banchostats:v2', 5, function () {
            return array_reverse(static::whereRaw('banchostats_id mod 10 = 0')
              ->select(['users_irc', 'users_osu', 'multiplayer_games', 'date'])
              ->orderBy('banchostats_id', 'DESC')
              ->limit(24 * 60 / 10)
              ->get()
              ->all()
            );
        });
    }
}
