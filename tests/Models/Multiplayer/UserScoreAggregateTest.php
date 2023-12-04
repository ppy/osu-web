<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models\Multiplayer;

use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\ScoreLink;
use App\Models\Multiplayer\UserScoreAggregate;
use App\Models\User;
use App\Transformers\Multiplayer\UserScoreAggregateTransformer;
use Tests\TestCase;

class UserScoreAggregateTest extends TestCase
{
    private Room $room;

    public function testStartingPlayIncreasesAttempts(): void
    {
        $user = User::factory()->create();
        $playlistItem = $this->playlistItem();

        $this->room->startPlay($user, $playlistItem, 0);
        $agg = UserScoreAggregate::new($user, $this->room);

        $this->assertSame(1, $agg->attempts);
        $this->assertSame(0, $agg->completed);
    }

    public function testFailedScoresAreAttemptsOnly(): void
    {
        $user = User::factory()->create();
        $playlistItem = $this->playlistItem();

        $this->addPlay($user, $playlistItem, [
            'accuracy' => 0.1,
            'passed' => false,
            'total_score' => 10,
        ]);

        $this->addPlay($user, $playlistItem, [
            'accuracy' => 1,
            'passed' => true,
            'total_score' => 1,
        ]);

        $agg = UserScoreAggregate::new($user, $this->room);

        $this->assertSame(2, $agg->attempts);
        $this->assertSame(1, $agg->completed);
        $this->assertSame(1, $agg->total_score);
    }

    public function testPassedScoresIncrementsCompletedCount(): void
    {
        $user = User::factory()->create();
        $playlistItem = $this->playlistItem();

        $this->addPlay($user, $playlistItem, [
            'accuracy' => 1,
            'passed' => true,
            'total_score' => 1,
        ]);

        $agg = UserScoreAggregate::new($user, $this->room);

        $this->assertSame(1, $agg->completed);
        $this->assertSame(1, $agg->total_score);
    }

    public function testPassedScoresAreAveragedInTransformer(): void
    {
        $user = User::factory()->create();
        $playlistItem = $this->playlistItem();
        $playlistItem2 = $this->playlistItem();

        $this->addPlay($user, $playlistItem, [
            'accuracy' => 0.1,
            'passed' => false,
            'total_score' => 1,
        ]);

        $this->addPlay($user, $playlistItem, [
            'accuracy' => 0.3,
            'passed' => false,
            'total_score' => 1,
        ]);

        $this->addPlay($user, $playlistItem, [
            'accuracy' => 0.5,
            'passed' => true,
            'total_score' => 1,
        ]);

        $this->addPlay($user, $playlistItem2, [
            'accuracy' => 0.8,
            'passed' => true,
            'total_score' => 1,
        ]);

        $agg = UserScoreAggregate::new($user, $this->room);

        $result = json_item($agg, new UserScoreAggregateTransformer());

        $this->assertSame(0.65, $result['accuracy']);
    }

    public function testRecalculate(): void
    {
        $playlistItem = $this->playlistItem();
        $user = User::factory()->create();
        $this->addPlay($user, $playlistItem, [
            'accuracy' => 0.3,
            'passed' => true,
            'total_score' => 1,
        ]);
        $agg = UserScoreAggregate::new($user, $this->room);
        $agg->recalculate();
        $agg->refresh();

        $this->assertSame(1, $agg->total_score);
        $this->assertSame(1, $agg->attempts);
        $this->assertSame(0.3, $agg->accuracy);
        $this->assertSame(1, $agg->completed);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->room = Room::factory()->create();
    }

    private function addPlay(User $user, PlaylistItem $playlistItem, array $params): ScoreLink
    {
        $token = $playlistItem->room->startPlay($user, $playlistItem, 0);

        return $playlistItem->room->completePlay($token, [
            'beatmap_id' => $playlistItem->beatmap_id,
            'ended_at' => json_time(new \DateTime()),
            'ruleset_id' => $playlistItem->ruleset_id,
            'statistics' => ['good' => 1],
            'user_id' => $user->getKey(),
            ...$params,
        ]);
    }

    private function playlistItem(): PlaylistItem
    {
        return PlaylistItem::factory()->create([
            'room_id' => $this->room,
        ]);
    }
}
