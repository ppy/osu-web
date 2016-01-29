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
use App\Models\BeatmapSet;
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
        'user_id' => 'integer',
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

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class);
    }

    public function beatmapSet()
    {
        return $this->belongsTo(BeatmapSet::class, 'beatmapset_id');
    }

    public static function getClass($modeInt)
    {
        $modeStr = Beatmap::modeStr($modeInt);

        if ($modeStr !== null) {
            $klass = get_class_namespace(static::class).'\\'.studly_case($modeStr);

            return new $klass;
        }
    }

    public static function gamemodeString()
    {
        return snake_case(get_class_basename(static::class));
    }

    public function getEnabledModsAttribute($value)
    {
        if ($this->_enabledMods === null) {
            $value = intval($value);

            $this->_enabledMods = [];

            // move to its own class when needed.
            // id, name, short name, implied ids
            $availableMods = [
                [0, 'No Fail', 'NF'],
                [1, 'Easy Mode', 'EZ'],
                [3, 'Hidden', 'HD'],
                [4, 'Hard Rock', 'HR'],
                [5, 'Sudden Death', 'SD', [14]],
                [6, 'Double Time', 'DT'],
                [7, 'Relax', 'Relax'],
                [8, 'Half Time', 'HT'],
                [9, 'Nightcore', 'NC', [6]],
                [10, 'Flashlight', 'FL'],
                [12, 'Spun Out', 'SO'],
                [13, 'Auto Pilot', 'AP'],
                [14, 'Perfect', 'PF'],
                [15, '4K', '4K'],
                [16, '5K', '5K'],
                [17, '6K', '6K'],
                [18, '7K', '7K'],
                [19, '8K', '8K'],
                [20, 'Fade In', 'FI'],
                [24, '9K', '9K'],
            ];

            $enabledMods = [];
            $impliedIds = [];

            foreach ($availableMods as $availableMod) {
                if (($value & (1 << $availableMod[0])) === 0) {
                    continue;
                }

                $currentImpliedIds = array_get($availableMod, 3);
                if ($currentImpliedIds !== null) {
                    $impliedIds = array_merge($impliedIds, $currentImpliedIds);
                }

                $enabledMods[$availableMod[0]] = ['name' => $availableMod[1], 'shortName' => $availableMod[2]];
            }

            $enabledMods = array_filter($enabledMods, function ($modId) use ($impliedIds) {
                return in_array($modId, $impliedIds, true) === false;
            }, ARRAY_FILTER_USE_KEY);

            $this->_enabledMods = array_values($enabledMods);
        }

        return $this->_enabledMods;
    }

    public function totalHits()
    {
        if (static::gamemodeString() === 'osu') {
            return ($this->count50 + $this->count100 + $this->count300 + $this->countmiss) * 300;
        } elseif (static::gamemodeString() === 'fruits') {
            return $this->count50 + $this->count100 + $this->count300 +
                $this->countmiss + $this->countkatu;
        } elseif (static::gamemodeString() === 'mania') {
            return ($this->count50 + $this->count100 + $this->count300 + $this->countmiss + $this->countkatu + $this->countgeki) * 300;
        } elseif (static::gamemodeString() === 'taiko') {
            return ($this->count100 + $this->count300 + $this->countmiss) * 300;
        }
    }

    public function hits()
    {
        if (static::gamemodeString() === 'osu') {
            return $this->count50 * 50 + $this->count100 * 100 + $this->count300 * 300;
        } elseif (static::gamemodeString() === 'fruits') {
            return $this->count50 + $this->count100 + $this->count300;
        } elseif (static::gamemodeString() === 'mania') {
            return $this->count50 * 50 + $this->count100 * 100 + $this->countkatu * 200 + ($this->count300 + $this->countgeki) * 300;
        } elseif (static::gamemodeString() === 'taiko') {
            return $this->count100 * 150 + $this->count300 * 300;
        }
    }

    public function accuracy()
    {
        return $this->hits() / $this->totalHits();
    }

    public function scopeDefault($query)
    {
        return $query->where('rank', '<>', 'F')->orderBy('score_id', 'desc');
    }
}
