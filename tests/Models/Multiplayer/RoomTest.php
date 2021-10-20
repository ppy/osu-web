<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Multiplayer;

use App\Exceptions\InvariantException;
use App\Models\Beatmap;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\User;
use Exception;
use Tests\TestCase;

class RoomTest extends TestCase
{
    public function testStartGameWithBeatmap()
    {
        $beatmap = Beatmap::factory()->create();
        $user = User::factory()->create();

        $params = [
            'duration' => 60,
            'name' => 'test',
            'playlist' => [
                [
                    'beatmap_id' => $beatmap->getKey(),
                    'ruleset_id' => $beatmap->playmode,
                ],
            ],
        ];

        $room = (new Room())->startGame($user, $params);
        $this->assertTrue($room->exists);
    }

    public function testStartGameWithDeletedBeatmap()
    {
        $beatmap = Beatmap::factory()->create(['deleted_at' => now()]);
        $user = User::factory()->create();

        $params = [
            'duration' => 60,
            'name' => 'test',
            'playlist' => [
                [
                    'beatmap_id' => $beatmap->getKey(),
                    'ruleset_id' => $beatmap->playmode,
                ],
            ],
        ];

        $this->expectException(InvariantException::class);
        (new Room())->startGame($user, $params);
    }

    public function testRoomHasEnded()
    {
        $user = User::factory()->create();
        $room = factory(Room::class)->states('ended')->create();
        $playlistItem = factory(PlaylistItem::class)->create([
            'room_id' => $room->getKey(),
        ]);

        $this->expectException(InvariantException::class);
        $room->startPlay($user, $playlistItem);
    }

    public function testMaxAttemptsReached()
    {
        $user = User::factory()->create();
        $room = factory(Room::class)->create(['max_attempts' => 2]);
        $playlistItem1 = factory(PlaylistItem::class)->create([
            'room_id' => $room->getKey(),
        ]);
        $playlistItem2 = factory(PlaylistItem::class)->create([
            'room_id' => $room->getKey(),
        ]);

        $room->startPlay($user, $playlistItem1);
        $this->assertTrue(true);

        $room->startPlay($user, $playlistItem2);
        $this->assertTrue(true);

        $this->expectException(InvariantException::class);
        $room->startPlay($user, $playlistItem1);
    }

    public function testMaxAttemptsForItemReached()
    {
        $user = User::factory()->create();
        $room = factory(Room::class)->create();
        $playlistItem1 = factory(PlaylistItem::class)->create([
            'room_id' => $room->getKey(),
            'max_attempts' => 1,
        ]);
        $playlistItem2 = factory(PlaylistItem::class)->create([
            'room_id' => $room->getKey(),
            'max_attempts' => 1,
        ]);

        $initialCount = $room->scores()->count();
        $room->startPlay($user, $playlistItem1);
        $this->assertSame($initialCount + 1, $room->scores()->count());

        $initialCount = $room->scores()->count();
        try {
            $room->startPlay($user, $playlistItem1);
        } catch (Exception $ex) {
            $this->assertTrue($ex instanceof InvariantException);
        }
        $this->assertSame($initialCount, $room->scores()->count());

        $initialCount = $room->scores()->count();
        $room->startPlay($user, $playlistItem2);
        $this->assertSame($initialCount + 1, $room->scores()->count());
    }
}
