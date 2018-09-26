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

use DB;

class WeakPassword extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'hash';

    public static function add($string)
    {
        $md5 = md5(strtolower($string));

        static::create([
            'hash' => DB::raw("UNHEX('{$md5}')"),
        ]);
    }

    public static function check($string)
    {
        return static
            ::whereRaw('hash = UNHEX(?)', md5(strtolower($string)))
            ->exists();
    }
}
