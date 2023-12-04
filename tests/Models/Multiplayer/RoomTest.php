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
    public function testCompletePlayHigherScore()
    {
        $user = User::factory()->create();
        $playlistItem = PlaylistItem::factory()->create();
        $room = $playlistItem->room;

        $params = [
            'accuracy' => 1,
            'beatmap_id' => $playlistItem->beatmap_id,
            'ended_at' => json_time(new \DateTime()),
            'max_combo' => 10,
            'passed' => true,
            'rank' => 'A',
            'ruleset_id' => $playlistItem->ruleset_id,
            'statistics' => ['Good' => 1],
            'total_score' => 10,
            'user_id' => $user->getKey(),
        ];

        // first play
        $room->completePlay(
            $room->startPlay($user, $playlistItem, 0),
            $params,
        );
        $roomHigh = $room->userHighScores()->where(['user_id' => $user->getKey()])->first();
        $this->assertSame(1, $roomHigh->completed);
        $this->assertSame(1.0, $roomHigh->accuracy);
        $this->assertSame(10, $roomHigh->total_score);

        // second, higher score play
        $room->completePlay(
            $room->startPlay($user, $playlistItem, 0),
            [...$params, 'accuracy' => 2, 'total_score' => 100],
        );

        $roomHigh->refresh();
        $this->assertSame(1, $roomHigh->completed);
        $this->assertSame(2.0, $roomHigh->accuracy);
        $this->assertSame(100, $roomHigh->total_score);
    }

    public function testCompletePlayLowerScore()
    {
        $user = User::factory()->create();
        $playlistItem = PlaylistItem::factory()->create();
        $room = $playlistItem->room;

        $params = [
            'accuracy' => 1,
            'beatmap_id' => $playlistItem->beatmap_id,
            'ended_at' => json_time(new \DateTime()),
            'max_combo' => 10,
            'passed' => true,
            'rank' => 'A',
            'ruleset_id' => $playlistItem->ruleset_id,
            'statistics' => ['Good' => 1],
            'total_score' => 10,
            'user_id' => $user->getKey(),
        ];

        // first play
        $room->completePlay(
            $room->startPlay($user, $playlistItem, 0),
            $params,
        );
        $roomHigh = $room->userHighScores()->where(['user_id' => $user->getKey()])->first();
        $this->assertSame(1, $roomHigh->completed);
        $this->assertSame(1.0, $roomHigh->accuracy);
        $this->assertSame(10, $roomHigh->total_score);

        // second, lower score play
        $room->completePlay(
            $room->startPlay($user, $playlistItem, 0),
            [...$params, 'accuracy' => 2, 'total_score' => 1],
        );

        $roomHigh->refresh();
        $this->assertSame(1, $roomHigh->completed);
        $this->assertSame(1.0, $roomHigh->accuracy);
        $this->assertSame(10, $roomHigh->total_score);
    }

    public function testCompletePlayMultiplePlaylistItems()
    {
        $user = User::factory()->create();
        $playlistItem = PlaylistItem::factory()->create();
        $room = $playlistItem->room;
        $playlistItem2 = PlaylistItem::factory()->create([
            'room_id' => $room,
        ]);

        $params = [
            'accuracy' => 1,
            'beatmap_id' => $playlistItem->beatmap_id,
            'ended_at' => json_time(new \DateTime()),
            'max_combo' => 10,
            'passed' => true,
            'rank' => 'A',
            'ruleset_id' => $playlistItem->ruleset_id,
            'statistics' => ['Good' => 1],
            'total_score' => 10,
            'user_id' => $user->getKey(),
        ];

        // first playlist item
        $room->completePlay(
            $room->startPlay($user, $playlistItem, 0),
            $params,
        );
        $roomHigh = $room->userHighScores()->where(['user_id' => $user->getKey()])->first();
        $this->assertSame(1, $roomHigh->completed);
        $this->assertSame(1.0, $roomHigh->accuracy);
        $this->assertSame(1.0, $roomHigh->averageAccuracy());
        $this->assertSame(10, $roomHigh->total_score);

        // second playlist item
        $room->completePlay(
            $room->startPlay($user, $playlistItem2, 0),
            [
                ...$params,
                'accuracy' => 2,
                'beatmap_id' => $playlistItem2->beatmap_id,
                'ruleset_id' => $playlistItem2->ruleset_id,
                'total_score' => 100,
            ],
        );

        $roomHigh->refresh();
        $this->assertSame(2, $roomHigh->completed);
        $this->assertSame(3.0, $roomHigh->accuracy);
        $this->assertSame(1.5, $roomHigh->averageAccuracy());
        $this->assertSame(110, $roomHigh->total_score);
    }

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

    public static function startGameDurationDataProvider()
    {
        static $dayMinutes = 1440;
        static::createApp();

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
