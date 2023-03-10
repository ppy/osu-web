<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\LegacyMatch;

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

    public static function scoringTypeStr(?int $scoringType): ?string
    {
        if ($scoringType === null) {
            return null;
        }

        static $map;
        $map ??= array_flip(static::SCORING_TYPES);

        return $map[$scoringType] ?? null;
    }

    public static function teamTypeStr(?int $teamType): ?string
    {
        if ($teamType === null) {
            return null;
        }

        static $map;
        $map ??= array_flip(static::TEAM_TYPES);

        return $map[$teamType] ?? null;
    }

    public $timestamps = false;

    protected $casts = [
        'end_time' => 'datetime',
        'start_time' => 'datetime',
    ];
    protected $primaryKey = 'game_id';

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

    public function getAttribute($key)
    {
        return match ($key) {
            'beatmap_id',
            'game_id',
            'match_id',
            'match_type' => $this->getRawAttribute($key),

            'mode' => Beatmap::modeStr($this->play_mode),
            'mods' => app('mods')->bitsetToIds($this->getRawAttribute($key)),
            'scoring_type' => static::scoringTypeStr($this->getRawAttribute($key)),
            'team_type' => static::teamTypeStr($this->getRawAttribute($key)),

            'end_time',
            'start_time' => $this->getTimeFast($key),

            'end_time_json',
            'start_time_json' => $this->getJsonTimeFast($key),

            'play_mode' => $this->getRulesetId(),

            'beatmap',
            'events',
            'legacyMatch',
            'scores' => $this->getRelationValue($key),
        };
    }

    private function getRulesetId(): int
    {
        $gameRulesetId = $this->getRawAttribute('play_mode') ?? Beatmap::MODES['osu'];
        $beatmapRulesetId = $this->beatmap?->playmode;

        // ruleset set at this model is incorrect when playing ruleset
        // specific map with a different selected ruleset.
        if ($beatmapRulesetId !== null && $beatmapRulesetId !== $gameRulesetId && $beatmapRulesetId !== Beatmap::MODES['osu']) {
            return $beatmapRulesetId;
        }

        return $gameRulesetId;
    }
}
