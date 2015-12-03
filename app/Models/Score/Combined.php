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
namespace App\Models\Score;

class Combined extends Model
{
    public static function forUser(\App\Models\User $user, $best = false)
    {
        $osu = $best ? Best\Osu::forUser($user) : Osu::forUser($user);
        $taiko = $best ? Best\Taiko::forUser($user) : Taiko::forUser($user);
        $mania = $best ? Best\Mania::forUser($user) : Mania::forUser($user);
        $fruits = $best ? Best\Fruit::forUser($user) : Fruit::forUser($user);

        return $osu->union($taiko)->union($mania)->union($fruits);
    }
}
