<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace Tests\Models\Multiplayer;

use App\Exceptions\InvariantException;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\User;
use Tests\TestCase;

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
