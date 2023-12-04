<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Models\Model;
use App\Models\Traits\WithDbCursorHelper;
use App\Models\User;

/**
 * Aggregate root for user multiplayer high scores.
 * Updates should be done via this root and not directly against the models.
 *
 * @property float $accuracy
 * @property int $attempts
 * @property int $completed
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property int|null $last_score_id
 * @property bool $in_room
 * @property float|null $pp
 * @property int $room_id
 * @property int $total_score
 * @property \Carbon\Carbon $updated_at
 * @property int $user_id
 */
class UserScoreAggregate extends Model
{
    use WithDbCursorHelper;

    const SORTS = [
        'score_asc' => [
            ['column' => 'total_score', 'order' => 'ASC'],
            ['column' => 'last_score_id', 'order' => 'DESC'],
        ],
    ];

    const DEFAULT_SORT = 'score_asc';

    protected $casts = [
        'in_room' => 'boolean',
    ];
    protected $table = 'multiplayer_rooms_high';

    public static function lookupOrDefault(User $user, Room $room): static
    {
        return static::firstOrNew([
            'room_id' => $room->getKey(),
            'user_id' => $user->getKey(),
        ], [
            'accuracy' => 0,
            'attempts' => 0,
            'completed' => 0,
            'pp' => 0,
            'total_score' => 0,
        ]);
    }

    public static function new(User $user, Room $room): self
    {
        $obj = static::lookupOrDefault($user, $room);

        if (!$obj->exists) {
            $obj->save(); // force a save now to avoid being trolled later.
            $obj->recalculate();
        }

        return $obj;
    }

    public function addScoreLink(ScoreLink $scoreLink, ?PlaylistItemUserHighScore $highestScore = null)
    {
        return $this->getConnection()->transaction(function () use ($highestScore, $scoreLink) {
            $score = $scoreLink->score;
            if ($score === null) {
                return false;
            }

            $highestScore ??= PlaylistItemUserHighScore::lookupOrDefault(
                $scoreLink->user_id,
                $scoreLink->playlist_item_id,
            );

            if ($score->data->passed && $score->data->totalScore > $highestScore->total_score) {
                $this->updateUserTotal($scoreLink, $highestScore);
                $highestScore->updateWithScoreLink($scoreLink);
            }

            return true;
        });
    }

    public function averageAccuracy()
    {
        return $this->completed > 0 ? $this->accuracy / $this->completed : 0;
    }

    public function averagePp()
    {
        return $this->completed > 0 ? $this->pp / $this->completed : 0;
    }

    public function playlistItemAttempts(): array
    {
        $playlistItemAggs = PlaylistItemUserHighScore
            ::whereHas('playlistItem', fn ($q) => $q->where('room_id', $this->room_id))
            ->where('user_id', $this->user_id)
            ->get();

        $ret = [];
        foreach ($playlistItemAggs as $agg) {
            $ret[] = [
                'attempts' => $agg->attempts,
                'id' => $agg->playlist_item_id,
            ];
        }

        return $ret;
    }

    public function recalculate()
    {
        $this->getConnection()->transaction(function () {
            $this->removeRunningTotals();
            $playlistItemAggs = PlaylistItemUserHighScore
                ::whereHas('playlistItem', fn ($q) => $q->where('room_id', $this->room_id))
                ->where('user_id', $this->user_id)
                ->get()
                ->keyBy('playlist_item_id');
            $this->attempts = $playlistItemAggs->reduce(fn ($acc, $agg) => $acc + $agg->attempts, 0);

            $scoreLinks = ScoreLink
                ::whereHas('playlistItem', fn ($q) => $q->where('room_id', $this->room_id))
                ->where('user_id', $this->user_id)
                ->with('score.performance')
                ->get();
            foreach ($scoreLinks as $scoreLink) {
                $this->addScoreLink(
                    $scoreLink,
                    $playlistItemAggs[$scoreLink->playlist_item_id] ?? null,
                );
            }
            $this->save();
        });
    }

    public function removeRunningTotals()
    {
        PlaylistItemUserHighScore
            ::whereHas('playlistItem', fn ($q) => $q->where('room_id', $this->room_id))
            ->where('user_id', $this->user_id)
            ->update([
                'accuracy' => 0,
                'score_id' => null,
                'total_score' => 0,
            ]);

        static $resetAttributes = [
            'accuracy',
            'attempts',
            'completed',
            'last_score_id',
            'pp',
            'total_score',
        ];

        foreach ($resetAttributes as $key) {
            // init if required
            $this->$key = 0;
        }
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function scopeForRanking($query)
    {
        return $query
            ->where('completed', '>', 0)
            ->whereHas('user', function ($userQuery) {
                $userQuery->default();
            })
            ->orderBy('total_score', 'DESC')
            ->orderBy('last_score_id', 'ASC');
    }

    public function updateUserAttempts()
    {
        $this->incrementInstance('attempts');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userRank()
    {
        if ($this->total_score === null || $this->last_score_id === null) {
            return;
        }

        $query = static::where('room_id', $this->room_id)->forRanking()
            ->cursorSort('score_asc', $this);

        return 1 + $query->count();
    }

    private function updateUserTotal(ScoreLink $currentScoreLink, PlaylistItemUserHighScore $prev)
    {
        if ($prev->score_id !== null) {
            $this->total_score -= $prev->total_score;
            $this->accuracy -= $prev->accuracy;
            $this->pp -= $prev->pp;
            $this->completed--;
        }

        $current = $currentScoreLink->score;

        $this->total_score += $current->data->totalScore;
        $this->accuracy += $current->data->accuracy;
        $this->pp += $current->pp;
        $this->completed++;
        $this->last_score_id = $currentScoreLink->getKey();

        $this->save();
    }
}
