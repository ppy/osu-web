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
use Illuminate\Support\Collection;

class UserScoreAggregate
{
    private $accuracy = 0;
    private $attempts = 0;
    private $completedCount = 0;
    private $pp = 0;
    private $roomId;
    private $stats = [];
    private $topScores = [];
    private $totalScore = 0;

    /** @var User */
    private $user;

    private $userStats = [];

    public function __construct(User $user, Room $room)
    {
        $this->user = $user;
        $this->roomId = $room->getKey();
    }

    public function addScores(Collection $scores)
    {
        foreach ($scores as $score) {
            $this->addScore($score);
        }
    }

    public function addScore(RoomScore $score)
    {
        if (!$score->isCompleted()) {
            return false; // throw instead?
        }

        $this->_addScore($score);
        // $this->addPlaylistItemScore($score);

        return true;
    }

    public function _addScore(RoomScore $score)
    {
        $highestScore = static::read($score);

        if ($highestScore === null || $score->total_score > $highestScore->total_score) {
            static::write($score);
            $this->updateUserTotal($score, $highestScore);
        } else {
            $this->updateUserAttempts();
        }
    }

    // lazy function for testing
    public static function read($score)
    {
        $json = json_decode(
            app('redis')->get("mp_high_score:{$score->playlist_item_id}:{$score->user_id}"),
            true
        );

        if ($json !== null) {
            return new RoomScore($json);
        }
    }

    public function updateUserAttempts()
    {
        $total = $this->readUserTotal();
        $total['attempts']++;

        app('redis')->set(
            "mp_high_score_total:{$this->roomId}:{$this->user->getKey()}",
            json_encode($total)
        );

        return $total;
    }

    public function updateUserTotal(RoomScore $current, ?RoomScore $prev)
    {
        $total = $this->readUserTotal();

        $total['attempts']++;

        if ($prev) {
            $total['total_score'] -= $prev->total_score;
            $total['accuracy'] -= $prev->accuracy;
            $total['pp'] -= $prev->pp;
            $total['passed']--;
        }

        $total['total_score'] += $current->total_score;
        $total['accuracy'] += $current->accuracy;
        $total['pp'] += $current->pp;
        $total['passed']++;

        app('redis')->set(
            "mp_high_score_total:{$this->roomId}:{$this->user->getKey()}",
            json_encode($total)
        );

        return $total;
    }

    public function readUserTotal()
    {
        $total = json_decode(app('redis')->get("mp_high_score_total:{$this->roomId}:{$this->user->getKey()}"), true);
        foreach (['total_score', 'accuracy', 'pp', 'attempts', 'passed'] as $key) {
            // init if required
            $total[$key] = $total[$key] ?? 0;
        }

        return $total;
    }

    // lazy function for testing
    public static function write($score)
    {
        app('redis')->set(
            "mp_high_score:{$score->playlist_item_id}:{$score->user_id}",
            json_encode($score->toArray())
        );
    }

    public function toArray() : ?array
    {
        $total = $this->readUserTotal();
        $completedCount = get_int($total['passed']);
        if ($completedCount === 0) {
            return null;
        }

        return [
            'accuracy' => $total['accuracy'] / $completedCount,
            'attempts' => $total['attempts'],
            'completed' => $completedCount,
            'pp' => $total['pp'] / $completedCount,
            'room_id' => $this->roomId,
            'total_score' => $total['total_score'],
            'user' => json_item($this->user, 'UserCompact', ['country']),
            'user_id' => $this->user->user_id,
        ];
    }

    public function getAccuracyAverage() : float
    {
        return $this->accuracy / $this->completedCount;
    }

    public function getAttempts() : int
    {
        return $this->attempts;
    }

    public function getCompletedCount() : int
    {
        return $this->completedCount;
    }

    public function getPpAverage() : float
    {
        return $this->pp / $this->completedCount;
    }

    public function getTotalScore() : int
    {
        return $this->totalScore;
    }

    private function addPlaylistItemScore(RoomScore $score)
    {
        // FIXME: this wasn't removing old scores!
        $itemId = $score->playlist_item_id;
        if (!isset($this->stats[$itemId])) {
            $this->stats[$itemId] = [];
        }

        if (!isset($this->topScores[$itemId])) {
            $this->topScores[$itemId] = 0;
        }

        if ($this->topScores[$itemId] > $score->total_score) {
            return;
        }

        $this->completedCount++;
        $this->topScores[$itemId] = $score->total_score;
        $this->totalScore += $score->total_score;
        $this->accuracy += $score->accuracy;
        $this->pp += $score->pp;
    }
}
