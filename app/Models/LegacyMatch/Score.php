<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\LegacyMatch;

use App\Models\Beatmap;
use App\Models\Solo\ScoreData;
use App\Models\Traits\Scoreable;

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
 * @property mixed $team
 * @property int $user_id
 */
class Score extends Model
{
    use Scoreable;

    const TEAMS = [
        0 => 'none',
        1 => 'blue',
        2 => 'red',
    ];

    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'pass' => 'bool',
    ];
    protected $primaryKey = ':composite';
    protected $primaryKeys = ['game_id', 'slot'];
    protected $table = 'game_scores';

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function scopeDefault($query)
    {
        return $query->orderBy('slot', 'asc');
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'game_id',
            'slot',
            'user_id',
            'score',
            'maxcombo',

            'count50',
            'count100',
            'count300',
            'countgeki',
            'countkatu',
            'countmiss',
            'frame' => $this->getRawAttribute($key),

            'pass',
            'perfect' => (bool) $this->getRawAttribute($key),

            'date' => $this->game->start_time,

            'date_json' => $this->game->start_time_json,

            'best_id' => null,
            'has_replay' => false,
            'pp' => null,

            'enabled_mods' => $this->getEnabledMods(),
            'rank' => $this->getRank(),
            'team' => static::TEAMS[$this->getRawAttribute('team')],

            'game' => $this->getRelationValue($key),

            'accuracy' => $this->accuracy(),
            'beatmap_id' => $this->game->beatmap_id,
            'build_id' => null,
            'data' => $this->getData(),
            'ended_at_json' => $this->date_json,
            'is_perfect_combo' => $this->perfect,
            'legacy_perfect' => $this->perfect,
            'legacy_score_id' => $this->getKey(),
            'legacy_total_score' => $this->score,
            'max_combo' => $this->maxcombo,
            'passed' => $this->pass,
            'ruleset_id' => $this->game->play_mode,
            'started_at_json' => null,
            'total_score' => $this->score,
        };
    }

    public function getMode(): string
    {
        return $this->game->mode;
    }

    public function getScoringType()
    {
        return $this->game->scoring_type;
    }

    private function getData(): ScoreData
    {
        $mods = array_map(fn ($m) => ['acronym' => $m, 'settings' => []], $this->enabled_mods);

        $statistics = [
            'miss' => $this->countmiss,
            'great' => $this->count300,
            ...match ($this->ruleset_id) {
                Beatmap::MODES['osu'] => [
                    'ok' => $this->count100,
                    'meh' => $this->count50,
                ],
                Beatmap::MODES['taiko'] => [
                    'ok' => $this->count100,
                ],
                Beatmap::MODES['fruits'] => [
                    'large_tick_hit' => $this->count100,
                    'small_tick_hit' => $this->count50,
                    'small_tick_miss' => $this->countkatu,
                ],
                Beatmap::MODES['mania'] => [
                    'perfect' => $this->countgeki,
                    'good' => $this->countkatu,
                    'ok' => $this->count100,
                    'meh' => $this->count50,
                ],
            },
        ];

        return new ScoreData(compact('mods', 'statistics'));
    }

    private function getEnabledMods(): array
    {
        return $this->getEnabledModsAttribute($this->getRawAttribute('enabled_mods') | ($this->game->getRawAttribute('mods') ?? 0));
    }

    private function getRank(): string
    {
        if ($this->attributes['rank'] === '0') {
            $this->recalculateRank();
        }

        return $this->attributes['rank'];
    }
}
