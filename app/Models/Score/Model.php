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

use Illuminate\Database\Eloquent\Model as BaseModel;
use App\Models\Beatmap;
use App\Models\User;

abstract class Model extends BaseModel
{
    protected $primaryKey = 'score_id';

    protected $casts = [
        'beatmap_id' => 'integer',
        'score' => 'integer',
        'maxcombo' => 'integer',
        'count50' => 'integer',
        'count100' => 'integer',
        'count300' => 'integer',
        'countmiss' => 'integer',
        'countkatu' => 'integer',
        'countgeki' => 'integer',
        'perfect' => 'integer',
        'enabled_mods' => 'integer',
        'user_id' => 'integer',
        'enabled_mods' => 'integer',
        'rank' => 'string',
        'pp' => 'float',
    ];
    protected $dates = ['date'];
    public $timestamps = false;

    public function scopeForUser($query, User $user)
    {
        return $query->where('user_id', $user->user_id);
    }

    public static function getClass($game_mode)
    {
        switch ($game_mode) {
            case Beatmap::OSU:
                $instance = new Osu;
                break;

            case Beatmap::TAIKO:
                $instance = new Taiko;
                break;

            case Beatmap::CTB:
                $instance = new Fruit;
                break;

            case Beatmap::MANIA:
                $instance = new Mania;
                break;
        }

        return $instance;
    }
}
