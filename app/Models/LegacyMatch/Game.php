<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\LegacyMatch;

use App\Libraries\ModsHelper;
use App\Models\Beatmap;

/**
 * @property Beatmap $beatmap
 * @property int|null $beatmap_id
 * @property \Carbon\Carbon|null $end_time
 * @property \Illuminate\Database\Eloquent\Collection $events Event
 * @property int $game_id
 * @property LegacyMatch $legacyMatch
 * @property int|null $match_id
 * @property int|null $match_type
 * @property mixed $mode
 * @property int|null $mods
 * @property int|null $play_mode
 * @property \Illuminate\Database\Eloquent\Collection $scores Score
 * @property int|null $scoring_type
 * @property \Carbon\Carbon|null $start_time
 * @property int|null $team_type
 */
class Game extends Model
{
    protected $primaryKey = 'game_id';

    protected $hidden = ['match_id'];

    protected $dates = [
        'start_time',
        'end_time',
    ];

    public $timestamps = false;

    const SCORING_TYPES = [
        'score' => 0,
        'accuracy' => 1,
        'combo' => 2,
        'scorev2' => 3,
    ];

    const TEAM_TYPES = [
        'head-to-head' => 0,
        'tag-coop' => 1,
        'team-vs' => 2,
        'tag-team-vs' => 3,
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

    public function legacyMatch()
    {
        return $this->belongsTo(LegacyMatch::class, 'match_id');
    }

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function getModsAttribute($value)
    {
        if (empty($this->_mods)) {
            $this->_mods = ModsHelper::toArray($value);
        }

        return $this->_mods;
    }

    public function getModeAttribute()
    {
        return Beatmap::modeStr($this->play_mode);
    }

    public function getScoringTypeAttribute($value)
    {
        return array_search_null($value, self::SCORING_TYPES);
    }

    public function getTeamTypeAttribute($value)
    {
        return array_search_null($value, self::TEAM_TYPES);
    }
}
