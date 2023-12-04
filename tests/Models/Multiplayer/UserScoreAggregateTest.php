<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Multiplayer;

use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\ScoreLink;
use App\Models\Multiplayer\UserScoreAggregate;
use App\Models\User;
use Tests\TestCase;

class UserScoreAggregateTest extends TestCase
{
    private $room;

    public function testStartingPlayIncreasesAttempts()
    {
        $user = User::factory()->create();
        $playlistItem = $this->playlistItem();

        $this->room->startPlay($user, $playlistItem, 0);
        $agg = UserScoreAggregate::new($user, $this->room);

        $this->assertSame(1, $agg->attempts);
        $this->assertSame(0, $agg->completed);
    }

    public function testFailedScoresAreAttemptsOnly()
    {
        $user = User::factory()->create();
        $playlistItem = $this->playlistItem();
        $agg = UserScoreAggregate::new($user, $this->room);

        $agg->addScoreLink(
            ScoreLink
                ::factory()
                ->state([
                    'playlist_item_id' => $playlistItem,
                    'user_id' => $user,
                ])->failed()
                ->create()
        );

        $agg->addScoreLink(
            ScoreLink::factory()
                ->state([
                    'playlist_item_id' => $playlistItem,
                    'user_id' => $user,
                ])->completed([], ['passed' => true, 'total_score' => 1])
                ->create()
        );

        $result = json_item($agg, 'Multiplayer\UserScoreAggregate');

        $this->assertSame(1, $result['completed']);
        $this->assertSame(1, $result['total_score']);
    }

    public function testPassedScoresIncrementsCompletedCount()
    {
        $user = User::factory()->create();
        $playlistItem = $this->playlistItem();
        $agg = UserScoreAggregate::new($user, $this->room);

        $agg->addScoreLink(
            ScoreLink::factory()
                ->state([
                    'playlist_item_id' => $playlistItem,
                    'user_id' => $user,
                ])->completed([], ['passed' => true, 'total_score' => 1])
                ->create()
        );

        $result = json_item($agg, 'Multiplayer\UserScoreAggregate');

        $this->assertSame(1, $result['completed']);
        $this->assertSame(1, $result['total_score']);
    }

    public function testPassedScoresAreAveraged()
    {
        $user = User::factory()->create();
        $playlistItem = $this->playlistItem();
        $playlistItem2 = $this->playlistItem();

        $agg = UserScoreAggregate::new($user, $this->room);
        $agg->addScoreLink(ScoreLink::factory()
            ->state([
                'playlist_item_id' => $playlistItem,
                'user_id' => $user,
            ])->completed([], [
                'total_score' => 1,
                'passed' => false,
            ])->create());

        $agg->addScoreLink(ScoreLink::factory()
            ->state([
                'playlist_item_id' => $playlistItem,
                'user_id' => $user,
            ])->completed([], [
                'total_score' => 1,
                'accuracy' => 0.3,
                'passed' => false,
            ])->create());

        $agg->addScoreLink(ScoreLink::factory()
            ->state([
                'playlist_item_id' => $playlistItem,
                'user_id' => $user,
            ])->completed([], [
                'total_score' => 1,
                'accuracy' => 0.5,
                'passed' => true,
            ])->create());

        $agg->addScoreLink(ScoreLink::factory()
            ->state([
                'playlist_item_id' => $playlistItem2,
                'user_id' => $user,
            ])->completed([], [
                'total_score' => 1,
                'accuracy' => 0.8,
                'passed' => true,
            ])->create());

        $result = json_item($agg, 'Multiplayer\UserScoreAggregate');

        $this->assertSame(0.65, $result['accuracy']);
    }

    public function testRecalculate(): void
    {
        $playlistItem = $this->playlistItem();
        $user = User::factory()->create();
        $this->addPlay($user, $playlistItem, [
            'total_score' => 1,
            'accuracy' => 0.3,
            'passed' => true,
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
            ...$params,
            'beatmap_id' => $playlistItem->beatmap_id,
            'ended_at' => json_time(new \DateTime()),
            'ruleset_id' => $playlistItem->ruleset_id,
            'statistics' => ['good' => 1],
            'user_id' => $user->getKey(),
        ]);
    }

    private function playlistItem()
    {
        return PlaylistItem::factory()->create([
            'room_id' => $this->room,
        ]);
    }
}
