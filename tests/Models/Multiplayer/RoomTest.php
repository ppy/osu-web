<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Multiplayer;

use App\Exceptions\InvariantException;
use App\Models\Beatmap;
use App\Models\ChatFilter;
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

    public function testStartGameWithInvalidRuleset()
    {
        $beatmap = Beatmap::factory()->create([
            'playmode' => 2,
        ]);
        $user = User::factory()->create();

        $params = [
            'duration' => 60,
            'name' => 'test',
            'playlist' => [
                [
                    'beatmap_id' => $beatmap->getKey(),
                    'ruleset_id' => 0,
                ],
            ],
        ];

        $this->expectException(InvariantException::class);
        $this->expectExceptionMessageMatches('/^invalid ruleset_id for beatmap \d+$/');
        (new Room())->startGame($user, $params);
    }

    public function testRoomHasEnded()
    {
        $user = User::factory()->create();
        $room = Room::factory()->ended()->create();
        $playlistItem = PlaylistItem::factory()->create([
            'room_id' => $room,
        ]);

        $this->expectException(InvariantException::class);
        $room->startPlay($user, $playlistItem, 0);
    }

    public function testStartPlay(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();
        $playlistItem = PlaylistItem::factory()->create(['room_id' => $room]);

        $this->expectCountChange(fn () => $room->participant_count, 1);
        $this->expectCountChange(fn () => $room->userHighScores()->count(), 1);
        $this->expectCountChange(fn () => $playlistItem->scoreTokens()->count(), 1);

        $room->startPlay($user, $playlistItem, 0);
        $room->refresh();

        $this->assertSame($user->getKey(), $playlistItem->scoreTokens()->last()->user_id);
    }

    public function testMaxAttemptsReached()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create(['max_attempts' => 2]);
        $playlistItem1 = PlaylistItem::factory()->create(['room_id' => $room]);
        $playlistItem2 = PlaylistItem::factory()->create(['room_id' => $room]);

        $room->startPlay($user, $playlistItem1, 0);
        $this->assertTrue(true);

        $room->startPlay($user, $playlistItem2, 0);
        $this->assertTrue(true);

        $this->expectException(InvariantException::class);
        $room->startPlay($user, $playlistItem1, 0);
    }

    public function testMaxAttemptsForItemReached()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();
        $playlistItem1 = PlaylistItem::factory()->create([
            'room_id' => $room,
            'max_attempts' => 1,
        ]);
        $playlistItem2 = PlaylistItem::factory()->create([
            'room_id' => $room,
            'max_attempts' => 1,
        ]);

        $initialCount = $playlistItem1->scoreTokens()->count();
        $room->startPlay($user, $playlistItem1, 0);
        $this->assertSame($initialCount + 1, $playlistItem1->scoreTokens()->count());

        $initialCount = $playlistItem1->scoreTokens()->count();
        try {
            $room->startPlay($user, $playlistItem1, 0);
        } catch (Exception $ex) {
            $this->assertTrue($ex instanceof InvariantException);
        }
        $this->assertSame($initialCount, $playlistItem1->scoreTokens()->count());

        $initialCount = $playlistItem2->scoreTokens()->count();
        $room->startPlay($user, $playlistItem2, 0);
        $this->assertSame($initialCount + 1, $playlistItem2->scoreTokens()->count());
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

    public function testNameFiltering()
    {
        ChatFilter::factory()->create([
            'match' => 'bad',
            'replacement' => 'good',
        ]);
        $beatmap = Beatmap::factory()->create();
        $user = User::factory()->create();

        $params = [
            'name' => 'bad word',
            'playlist' => [
                [
                    'beatmap_id' => $beatmap->getKey(),
                    'ruleset_id' => $beatmap->playmode,
                    'played_at' => time(),
                ],
            ],
            'type' => 'head_to_head',
        ];

        $room = new Room();
        $room->startGame($user, $params);
        $this->assertSame('good word', $room->name);
    }

    public static function startGameDurationDataProvider()
    {
        static $dayMinutes = 1440;
        static::createApp();

        $maxDuration = $GLOBALS['cfg']['osu']['user']['max_multiplayer_duration'];
        $maxDurationSupporter = $GLOBALS['cfg']['osu']['user']['max_multiplayer_duration_supporter'];

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
