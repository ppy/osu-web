<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Multiplayer;

use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\Score;
use App\Models\Multiplayer\UserScoreAggregate;
use App\Models\User;
use Tests\TestCase;

class UserScoreAggregateTest extends TestCase
{
    private $room;

    public function testStartingPlayIncreasesAttempts()
    {
        $user = factory(User::class)->create();
        $playlistItem = $this->playlistItem();

        $this->room->startPlay($user, $playlistItem);
        $agg = UserScoreAggregate::new($user, $this->room);

        $this->assertSame(1, $agg->attempts);
        $this->assertSame(0, $agg->completed);
    }

    public function testInCompleteScoresAreNotCounted()
    {
        $user = factory(User::class)->create();
        $playlistItem = $this->playlistItem();
        $agg = UserScoreAggregate::new($user, $this->room);

        $score = factory(Score::class)
            ->create([
                'room_id' => $this->room->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'user_id' => $user->getKey(),
            ]);

        $agg->addScore($score);
        $result = json_item($agg, 'Multiplayer\UserScoreAggregate');

        $this->assertSame(0, $result['completed']);
        $this->assertSame(0, $result['total_score']);
    }

    public function testFailedScoresAreAttemptsOnly()
    {
        $user = factory(User::class)->create();
        $playlistItem = $this->playlistItem();
        $agg = UserScoreAggregate::new($user, $this->room);

        $agg->addScore(
            factory(Score::class)
                ->states('completed', 'failed')
                ->create([
                    'room_id' => $this->room->getKey(),
                    'playlist_item_id' => $playlistItem->getKey(),
                    'user_id' => $user->getKey(),
                ])
        );

        $agg->addScore(
            factory(Score::class)
                ->states('completed', 'passed')
                ->create([
                    'room_id' => $this->room->getKey(),
                    'playlist_item_id' => $playlistItem->getKey(),
                    'user_id' => $user->getKey(),
                ])
        );

        $result = json_item($agg, 'Multiplayer\UserScoreAggregate');

        $this->assertSame(1, $result['completed']);
        $this->assertSame(1, $result['total_score']);
    }

    public function testPassedScoresIncrementsCompletedCount()
    {
        $user = factory(User::class)->create();
        $playlistItem = $this->playlistItem();
        $agg = UserScoreAggregate::new($user, $this->room);

        $agg->addScore(
            factory(Score::class)
            ->states('completed', 'passed')
            ->create([
                'room_id' => $this->room->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'user_id' => $user->getKey(),
            ])
        );

        $result = json_item($agg, 'Multiplayer\UserScoreAggregate');

        $this->assertSame(1, $result['completed']);
        $this->assertSame(1, $result['total_score']);
    }

    public function testPassedScoresAreAveraged()
    {
        $user = factory(User::class)->create();
        $playlistItem = $this->playlistItem();
        $playlistItem2 = $this->playlistItem();

        $agg = UserScoreAggregate::new($user, $this->room);
        $agg->addScore(
            factory(Score::class)
            ->create([
                'room_id' => $this->room->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'user_id' => $user->getKey(),
                'total_score' => 1,
                'pp' => 0.2,
                'pp' => 0.2,
            ])
        );

        $agg->addScore(
            factory(Score::class)
            ->states('completed', 'failed')
            ->create([
                'room_id' => $this->room->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'user_id' => $user->getKey(),
                'total_score' => 1,
                'accuracy' => 0.3,
                'pp' => 0.3,
            ])
        );

        $agg->addScore(
            factory(Score::class)
            ->states('completed', 'passed')
            ->create([
                'room_id' => $this->room->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'user_id' => $user->getKey(),
                'total_score' => 1,
                'accuracy' => 0.5,
                'pp' => 0.5,
            ])
        );

        $agg->addScore(
            factory(Score::class)
            ->states('completed', 'passed')
            ->create([
                'room_id' => $this->room->getKey(),
                'playlist_item_id' => $playlistItem2->getKey(),
                'user_id' => $user->getKey(),
                'total_score' => 1,
                'accuracy' => 0.8,
                'pp' => 0.8,
            ])
        );

        $result = json_item($agg, 'Multiplayer\UserScoreAggregate');

        $this->assertSame(0.65, $result['pp']);
        $this->assertSame(0.65, $result['accuracy']);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->room = factory(Room::class)->create();
    }

    private function playlistItem()
    {
        return factory(PlaylistItem::class)->create([
            'room_id' => $this->room->getKey(),
        ]);
    }
}
