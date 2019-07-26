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

namespace App\Models\Multiplayer;

use App\Models\Beatmap;
use App\Traits\Scoreable;

/**
 * @property int $count100
 * @property int $count300
 * @property int $count50
 * @property int $countgeki
 * @property int $countkatu
 * @property int $countmiss
 * @property int|null $enabled_mods
 * @property int $frame
 * @property Game $game
 * @property int $game_id
 * @property int $maxcombo
 * @property int $pass
 * @property int $perfect
 * @property mixed $rank
 * @property int $score
 * @property int $slot
 * @property int $team
 * @property int $user_id
 */
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
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function gameModeString()
    {
        return Beatmap::modeStr($this->game->play_mode);
    }

    public function getScoringType()
    {
        return $this->game->scoring_type;
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
