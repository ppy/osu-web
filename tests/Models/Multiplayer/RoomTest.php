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
    public function testStartGameDuration(int $duration, bool $isSupporter, bool $expectException)
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

        if ($expectException) {
            $this->expectException(InvariantException::class);
            $this->expectExceptionMessage(osu_trans('multiplayer.room.errors.duration_too_long'));
            $this->expectCountChange(fn () => Room::count(), 0);
        } else {
            $this->expectCountChange(fn () => Room::count(), 1);
        }

        $room = (new Room())->startGame($user, $params);
        $this->assertTrue($room->exists);
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
        static $dayMinutes = 1440;

        $maxDuration = config('osu.user.max_multiplayer_duration');
        $maxDurationSupporter = config('osu.user.max_multiplayer_duration_supporter');

        return [
            '2 weeks' => [$dayMinutes * $maxDuration, false, false],
            '2 weeks (with supporter)' => [$dayMinutes * $maxDuration, true, false],
            'more than 2 weeks' => [$dayMinutes * $maxDuration + 1, false, true],
            'more than 2 weeks (with supporter)' => [$dayMinutes * $maxDuration + 1, true, false],
            '3 months' => [$dayMinutes * $maxDurationSupporter, false, true],
            '3 months (with supporter)' => [$dayMinutes * $maxDurationSupporter, true, false],
            'more than 3 months' => [$dayMinutes * $maxDurationSupporter + 1, false, true],
            'more than 3 months (with supporter)' => [$dayMinutes * $maxDurationSupporter + 1, true, true],
        ];
    }
}
