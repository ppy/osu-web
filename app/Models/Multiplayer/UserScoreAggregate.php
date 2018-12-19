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

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function addScores(Collection $scores)
    {
        foreach ($scores->sortByDesc('total_score') as $score) {
            $this->addScore($score);
        }
    }
    public function addScore(RoomScore $score)
    {
        if (!$score->isCompleted()) {
            return false; // throw instead?
        }

        $this->attempts++;
        if (!$score->passed) {
            return true;
        }

        $this->roomId = $score->room_id;
        $this->addPlaylistItemScore($score);

        return true;
    }

    public function toArray() : ?array
    {
        if ($this->completedCount === 0) {
            return null;
        }

        return [
            'accuracy' => $this->accuracy / $this->completedCount,
            'attempts' => $this->attempts,
            'completed' => $this->completedCount,
            'pp' => $this->pp / $this->completedCount,
            'room_id' => $this->roomId,
            'total_score' => $this->totalScore,
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
