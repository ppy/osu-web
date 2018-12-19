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

namespace Tests\Multiplayer;

use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\RoomScore;
use App\Models\Multiplayer\UserScoreAggregate;
use App\Models\Beatmap;
use App\Models\User;
use Carbon\Carbon;
use TestCase;
use App\Models\Multiplayer\PlaylistItem;

class UserScoreAggregateTest extends TestCase
{
    private $room;

    public function setUp()
    {
        parent::setUp();

        $this->room = factory(Room::class)->create();
    }

    public function testInCompleteScoresAreNotCounted()
    {
        $user = factory(User::class)->create();
        $playlistItem = $this->playlistItem();
        $score = factory(RoomScore::class)
            ->create([
                'room_id' => $this->room->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'user_id' => $user->getKey(),
            ]);

        $agg = new UserScoreAggregate($user);
        $agg->addScore($score);

        $this->assertSame(0, $agg->getAttempts());
        $this->assertSame(0, $agg->getCompletedCount());
        $this->assertSame(0, $agg->getTotalScore());
    }

    public function testFailedScoresAreAttemptsOnly()
    {
        $user = factory(User::class)->create();
        $playlistItem = $this->playlistItem();
        $score = factory(RoomScore::class)
            ->states('completed', 'failed')
            ->create([
                'room_id' => $this->room->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'user_id' => $user->getKey(),
            ]);


        $agg = new UserScoreAggregate($user);
        $agg->addScore($score);

        $this->assertSame(1, $agg->getAttempts());
        $this->assertSame(0, $agg->getCompletedCount());
        $this->assertSame(0, $agg->getTotalScore());
    }

    public function testPassedScoresIncrementsCompletedCount()
    {
        $user = factory(User::class)->create();
        $playlistItem = $this->playlistItem();
        $score = factory(RoomScore::class)
            ->states('completed', 'passed')
            ->create([
                'room_id' => $this->room->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'user_id' => $user->getKey(),
            ]);

        $agg = new UserScoreAggregate($user);
        $agg->addScore($score);

        $this->assertSame(1, $agg->getAttempts());
        $this->assertSame(1, $agg->getCompletedCount());
        $this->assertSame(1, $agg->getTotalScore());
    }

    public function testPassedScoresAreAveraged()
    {
        $user = factory(User::class)->create();
        $playlistItem = $this->playlistItem();

        $agg = new UserScoreAggregate($user);
        $agg->addScore(
            factory(RoomScore::class)
            ->create([
                'room_id' => $this->room->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'user_id' => $user->getKey(),
                'total_score' => 1,
                'pp' => 0.2,
                'pp' => 0.2,
            ])
        );

        $agg->addScore(
            factory(RoomScore::class)
            ->states('completed', 'failed')
            ->create([
                'room_id' => $this->room->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'user_id' => $user->getKey(),
                'total_score' => 1,
                'accuracy' => 0.3,
                'pp' => 0.3,
            ])
        );

        $agg->addScore(
            factory(RoomScore::class)
            ->states('completed', 'passed')
            ->create([
                'room_id' => $this->room->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'user_id' => $user->getKey(),
                'total_score' => 1,
                'accuracy' => 0.5,
                'pp' => 0.5,
            ])
        );

        $agg->addScore(
            factory(RoomScore::class)
            ->states('completed', 'passed')
            ->create([
                'room_id' => $this->room->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'user_id' => $user->getKey(),
                'total_score' => 1,
                'accuracy' => 0.8,
                'pp' => 0.8,
            ])
        );

        $this->assertSame((0.5 + 0.8) / 2, $agg->getPpAverage());
        $this->assertSame((0.5 + 0.8) / 2, $agg->getAccuracyAverage());
    }

    private function playlistItem()
    {
        return factory(PlaylistItem::class)->create([
            'room_id' => $this->room->getKey(),
        ]);
    }
}
