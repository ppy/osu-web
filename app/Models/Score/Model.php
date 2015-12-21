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
        'score_id' => 'integer',
        'beatmap_id' => 'integer',
        'beatmapset_id' => 'integer',
        'score' => 'integer',
        'maxcombo' => 'integer',
        'count50' => 'integer',
        'count100' => 'integer',
        'count300' => 'integer',
        'countmiss' => 'integer',
        'countkatu' => 'integer',
        'countgeki' => 'integer',
        'enabled_mods' => 'integer',
        'user_id' => 'integer',
        'enabled_mods' => 'integer',
        'rank' => 'string',
        'pp' => 'float',
        'perfect' => 'boolean',
        'replay' => 'boolean',
    ];
    protected $dates = ['date'];
    public $timestamps = false;

    protected $_enabledMods = null;

    public function scopeForUser($query, User $user)
    {
        return $query->where('user_id', $user->user_id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getClass($modeInt)
    {
        $modeStr = Beatmap::modeStr($modeInt);

        if ($modeStr !== null) {
            $klass = get_namespace(static::class).'\\'.studly_case($modeStr);

            return new $klass;
        }
    }

    public function getEnabledModsAttribute($value)
    {
        if ($this->_enabledMods === null) {
            $value = intval($value);

            $this->_enabledMods = [];

            // move to its own class when needed.
            $availableMods = [
                [0, 'NoFail', 'NF'],
                [1, 'EasyMode', 'EZ'],
                [3, 'Hidden', 'HD'],
                [4, 'HardRock', 'HR'],
                [5, 'SuddenDeath', 'SD'],
                [6, 'DoubleTime', 'DT'],
                [7, 'Relax', 'Relax'],
                [8, 'HalfTime', 'HT'],
                [9, 'Nightcore', 'NC'],
                [10, 'Flashlight', 'FL'],
                [12, 'SpunOut', 'SO'],
                [13, 'AutoPilot', 'AP'],
                [14, 'Perfect', 'PF'],
                [15, '4K', '4K'],
                [16, '5K', '5K'],
                [17, '6K', '6K'],
                [18, '7K', '7K'],
                [19, '8K', '8K'],
                [20, 'FadeIn', 'FI'],
                [24, '9K', '9K'],
            ];

            foreach ($availableMods as $availableMod) {
                if (($value & (1 << $availableMod[0])) === 0) {
                    continue;
                }

                $this->_enabledMods[] = ['name' => $availableMod[1], 'shortName' => $availableMod[2]];
            }
        }

        return $this->_enabledMods;
    }

    public function totalHits()
    {
        if ($this->gamemodeString() === 'osu') {
            return ($this->count50 + $this->count100 + $this->count300 + $this->countmiss) * 300;
        } elseif ($this->gamemodeString() === 'fruits') {
            return $this->count50 + $this->count100 + $this->count300 +
                $this->countmiss + $this->countkatu;
        } elseif ($this->gamemodeString() === 'mania') {
            return ($this->count50 + $this->count100 + $this->count300 + $this->countmiss + $this->countkatu + $this->countgeki) * 300;
        } elseif ($this->gamemodeString() === 'taiko') {
            return ($this->count100 + $this->count300 + $this->countmiss) * 300;
        }
    }

    public function hits()
    {
        if ($this->gamemodeString() === 'osu') {
            return $this->count50 * 50 + $this->count100 * 100 + $this->count300 * 300;
        } elseif ($this->gamemodeString() === 'fruits') {
            return $this->count50 + $this->count100 + $this->count300;
        } elseif ($this->gamemodeString() === 'mania') {
            return $this->count50 * 50 + $this->count100 * 100 + $this->countkatu * 200 + ($this->count300 + $this->countgeki) * 300;
        } elseif ($this->gamemodeString() === 'taiko') {
            return $this->count100 * 150 + $this->count300 * 300;
        }
    }

    public function accuracy()
    {
        return $this->hits() / $this->totalHits();
    }
}
