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
use App\Models\UserSeasonScore;
use Tests\TestCase;

class UserSeasonScoreTest extends TestCase
{
    private Season $season;
    private User $user;

    public function testAddMultipleScores(): void
    {
        $this->createRoomWithPlay(10);

        $userScore = UserSeasonScore::where('user_id', $this->user->getKey())
            ->where('season_id', $this->season->getKey())
            ->first();

        $this->assertSame($userScore->total_score, (float) 10); // 10*1

        $this->createRoomWithPlay(15);

        $userScore->refresh();
        $this->assertSame($userScore->total_score, 22.5); // 15*1 + 10*0.75

        $this->createRoomWithPlay(25);

        $userScore->refresh();
        $this->assertSame($userScore->total_score, 41.25); // 25*1 + 15*0.75 + 10*0.5
    }

    public function testAddMultipleScoresWithChildrenRooms(): void
    {
        $firstRoom = $this->createRoomWithPlay(10);

        $userScore = UserSeasonScore::where('user_id', $this->user->getKey())
            ->where('season_id', $this->season->getKey())
            ->first();

        $this->assertSame($userScore->total_score, (float) 10); // 10*1

        $this->createRoomWithPlay(15, $firstRoom->getKey());

        $userScore->refresh();
        $this->assertSame($userScore->total_score, (float) 15); // 15*1

        $secondRoom = $this->createRoomWithPlay(20);

        $userScore->refresh();
        $this->assertSame($userScore->total_score, 31.25); // 20*1 + 15*0.75

        $this->createRoomWithPlay(20, $secondRoom->getKey());

        $userScore->refresh();
        $this->assertSame($userScore->total_score, 31.25); // 20*1 + 15*0.75

        $thirdRoom = $this->createRoomWithPlay(10);

        $userScore->refresh();
        $this->assertSame($userScore->total_score, 36.25); // 20*1 + 15*0.75 + 10*0.5

        $this->createRoomWithPlay(30, $thirdRoom->getKey());

        $userScore->refresh();
        $this->assertSame($userScore->total_score, 52.5); // 30*1 + 20*0.75 + 15*0.5
    }

    public function testAddHigherScoreInChildRoom(): void
    {
        $room = $this->createRoomWithPlay(10);

        $userScore = UserSeasonScore::where('user_id', $this->user->getKey())
            ->where('season_id', $this->season->getKey())
            ->first();

        $this->assertSame($userScore->total_score, (float) 10);

        $this->createRoomWithPlay(15, $room->getKey());

        $userScore->refresh();
        $this->assertSame($userScore->total_score, (float) 15);
    }

    public function testAddHigherScoreInParentRoom(): void
    {
        $room = $this->createRoomWithPlay(15);

        $userScore = UserSeasonScore::where('user_id', $this->user->getKey())
            ->where('season_id', $this->season->getKey())
            ->first();

        $this->assertSame($userScore->total_score, (float) 15);

        $this->createRoomWithPlay(10, $room->getKey());

        $userScore->refresh();
        $this->assertSame($userScore->total_score, (float) 15);
    }

    public function testAddSameScoreInChildAndParentRoom(): void
    {
        $room = $this->createRoomWithPlay(10);

        $userScore = UserSeasonScore::where('user_id', $this->user->getKey())
            ->where('season_id', $this->season->getKey())
            ->first();

        $this->assertSame($userScore->total_score, (float) 10);

        $this->createRoomWithPlay(10, $room->getKey());

        $userScore->refresh();
        $this->assertSame($userScore->total_score, (float) 10);
    }

    public function testAddScoreInChildRoomOnly(): void
    {
        $room = $this->createRoom();
        $this->createRoomWithPlay(10, $room->getKey());

        $userScore = UserSeasonScore::where('user_id', $this->user->getKey())
            ->where('season_id', $this->season->getKey())
            ->first();

        $this->assertSame($userScore->total_score, (float) 10);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->season = Season::factory()->create([
            'score_factors' => [1, 0.75, 0.5],
        ]);
        $this->user = User::factory()->create();
    }

    private function createRoom(?int $parentId = null): Room
    {
        $room = Room::factory()->create([
            'category' => 'spotlight',
            'parent_id' => $parentId,
        ]);

        SeasonRoom::factory()->create([
            'room_id' => $room,
            'season_id' => $this->season,
        ]);

        return $room;
    }

    private function createRoomWithPlay(float $totalScore, ?int $parentId = null): Room
    {
        $room = $this->createRoom($parentId);

        $playlistItem = PlaylistItem::factory()->create([
            'owner_id' => $room->host,
            'room_id' => $room,
        ]);

        $this->roomAddPlay($this->user, $playlistItem, [
            'passed' => true,
            'total_score' => $totalScore,
        ]);

        return $room;
    }
}
