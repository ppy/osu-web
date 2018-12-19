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

        $this->room = Room::create([
            'user_id' => factory(User::class)->create()->getKey(),
            'name' => 'a room',
            'starts_at' => Carbon::now(),
            'ends_at' => Carbon::now()->addMinutes(60),
        ]);
    }

    public function testInCompleteScoresAreNotCounted()
    {
        $user = factory(User::class)->create();
        $playlistItem = $this->playlistItem();
        $score = $this->createScore($playlistItem, $user);

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
        $score = $this->createScore($playlistItem, $user);
        $score->ended_at = Carbon::now();

        $agg = new UserScoreAggregate($user);
        $agg->addScore($score);

        $this->assertSame(1, $agg->getAttempts());
        $this->assertSame(0, $agg->getCompletedCount());
        $this->assertSame(0, $agg->getTotalScore());
    }

    private function createScore($playlistItem, $user)
    {
        return RoomScore::create([
            'beatmap_id' => $playlistItem->beatmap_id,
            'playlist_item_id' => $playlistItem->getKey(),
            'room_id' => $this->room->getKey(),
            'user_id' => $user->getKey(),
            'started_at' => Carbon::now(),
            'total_score' => 1,
        ]);
    }

    private function playlistItem()
    {
        return PlaylistItem::create([
            'allowed_mods' => [], // TODO: should look at being able to initialize as default value.
            'beatmap_id' => factory(Beatmap::class)->create([
                'playmode' => 0,
            ])->getKey(),
            'required_mods' => [],
            'room_id' => $this->room->getKey(),
            'ruleset_id' => 0,
        ]);
    }
}
