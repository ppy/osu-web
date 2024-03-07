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

    public function testAddingHigherScore(): void
    {
        $user = User::factory()->create();
        $playlistItem = $this->createPlaylistItem();

        // first play
        $scoreLink = $this->addPlay($user, $playlistItem, [
            'accuracy' => 1,
            'passed' => true,
            'total_score' => 10,
        ]);

        $agg = UserScoreAggregate::new($user, $this->room);
        $this->assertSame(1, $agg->completed);
        $this->assertSame(1.0, $agg->accuracy);
        $this->assertSame(10, $agg->total_score);
        $this->assertSame($scoreLink->getKey(), $agg->last_score_id);

        // second, higher score play
        $scoreLink2 = $this->addPlay($user, $playlistItem, [
            'accuracy' => 2,
            'passed' => true,
            'total_score' => 100,
        ]);

        $agg->refresh();
        $this->assertSame(1, $agg->completed);
        $this->assertSame(2.0, $agg->accuracy);
        $this->assertSame(100, $agg->total_score);
        $this->assertSame($scoreLink2->getKey(), $agg->last_score_id);
    }

    public function testAddingLowerScore(): void
    {
        $user = User::factory()->create();
        $playlistItem = $this->createPlaylistItem();

        // first play
        $scoreLink = $this->addPlay($user, $playlistItem, [
            'accuracy' => 1,
            'passed' => true,
            'total_score' => 10,
        ]);

        $agg = UserScoreAggregate::new($user, $this->room);
        $this->assertSame(1, $agg->completed);
        $this->assertSame(1.0, $agg->accuracy);
        $this->assertSame(10, $agg->total_score);
        $this->assertSame($scoreLink->getKey(), $agg->last_score_id);

        // second, lower score play
        $this->addPlay($user, $playlistItem, [
            'accuracy' => 2,
            'passed' => true,
            'total_score' => 1,
        ]);

        $agg->refresh();
        $this->assertSame(1, $agg->completed);
        $this->assertSame(1.0, $agg->accuracy);
        $this->assertSame(10, $agg->total_score);
        $this->assertSame($scoreLink->getKey(), $agg->last_score_id);
    }

    public function testAddingMultiplePlaylistItems(): void
    {
        $user = User::factory()->create();
        $playlistItem = $this->createPlaylistItem();
        $playlistItem2 = $this->createPlaylistItem();

        // first playlist item
        $this->addPlay($user, $playlistItem, [
            'accuracy' => 1,
            'passed' => true,
            'total_score' => 10,
        ]);

        $agg = UserScoreAggregate::new($user, $this->room);
        $this->assertSame(1, $agg->completed);
        $this->assertSame(1.0, $agg->accuracy);
        $this->assertSame(1.0, $agg->averageAccuracy());
        $this->assertSame(10, $agg->total_score);

        // second playlist item
        $scoreLink = $this->addPlay($user, $playlistItem2, [
            'accuracy' => 2,
            'passed' => true,
            'total_score' => 100,
        ]);

        $agg->refresh();
        $this->assertSame(2, $agg->completed);
        $this->assertSame(3.0, $agg->accuracy);
        $this->assertSame(1.5, $agg->averageAccuracy());
        $this->assertSame(110, $agg->total_score);
        $this->assertSame($scoreLink->getKey(), $agg->last_score_id);
    }

    public function testStartingPlayIncreasesAttempts(): void
    {
        $user = User::factory()->create();
        $playlistItem = $this->createPlaylistItem();

        $this->room->startPlay($user, $playlistItem, 0);
        $agg = UserScoreAggregate::new($user, $this->room);

        $this->assertSame(1, $agg->attempts);
        $this->assertSame(0, $agg->completed);
    }

    public function testFailedScoresAreAttemptsOnly(): void
    {
        $user = User::factory()->create();
        $playlistItem = $this->createPlaylistItem();

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
        $playlistItem = $this->createPlaylistItem();

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
        $playlistItem = $this->createPlaylistItem();
        $playlistItem2 = $this->createPlaylistItem();

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
        $playlistItem = $this->createPlaylistItem();
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
        return $playlistItem->room->completePlay(
            $playlistItem->room->startPlay($user, $playlistItem, 0),
            [
                'beatmap_id' => $playlistItem->beatmap_id,
                'ended_at' => json_time(new \DateTime()),
                'max_combo' => 1,
                'statistics' => ['good' => 1],
                'ruleset_id' => $playlistItem->ruleset_id,
                'user_id' => $user->getKey(),
                ...$params,
            ],
        );
    }

    private function createPlaylistItem(): PlaylistItem
    {
        return PlaylistItem::factory()->create([
            'owner_id' => $this->room->host,
            'room_id' => $this->room,
        ]);
    }
}
