<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

use App\Exceptions\InvariantException;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\User;
use TestCase;

class RoomTest extends TestCase
{
    public function testRoomHasEnded()
    {
        $user = factory(User::class)->create();
        $room = factory(Room::class)->states('ended')->create();
        $playlistItem = factory(PlaylistItem::class)->create([
            'room_id' => $room->getKey(),
        ]);

        $this->expectException(InvariantException::class);
        $room->startPlay($user, $playlistItem);
    }

    public function testMaxAttemptsReached()
    {
        $user = factory(User::class)->create();
        $room = factory(Room::class)->create(['max_attempts' => 2]);
        $playlistItem = factory(PlaylistItem::class)->create([
            'room_id' => $room->getKey(),
        ]);

        $room->startPlay($user, $playlistItem);
        $this->assertTrue(true);

        $room->startPlay($user, $playlistItem);
        $this->assertTrue(true);

        $this->expectException(InvariantException::class);
        $room->startPlay($user, $playlistItem);
    }
}
