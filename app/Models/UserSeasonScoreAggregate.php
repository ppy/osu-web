<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use App\Exceptions\InvariantException;
use App\Models\Multiplayer\UserScoreAggregate;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read Season $season
 * @property int $season_id
 * @property float $total_score
 * @property int $user_id
 */
class UserSeasonScoreAggregate extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = ':composite';
    protected $primaryKeys = ['user_id', 'season_id'];

    public function calculate(bool $muteExceptions = true): void
    {
        $seasonRooms = SeasonRoom::where('season_id', $this->season->getKey())->get();
        $userScores = UserScoreAggregate::whereIn('room_id', $seasonRooms->pluck('room_id'))
            ->where('user_id', $this->user_id)
            ->get();

        $factors = $this->season->score_factors ?? [];
        $roomGroupCount = $seasonRooms->groupBy('group_indicator')->count();

        if ($roomGroupCount > count($factors)) {
            // don't interrupt Room::completePlay() and throw exception only for recalculation command
            if ($muteExceptions) {
                return;
            } else {
                throw new InvariantException(osu_trans('rankings.seasons.validation.not_enough_factors'));
            }
        }

        $roomsById = $seasonRooms->keyBy('room_id');
        $scores = [];
        foreach ($userScores as $score) {
            $group = $roomsById[$score->room_id]->group_indicator;
            $scores[$group] = max($scores[$group] ?? 0, $score->total_score);
        }

        rsort($factors);
        rsort($scores);

        $total = 0;
        foreach ($scores as $index => $score) {
            $total += $score * $factors[$index];
        }

        $this->total_score = $total;
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
