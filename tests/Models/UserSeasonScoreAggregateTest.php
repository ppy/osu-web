<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\Season;
use App\Models\SeasonRoom;
use App\Models\User;
use App\Models\UserSeasonScoreAggregate;
use Tests\TestCase;

class UserSeasonScoreAggregateTest extends TestCase
{
    private Season $season;
    private User $user;

    public function testAddMultipleScores(): void
    {
        $this->createRoomWithPlay('A', 10);

        $userScore = UserSeasonScoreAggregate::where('user_id', $this->user->getKey())
            ->where('season_id', $this->season->getKey())
            ->first();

        $this->assertSame(10.0, $userScore->total_score); // 10*1

        $this->createRoomWithPlay('B', 15);

        $userScore->refresh();
        $this->assertSame(22.5, $userScore->total_score); // 15*1 + 10*0.75

        $this->createRoomWithPlay('C', 25);

        $userScore->refresh();
        $this->assertSame(41.25, $userScore->total_score); // 25*1 + 15*0.75 + 10*0.5
    }

    public function testAddMultipleScoresWithChildrenRooms(): void
    {
        $this->createRoomWithPlay('A', 10);

        $userScore = UserSeasonScoreAggregate::where('user_id', $this->user->getKey())
            ->where('season_id', $this->season->getKey())
            ->first();

        $this->assertSame(10.0, $userScore->total_score); // 10*1

        $this->createRoomWithPlay('A', 15);

        $userScore->refresh();
        $this->assertSame(15.0, $userScore->total_score); // 15*1

        $this->createRoomWithPlay('B', 20);

        $userScore->refresh();
        $this->assertSame(31.25, $userScore->total_score); // 20*1 + 15*0.75

        $this->createRoomWithPlay('B', 20);

        $userScore->refresh();
        $this->assertSame(31.25, $userScore->total_score); // 20*1 + 15*0.75

        $this->createRoomWithPlay('C', 10);

        $userScore->refresh();
        $this->assertSame(36.25, $userScore->total_score); // 20*1 + 15*0.75 + 10*0.5

        $this->createRoomWithPlay('C', 30);

        $userScore->refresh();
        $this->assertSame(52.5, $userScore->total_score); // 30*1 + 20*0.75 + 15*0.5
    }

    public function testAddHigherScoreInChildRoom(): void
    {
        $this->createRoomWithPlay('A', 10);

        $userScore = UserSeasonScoreAggregate::where('user_id', $this->user->getKey())
            ->where('season_id', $this->season->getKey())
            ->first();

        $this->assertSame(10.0, $userScore->total_score);

        $this->createRoomWithPlay('A', 15);

        $userScore->refresh();
        $this->assertSame(15.0, $userScore->total_score);
    }

    public function testAddHigherScoreInParentRoom(): void
    {
        $this->createRoomWithPlay('A', 15);

        $userScore = UserSeasonScoreAggregate::where('user_id', $this->user->getKey())
            ->where('season_id', $this->season->getKey())
            ->first();

        $this->assertSame(15.0, $userScore->total_score);

        $this->createRoomWithPlay('A', 10);

        $userScore->refresh();
        $this->assertSame(15.0, $userScore->total_score);
    }

    public function testAddSameScoreInChildAndParentRoom(): void
    {
        $this->createRoomWithPlay('A', 10);

        $userScore = UserSeasonScoreAggregate::where('user_id', $this->user->getKey())
            ->where('season_id', $this->season->getKey())
            ->first();

        $this->assertSame(10.0, $userScore->total_score);

        $this->createRoomWithPlay('A', 10);

        $userScore->refresh();
        $this->assertSame(10.0, $userScore->total_score);
    }

    public function testAddScoreInChildRoomOnly(): void
    {
        $this->createRoom('A');
        $this->createRoomWithPlay('A', 10);

        $userScore = UserSeasonScoreAggregate::where('user_id', $this->user->getKey())
            ->where('season_id', $this->season->getKey())
            ->first();

        $this->assertSame(10.0, $userScore->total_score);
    }

    public function testAddScoreInSecondRoomOnly(): void
    {
        $this->createRoom('A');
        $this->createRoomWithPlay('B', 10);

        $userScore = UserSeasonScoreAggregate::where('user_id', $this->user->getKey())
            ->where('season_id', $this->season->getKey())
            ->first();

        $this->assertSame(10.0, $userScore->total_score);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->season = Season::factory()->create([
            'score_factors' => [1, 0.75, 0.5],
        ]);
        $this->user = User::factory()->create();
    }

    private function createRoom(string $groupIndicator): Room
    {
        $room = Room::factory()->create([
            'category' => 'spotlight',
        ]);

        SeasonRoom::factory()->create([
            'group_indicator' => $groupIndicator,
            'room_id' => $room,
            'season_id' => $this->season,
        ]);

        return $room;
    }

    private function createRoomWithPlay(string $groupIndicator, float $totalScore): Room
    {
        $room = $this->createRoom($groupIndicator);

        $playlistItem = PlaylistItem::factory()->create([
            'owner_id' => $room->host,
            'room_id' => $room,
        ]);

        static::roomAddPlay($this->user, $playlistItem, [
            'passed' => true,
            'total_score' => $totalScore,
        ]);

        return $room;
    }
}
