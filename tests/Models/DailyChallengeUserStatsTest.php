<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\DailyChallengeUserStats;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\ScoreLink;
use App\Models\Multiplayer\UserScoreAggregate;
use App\Models\User;
use Carbon\CarbonImmutable;
use Tests\TestCase;

class DailyChallengeUserStatsTest extends TestCase
{
    private static function startOfWeek(): CarbonImmutable
    {
        return CarbonImmutable::now()->startOfWeek(CarbonImmutable::THURSDAY);
    }

    private static function preparePlaylistItem(CarbonImmutable $playTime): PlaylistItem
    {
        return PlaylistItem::factory()->create([
            'room_id' => Room::factory()->create([
                'category' => 'daily_challenge',
                'starts_at' => $playTime,
            ]),
        ]);
    }

    public function testCalculateFromStart(): void
    {
        $playTime = static::startOfWeek();
        $playlistItem = static::preparePlaylistItem($playTime);

        $user = User::factory()->create();
        ScoreLink::factory()->passed()->create([
            'playlist_item_id' => $playlistItem,
            'user_id' => $user,
        ]);
        UserScoreAggregate::new($user, $playlistItem->room)->save();

        $this->expectCountChange(fn () => DailyChallengeUserStats::count(), 1);

        DailyChallengeUserStats::calculate($playTime);

        $stats = DailyChallengeUserStats::find($user->getKey());
        $this->assertSame(1, $stats->playcount);
        $this->assertSame(1, $stats->daily_streak_current);
        $this->assertSame(1, $stats->daily_streak_best);
        $this->assertSame(1, $stats->weekly_streak_current);
        $this->assertSame(1, $stats->weekly_streak_best);
        $this->assertSame(1, $stats->top_10p_placements);
        $this->assertSame(0, $stats->top_50p_placements);
        $this->assertTrue($playTime->equalTo($stats->last_weekly_streak));
        $this->assertTrue($playTime->equalTo($stats->last_update));
    }

    public function testCalculateTwiceADay(): void
    {
        $playTime = static::startOfWeek();
        $playlistItem = static::preparePlaylistItem($playTime);

        $user = User::factory()->create();
        ScoreLink::factory()->passed()->create([
            'playlist_item_id' => $playlistItem,
            'user_id' => $user,
        ]);
        UserScoreAggregate::new($user, $playlistItem->room)->save();

        DailyChallengeUserStats::calculate($playTime);
        DailyChallengeUserStats::calculate($playTime);

        $stats = DailyChallengeUserStats::find($user->getKey());
        $this->assertSame(1, $stats->playcount);
    }

    public function testCalculateIncrementAll(): void
    {
        $playTime = static::startOfWeek();
        $playlistItem = static::preparePlaylistItem($playTime);

        $user = User::factory()->create();
        ScoreLink::factory()->passed()->create([
            'playlist_item_id' => $playlistItem,
            'user_id' => $user,
        ]);
        UserScoreAggregate::new($user, $playlistItem->room)->save();

        DailyChallengeUserStats::create([
            'user_id' => $user->getKey(),
            'playcount' => 1,
            'daily_streak_current' => 1,
            'daily_streak_best' => 1,
            'weekly_streak_current' => 1,
            'weekly_streak_best' => 1,
            'top_10p_placements' => 1,
            'top_50p_placements' => 1,
            'last_weekly_streak' => $playTime->subWeeks(1),
            'last_update' => $playTime->subDays(1),
        ]);

        $this->expectCountChange(fn () => DailyChallengeUserStats::count(), 0);

        DailyChallengeUserStats::calculate($playTime);

        $stats = DailyChallengeUserStats::find($user->getKey());
        $this->assertSame(2, $stats->daily_streak_current);
        $this->assertSame(2, $stats->daily_streak_best);
        $this->assertSame(2, $stats->weekly_streak_current);
        $this->assertSame(2, $stats->weekly_streak_best);
        $this->assertSame(2, $stats->top_10p_placements);
        $this->assertSame(1, $stats->top_50p_placements);
        $this->assertTrue($playTime->equalTo($stats->last_weekly_streak));
        $this->assertTrue($playTime->equalTo($stats->last_update));
    }

    public function testCalculateIncrementWeeklyStreak(): void
    {
        $playTime = static::startOfWeek();
        $playlistItem = static::preparePlaylistItem($playTime);

        $user = User::factory()->create();
        ScoreLink::factory()->passed()->create([
            'playlist_item_id' => $playlistItem,
            'user_id' => $user,
        ]);
        UserScoreAggregate::new($user, $playlistItem->room)->save();

        DailyChallengeUserStats::create([
            'user_id' => $user->getKey(),
            'weekly_streak_current' => 1,
            'weekly_streak_best' => 1,
            'last_weekly_streak' => $playTime->subWeeks(1),
            'last_update' => $playTime->subDays(1),
        ]);
        DailyChallengeUserStats::calculate($playTime);

        $stats = DailyChallengeUserStats::find($user->getKey());
        $this->assertSame(2, $stats->weekly_streak_current);
        $this->assertSame(2, $stats->weekly_streak_best);
        $this->assertTrue($playTime->equalTo($stats->last_weekly_streak));
    }

    public function testCalculateNoPlaysBreaksDailyStreak(): void
    {
        $playTime = static::startOfWeek();
        $playlistItem = static::preparePlaylistItem($playTime);

        $user = User::factory()->create();

        $lastWeeklyStreak = $playTime->subWeeks(1);
        DailyChallengeUserStats::create([
            'daily_streak_best' => 3,
            'daily_streak_current' => 3,
            'last_update' => $playTime->subDays(1),
            'last_weekly_streak' => $lastWeeklyStreak,
            'user_id' => $user->getKey(),
            'weekly_streak_best' => 3,
            'weekly_streak_current' => 3,
        ]);
        DailyChallengeUserStats::calculate($playTime);

        $stats = DailyChallengeUserStats::find($user->getKey());
        $this->assertSame(0, $stats->daily_streak_current);
        $this->assertSame(3, $stats->daily_streak_best);
        $this->assertSame(3, $stats->weekly_streak_current);
        $this->assertSame(3, $stats->weekly_streak_best);
        $this->assertTrue($lastWeeklyStreak->equalTo($stats->last_weekly_streak));
    }

    public function testCalculateNoPlaysOverAWeekBreaksWeeklyStreak(): void
    {
        $playTime = static::startOfWeek();
        static::preparePlaylistItem($playTime);

        $user = User::factory()->create();

        $lastWeeklyStreak = $playTime->subWeeks(1)->subDays(1);
        DailyChallengeUserStats::create([
            'user_id' => $user->getKey(),
            'weekly_streak_current' => 3,
            'weekly_streak_best' => 3,
            'last_update' => $playTime->subDays(1),
            'last_weekly_streak' => $lastWeeklyStreak,
        ]);
        DailyChallengeUserStats::calculate($playTime);

        $stats = DailyChallengeUserStats::find($user->getKey());
        $this->assertSame(0, $stats->weekly_streak_current);
        $this->assertSame(3, $stats->weekly_streak_best);
        $this->assertTrue($lastWeeklyStreak->equalTo($stats->last_weekly_streak));
    }
}
