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
    /**
     * @dataProvider startGameDurationDataProvider
     */
    public function testStartGameDuration(int $duration, bool $isSupporter, ?string $errorMessageKey)
    {
        $beatmap = Beatmap::factory()->create();
        $user = User::factory();
        if ($isSupporter) {
            $user = $user->supporter();
        }

        $user = $user->create();

        $params = [
            'duration' => $duration,
            'name' => 'test',
            'playlist' => [
                [
                    'beatmap_id' => $beatmap->getKey(),
                    'ruleset_id' => $beatmap->playmode,
                ],
            ],
        ];

        if ($errorMessageKey !== null) {
            $this->expectException(InvariantException::class);
            $this->expectExceptionMessage(osu_trans($errorMessageKey));
        }

        $room = (new Room())->startGame($user, $params);
        $this->assertSame($errorMessageKey === null, $room->exists);
    }

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

    public function testCannotStartPlayedItem()
    {
        $beatmap = Beatmap::factory()->create();
        $user = User::factory()->create();

        $params = [
            'name' => 'test',
            'playlist' => [
                [
                    'beatmap_id' => $beatmap->getKey(),
                    'ruleset_id' => $beatmap->playmode,
                    'played_at' => time(),
                ],
            ],
        ];

        $this->expectException(InvariantException::class);
        (new Room())->startGame($user, $params);
    }

    public function startGameDurationDataProvider()
    {
        return [
            '2 weeks' => [20160, true, null],
            '2 weeks (with supporter)' => [20160, true, null],
            'more than 2 weeks' => [20161, false, 'multiplayer.room.errors.duration_require_supporter'],
            'more than 2 weeks (with supporter)' => [20161, true, null],
            '3 months' => [90720, false, 'multiplayer.room.errors.duration_require_supporter'],
            '3 months (with supporter)' => [90720, true, null],
            'more than 3 months' => [90721, false, 'multiplayer.room.errors.duration_require_supporter'],
            'more than 3 months (with supporter)' => [90721, true, 'multiplayer.room.errors.duration_too_long'],
        ];
    }
}
