<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\LegacyMatch;

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
    use Scoreable {
        getEnabledModsAttribute as private _getEnabledMods;
    }

    protected $table = 'game_scores';
    protected $primaryKeys = ['game_id', 'slot'];
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

    public function getEnabledModsAttribute($value)
    {
        return $this->_getEnabledMods($value | ($this->game->getAttributes()['mods'] ?? 0));
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
