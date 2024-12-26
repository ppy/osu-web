<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Exceptions\InvariantException;
use App\Models\Multiplayer\UserScoreAggregate;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $season_id
 * @property int $total_score
 * @property int $user_id
 */
class UserSeasonScore extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = ':composite';
    protected $primaryKeys = ['user_id', 'season_id'];

    public function calculate(): void
    {
        $userScores = UserScoreAggregate::whereIn('room_id', $this->season->rooms->pluck('id'))
            ->where('user_id', $this->user_id)
            ->get();

        $scores = [];

        foreach ($this->season->rooms->where('parent_id', null) as $room) {
            $totalScore = $userScores->where('room_id', $room->getKey())
                ->first()
                ?->total_score;

            $childRoomId = $this->season->rooms
                ->where('parent_id', $room->getKey())
                ->first()
                ?->getKey();

            $totalScoreChild = $userScores->where('room_id', $childRoomId)
                ->first()
                ?->total_score;

            if ($totalScore == null && $totalScoreChild == null) {
                continue;
            }

            $scores[] = max([$totalScore, $totalScoreChild]);
        }

        rsort($scores);

        $factors = $this->season->scoreFactorsOrderedForCalculation();
        $scoreCount = count($scores);

        if ($scoreCount > count($factors)) {
            throw new InvariantException(osu_trans('rankings.seasons.validation.not_enough_factors'));
        }

        $total = 0;

        for ($i = 0; $i < $scoreCount; $i++) {
            $total += $scores[$i] * $factors[$i];
        }

        $this->total_score = $total;
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
