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
namespace App\Models\Multiplayer;

use App\Libraries\ModsFromDB;
use App\Models\Beatmap;

class Game extends Model
{
    protected $table = 'games';
    protected $primaryKey = 'game_id';

    protected $hidden = ['match_id'];

    protected $dates = [
        'start_time',
        'end_time',
    ];

    public $timestamps = false;

    protected $casts = [
        'mods' => 'integer',
    ];

    protected $_mods = null;

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function match()
    {
        return $this->belongsTo(Match::class);
    }

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class);
    }

    public function getModsAttribute($value)
    {
        if (!$this->_mods) {
            $this->_mods = (new ModsFromDB($value))->getEnabledMods();
        }

        return $this->_mods;
    }
}
