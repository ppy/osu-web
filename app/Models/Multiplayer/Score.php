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

use App\Models\Beatmap;
use App\Traits\Scoreable;

class Score extends Model
{
    use Scoreable;

    protected $table = 'game_scores';
    protected $primaryKey = null;
    protected $hidden = ['frame', 'game_id'];
    public $timestamps = false;

    const TEAMS = [
        0 => 'none',
        1 => 'blue',
        2 => 'red',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function gamemodeString()
    {
        return Beatmap::modeStr($this->game->play_mode);
    }

    public function getTeamAttribute($value)
    {
        return self::TEAMS[$value];
    }

    public function scopeDefault($query)
    {
        return $query->orderBy('slot', 'asc');
    }
}
