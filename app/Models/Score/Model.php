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

    public $timestamps = false;

    public static function forUser(\App\Models\User $user)
    {
        return static::where('user_id', (int) $user->user_id);
    }

    public static function getClass($game_mode)
    {
        switch ($game_mode) {
            case Beatmap::OSU:
                return Osu::class;
                break;

            case Beatmap::TAIKO:
                return Taiko::class;
                break;

            case Beatmap::CTB:
                return Fruit::class;
                break;

            case Beatmap::MANIA:
                return Mania::class;
                break;
        }
    }
}
