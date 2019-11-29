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
 * @property mixed $hash
 */
class WeakPassword extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'hash';
    protected $keyType = 'string';

    public static function add($string)
    {
        static::create(['hash' => md5(strtolower($string), true)]);
    }

    public static function check($string)
    {
        return static::where(['hash' => md5(strtolower($string), true)])->exists();
    }
}
