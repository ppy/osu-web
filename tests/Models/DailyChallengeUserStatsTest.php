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
    protected static function roomAddPlay(User $user, PlaylistItem $playlistItem, array $scoreParams = []): ScoreLink
    {
        $room = $playlistItem->room;
        $origEndsAt = $room->ends_at;
        $room->update(['ends_at' => CarbonImmutable::now()->addDays(1)]);
        try {
            return parent::roomAddPlay($user, $playlistItem, ['passed' => true, ...$scoreParams]);
        } finally {
            $room->update(['ends_at' => $origEndsAt]);
        }
    }

    private static function preparePlaylistItem(CarbonImmutable $playTime): PlaylistItem
    {
        return PlaylistItem::factory()->create([
            'room_id' => Room::factory()->create([
                'category' => 'daily_challenge',
                'starts_at' => $playTime->startOfDay(),
                'ends_at' => $playTime->endOfDay(),
            ]),
        ]);
    }

    private static function startOfWeek(): CarbonImmutable
    {
        return DailyChallengeUserStats::startOfWeek(CarbonImmutable::now()->subWeeks(1));
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
        $this->assertSame(1, $stats->top_50p_placements);
        $this->assertTrue($playTime->equalTo($stats->last_weekly_streak));
        $this->assertTrue($playTime->equalTo($stats->last_update));
    }

    public function testCalculateNoPlaysBreaksDailyStreak(): void
    {
        $playTime = static::startOfWeek();
        static::preparePlaylistItem($playTime);

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
        $playlistItem = static::preparePlaylistItem($playTime);

        $user = User::factory()->create();

        $lastWeeklyStreak = $playTime->subWeeks(2);
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

    public function testCalculateNoPlaysOverAWeekBreaksWeeklyStreakLastStreakOnStartOfWeek(): void
    {
        $user = User::factory()->create();
        $lastWeeklyStreak = static::startOfWeek();
        DailyChallengeUserStats::create([
            'user_id' => $user->getKey(),
            'weekly_streak_current' => 3,
            'weekly_streak_best' => 3,
            'last_update' => $lastWeeklyStreak->addDays(1),
            'last_weekly_streak' => $lastWeeklyStreak,
        ]);

        // no break until the exact 14th day after last weekly streak
        for ($i = 7; $i <= 14; $i++) {
            $playTime = $lastWeeklyStreak->addDays($i);
            $playlistItem = static::preparePlaylistItem($playTime);
            DailyChallengeUserStats::calculate($playTime);

            $stats = DailyChallengeUserStats::find($user->getKey());
            $testHint = "After {$i} days";
            $this->assertSame($i === 14 ? 0 : 3, $stats->weekly_streak_current, $testHint);
            $this->assertSame(3, $stats->weekly_streak_best, $testHint);
            $this->assertTrue($lastWeeklyStreak->equalTo($stats->last_weekly_streak), $testHint);
        }
    }

    public function testCalculatePercentile(): void
    {
        $playTime = static::startOfWeek();
        $playlistItem = static::preparePlaylistItem($playTime);

        $totalScores = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
        $scoreLinks = [];
        foreach ($totalScores as $totalScore) {
            $scoreLink = $scoreLinks[] = ScoreLink::factory()->completed([
                'passed' => true,
                'total_score' => $totalScore,
            ])->create([
                'playlist_item_id' => $playlistItem,
            ]);
            UserScoreAggregate::new($scoreLink->user, $playlistItem->room)->save();
        }

        $this->expectCountChange(fn () => DailyChallengeUserStats::count(), 10);

        DailyChallengeUserStats::calculate($playTime);

        foreach ($scoreLinks as $i => $scoreLink) {
            [$count10p, $count50p] = match (true) {
                // 100
                $i === 9 => [1, 1],
                // 60 - 90
                $i >= 5 => [0, 1],
                default => [0, 0],
            };
            $stats = DailyChallengeUserStats::find($scoreLink->user_id);
            $this->assertSame($count10p, $stats->top_10p_placements, "i: {$i}");
            $this->assertSame($count50p, $stats->top_50p_placements, "i: {$i}");
        }
    }

    public function testFix(): void
    {
        $user = User::factory()->create();

        foreach ([14, 13, 12, 11, 10, 9, 7, 6, 5] as $subDay) {
            $playTime = static::startOfWeek()->subDays($subDay);
            $playlistItem = static::preparePlaylistItem($playTime);
            $this->roomAddPlay($user, $playlistItem);
            DailyChallengeUserStats::calculate($playTime);
        }
        $this->travelTo($playTime->addDays(1));

        $stats = DailyChallengeUserStats::find($user->getKey());
        $expectedAttributes = $stats->getAttributes();
        $stats->fill([...DailyChallengeUserStats::INITIAL_VALUES])->saveOrExplode();
        $stats->fresh()->fix();

        $stats->refresh();
        $this->assertSame(9, $stats->playcount);
        $this->assertSame(3, $stats->daily_streak_current);
        $this->assertSame(6, $stats->daily_streak_best);
        $this->assertSame(2, $stats->weekly_streak_current);
        $this->assertSame(2, $stats->weekly_streak_best);
        $this->assertSame(9, $stats->top_10p_placements);
        $this->assertSame(9, $stats->top_50p_placements);

        $this->travelBack();

        $stats->fresh()->fix();

        $stats->refresh();
        $this->assertSame(9, $stats->playcount);
        $this->assertSame(0, $stats->daily_streak_current);
        $this->assertSame(6, $stats->daily_streak_best);
    }

    // Score 0 can't be submitted anymore. This is for existing scores in database.
    public function testFixZeroTotalScore(): void
    {
        $user = User::factory()->create();

        $scores = [];
        foreach ([3 => 100, 2 => 1, 1 => 100] as $subDay => $score) {
            $playTime = static::startOfWeek()->subDays($subDay);
            $playlistItem = static::preparePlaylistItem($playTime);
            $scores[] = $this->roomAddPlay($user, $playlistItem, ['total_score' => $score]);
        }
        $scores[1]->score->update(['total_score' => 0]);
        $scores[1]->playlistItem->room->userHighScores->each->recalculate();
        $this->travelTo($playTime->addDays(1));

        $stats = DailyChallengeUserStats::find($user->getKey());
        $stats->fill([...DailyChallengeUserStats::INITIAL_VALUES])->saveOrExplode();
        $stats->fix();

        $stats->refresh();
        $this->assertSame(2, $stats->playcount);
        $this->assertSame(1, $stats->daily_streak_current);
        $this->assertSame(1, $stats->daily_streak_best);
        $this->assertSame(1, $stats->weekly_streak_current);
        $this->assertSame(1, $stats->weekly_streak_best);
    }

    public function testFlowFromStart(): void
    {
        $playTime = static::startOfWeek();
        $playlistItem = static::preparePlaylistItem($playTime);
        $user = User::factory()->create();

        $this->expectCountChange(fn () => DailyChallengeUserStats::count(), 1);

        $this->roomAddPlay($user, $playlistItem);

        $stats = DailyChallengeUserStats::find($user->getKey());
        $this->assertSame(1, $stats->playcount);
        $this->assertSame(1, $stats->daily_streak_current);
        $this->assertSame(1, $stats->daily_streak_best);
        $this->assertSame(1, $stats->weekly_streak_current);
        $this->assertSame(1, $stats->weekly_streak_best);
        $this->assertSame(0, $stats->top_10p_placements);
        $this->assertSame(0, $stats->top_50p_placements);
        $this->assertTrue($playTime->equalTo($stats->last_weekly_streak));
        $this->assertTrue($playTime->equalTo($stats->last_update));

        // increments percentile and nothing else
        DailyChallengeUserStats::calculate($playTime);

        $stats->refresh();
        $this->assertSame(1, $stats->playcount);
        $this->assertSame(1, $stats->daily_streak_current);
        $this->assertSame(1, $stats->daily_streak_best);
        $this->assertSame(1, $stats->weekly_streak_current);
        $this->assertSame(1, $stats->weekly_streak_best);
        $this->assertSame(1, $stats->top_10p_placements);
        $this->assertSame(1, $stats->top_50p_placements);
        $this->assertTrue($playTime->equalTo($stats->last_weekly_streak));
        $this->assertTrue($playTime->equalTo($stats->last_update));
    }

    public function testFlowMultipleTimes(): void
    {
        $playTime = static::startOfWeek();
        $playlistItem = static::preparePlaylistItem($playTime);
        $user = User::factory()->create();

        $this->roomAddPlay($user, $playlistItem);
        $this->roomAddPlay($user, $playlistItem);

        DailyChallengeUserStats::calculate($playTime);
        DailyChallengeUserStats::calculate($playTime);

        $stats = DailyChallengeUserStats::find($user->getKey());
        $this->assertSame(1, $stats->playcount);
    }

    public function testFlowIncrementAll(): void
    {
        $playTime = static::startOfWeek();
        $playlistItem = static::preparePlaylistItem($playTime);
        $user = User::factory()->create();

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

        $this->roomAddPlay($user, $playlistItem);
        $stats = DailyChallengeUserStats::find($user->getKey());
        $this->assertSame(2, $stats->daily_streak_current);
        $this->assertSame(2, $stats->daily_streak_best);
        $this->assertSame(2, $stats->weekly_streak_current);
        $this->assertSame(2, $stats->weekly_streak_best);
        $this->assertSame(1, $stats->top_10p_placements);
        $this->assertSame(1, $stats->top_50p_placements);
        $this->assertTrue($playTime->equalTo($stats->last_weekly_streak));
        $this->assertTrue($playTime->equalTo($stats->last_update));

        DailyChallengeUserStats::calculate($playTime);

        $stats->refresh();
        $this->assertSame(2, $stats->daily_streak_current);
        $this->assertSame(2, $stats->daily_streak_best);
        $this->assertSame(2, $stats->weekly_streak_current);
        $this->assertSame(2, $stats->weekly_streak_best);
        $this->assertSame(2, $stats->top_10p_placements);
        $this->assertSame(2, $stats->top_50p_placements);
        $this->assertTrue($playTime->equalTo($stats->last_weekly_streak));
        $this->assertTrue($playTime->equalTo($stats->last_update));
    }

    public function testFlowIncrementWeeklyStreak(): void
    {
        $playTime = static::startOfWeek();
        $playlistItem = static::preparePlaylistItem($playTime);
        $user = User::factory()->create();

        DailyChallengeUserStats::create([
            'user_id' => $user->getKey(),
            'weekly_streak_current' => 1,
            'weekly_streak_best' => 1,
            'last_weekly_streak' => $playTime->subWeeks(1),
            'last_update' => $playTime->subDays(1),
        ]);

        $this->roomAddPlay($user, $playlistItem);

        $stats = DailyChallengeUserStats::find($user->getKey());
        $this->assertSame(2, $stats->weekly_streak_current);
        $this->assertSame(2, $stats->weekly_streak_best);
        $this->assertTrue($playTime->equalTo($stats->last_weekly_streak));

        DailyChallengeUserStats::calculate($playTime);

        $stats->refresh();
        $this->assertSame(2, $stats->weekly_streak_current);
        $this->assertSame(2, $stats->weekly_streak_best);
        $this->assertTrue($playTime->equalTo($stats->last_weekly_streak));
    }

    /**
     * 1. normal play and calculation (day 1)
     * 2. no play (day 2)
     * 3. play (day 3)
     * 4. calculation (day 2)
     * 5. play (day 3)
     * 6. calculation (day 3)
     * Streak should be broken on #3 and restarted streak should stay the same on #4, #5, and #6.
     */
    public function testFlowOneSkippedDayAndOnePlayBeforeLastCalculation(): void
    {
        $playTime = static::startOfWeek();
        $playlistItem = static::preparePlaylistItem($playTime);

        $user = User::factory()->create();
        $this->roomAddPlay($user, $playlistItem, ['passed' => true]);
        DailyChallengeUserStats::calculate($playTime);

        $playTime = $playTime->addDays(1);
        $playlistItem = static::preparePlaylistItem($playTime);

        $playTime = $playTime->addDays(1);
        $playlistItem = static::preparePlaylistItem($playTime);
        $this->roomAddPlay($user, $playlistItem, ['passed' => true]);

        // no changes expected
        $assertValues = function () use ($user): void {
            $stats = DailyChallengeUserStats::find($user->getKey());
            $this->assertSame(1, $stats->daily_streak_current);
            $this->assertSame(1, $stats->daily_streak_best);
            $this->assertSame(1, $stats->weekly_streak_current);
            $this->assertSame(1, $stats->weekly_streak_best);
        };
        $assertValues();

        DailyChallengeUserStats::calculate($playTime->subDays(1));
        $assertValues();

        $this->roomAddPlay($user, $playlistItem, ['passed' => true]);
        $assertValues();

        DailyChallengeUserStats::calculate($playTime);
        $assertValues();
    }

    protected function setUp(): void
    {
        parent::setUp();
        // prevent storing percentile cache
        config_set('cache.default', 'array');
    }
}
