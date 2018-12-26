<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

use App\Models\User;

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

    public static function new(User $user, Room $room) : self
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

    public function toArray() : ?array
    {
        $completedCount = $this->completed;
        if ($completedCount === 0) {
            return null;
        }

        return [
            'accuracy' => $this->accuracy / $completedCount,
            'attempts' => $this->attempts,
            'completed' => $completedCount,
            'pp' => $this->pp / $completedCount,
            'room_id' => $this->room_id,
            'total_score' => $this->total_score,
            'user' => json_item($this->user, 'UserCompact', ['country']),
            'user_id' => $this->user_id,
        ];
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
