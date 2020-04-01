<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Models\User;

/**
 * @property float $accuracy
 * @property int $attempts
 * @property int $completed
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property float|null $pp
 * @property int $room_id
 * @property int $total_score
 * @property \Carbon\Carbon $updated_at
 * @property int $user_id
 */
class UserScoreAggregate extends RoomUserHighScore
{
    public $isNew = false;

    public static function getPlaylistItemUserHighScore(RoomScore $score)
    {
        return PlaylistItemUserHighScore::firstOrNew([
            'playlist_item_id' => $score->playlist_item_id,
            'user_id' => $score->user_id,
        ]);
    }

    public static function updatePlaylistItemUserHighScore(PlaylistItemUserHighScore $highScore, RoomScore $score)
    {
        if (!$score->passed) {
            return;
        }

        $highScore->total_score = $score->total_score;
        $highScore->accuracy = $score->accuracy;
        $highScore->pp = $score->pp;
        $highScore->score_id = $score->getKey();

        $highScore->save();
    }

    public static function new(User $user, Room $room): self
    {
        $obj = static::firstOrNew([
            'user_id' => $user->getKey(),
            'room_id' => $room->getKey(),
        ]);

        foreach (['total_score', 'accuracy', 'pp', 'attempts', 'completed'] as $key) {
            // init if required
            $obj->$key = $obj->$key ?? 0;
        }

        if (!$obj->exists) {
            $obj->isNew = true;
            $obj->save(); // force a save now to avoid being trolled later.
            $obj->recalculate();
        }

        return $obj;
    }

    public function addScore(RoomScore $score)
    {
        return $this->getConnection()->transaction(function () use ($score) {
            if (!$score->isCompleted()) {
                return false;
            }

            $highestScore = static::getPlaylistItemUserHighScore($score);

            if ($score->total_score > $highestScore->total_score) {
                $this->updateUserTotal($score, $highestScore);
                static::updatePlaylistItemUserHighScore($highestScore, $score);
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

    public function getScores()
    {
        return RoomScore
            ::where('room_id', $this->room_id)
            ->where('user_id', $this->user_id)
            ->get();
    }

    public function recalculate()
    {
        $this->getConnection()->transaction(function () {
            $this->removeRunningTotals();
            $this->getScores()->each(function ($score) {
                $this->attempts++;
                $this->addScore($score);
            });

            $this->save();
        });
    }

    public function removeRunningTotals()
    {
        PlaylistItemUserHighScore::whereIn(
            'playlist_item_id',
            PlaylistItem::where('room_id', $this->room_id)->select('id')
        )->where('user_id', $this->user_id)->delete();

        foreach (['total_score', 'accuracy', 'pp', 'attempts', 'completed'] as $key) {
            // init if required
            $this->$key = 0;
        }
    }

    public function updateUserAttempts()
    {
        $this->increment('attempts');
    }

    private function updateUserTotal(RoomScore $current, PlaylistItemUserHighScore $prev)
    {
        if ($current->passed) {
            if ($prev->exists) {
                $this->total_score -= $prev->total_score;
                $this->accuracy -= $prev->accuracy;
                $this->pp -= $prev->pp;
                $this->completed--;
            }

            $this->total_score += $current->total_score;
            $this->accuracy += $current->accuracy;
            $this->pp += $current->pp;
            $this->completed++;
        }

        $this->save();
    }
}
