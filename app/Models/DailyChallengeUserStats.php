<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use App\Models\Multiplayer\PlaylistItemUserHighScore;
use Carbon\CarbonImmutable;
use Ds\Set;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyChallengeUserStats extends Model
{
    const array INITIAL_VALUES = [
        'daily_streak_best' => 0,
        'daily_streak_current' => 0,
        'last_percentile_calculation' => '2000-01-01 00:00:00',
        'last_update' => '2000-01-01 00:00:00',
        'last_weekly_streak' => '2000-01-01 00:00:00',
        'playcount' => 0,
        'top_10p_placements' => 0,
        'top_50p_placements' => 0,
        'weekly_streak_best' => 0,
        'weekly_streak_current' => 0,
    ];

    public $incrementing = false;
    public $timestamps = false;

    protected $attributes = self::INITIAL_VALUES;

    protected $casts = [
        'last_percentile_calculation' => 'datetime',
        'last_update' => 'datetime',
        'last_weekly_streak' => 'datetime',
    ];
    protected $primaryKey = 'user_id';
    protected $table = 'daily_challenge_user_stats';

    public static function calculate(CarbonImmutable $date): void
    {
        $startTime = $date->startOfDay();
        $currentWeek = static::startOfWeek($startTime);
        $previousWeek = $currentWeek->subWeeks(1);
        // this function assumes one daily challenge per day and one playlist item per daily challenge
        $playlist = Multiplayer\Room::dailyChallengeFor($startTime)?->playlist[0] ?? null;

        if ($playlist === null) {
            // or maybe do something with existing streaks
            return;
        }

        $highScoresByUserId = $playlist
            ->highScores()
            ->passing()
            ->get()
            ->keyBy('user_id');
        $statsByUserId = static
            ::where('last_weekly_streak', '>=', $previousWeek->subDays(1))
            ->orWhereIn('user_id', $highScoresByUserId->keys())
            ->get()
            ->keyBy('user_id');
        $percentile = $playlist->scorePercentile();

        $userIds = new Set([...$statsByUserId->keys(), ...$highScoresByUserId->keys()]);
        foreach ($userIds as $userId) {
            $stats = $statsByUserId[$userId] ?? new static([
                'user_id' => $userId,
            ]);
            $highScore = $highScoresByUserId[$userId] ?? null;

            $stats->updateStreak(
                $highScore !== null,
                $startTime,
                currentWeek: $currentWeek,
                previousWeek: $previousWeek,
            );

            $stats->updatePercentile($percentile, $highScore, $startTime);

            $stats->save();
        }
    }

    public static function startOfWeek(CarbonImmutable $date): CarbonImmutable
    {
        return $date->startOfWeek(CarbonImmutable::THURSDAY);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fix(): void
    {
        $highScores = PlaylistItemUserHighScore
            ::where('user_id', $this->user_id)
            ->whereRelation('playlistItem.room', 'category', 'daily_challenge')
            ->passing()
            ->with('playlistItem.room')
            ->orderBy('created_at')
            ->get();

        $this->fill(static::INITIAL_VALUES);

        foreach ($highScores as $highScore) {
            $playlistItem = $highScore->playlistItem;
            $room = $playlistItem->room;
            $startTime = $room->starts_at->toImmutable()->startOfDay();
            $this->updateStreak(true, $startTime);
            if ($room->hasEnded()) {
                $this->updatePercentile($playlistItem->scorePercentile(), $highScore, $startTime);
            }
        }
        $streakBreakDay = CarbonImmutable::yesterday();
        if ($this->last_update < $streakBreakDay) {
            $this->updateStreak(false, $streakBreakDay);
        }

        $this->saveOrExplode();
    }

    public function updateStreak(
        bool $incrementing,
        CarbonImmutable $startTime,
        ?CarbonImmutable $currentWeek = null,
        ?CarbonImmutable $previousWeek = null
    ): void {
        $currentWeek ??= static::startOfWeek($startTime);
        $previousWeek ??= $currentWeek->subWeek(1);

        $lastUpdate = $this->last_update;
        if ($lastUpdate >= $startTime) {
            return;
        }

        if ($incrementing) {
            $previousDay = $startTime->subDays(1);

            if ($lastUpdate < $previousDay) {
                $this->updateStreak(false, $previousDay);
            }

            $this->playcount += 1;
            $this->daily_streak_current += 1;
            $this->last_update = $startTime;

            if ($this->last_weekly_streak < $currentWeek) {
                $this->weekly_streak_current += 1;
                $this->last_weekly_streak = $currentWeek;
            }

            foreach (['daily', 'weekly'] as $type) {
                if ($this["{$type}_streak_best"] < $this["{$type}_streak_current"]) {
                    $this["{$type}_streak_best"] = $this["{$type}_streak_current"];
                }
            }
        } else {
            $this->daily_streak_current = 0;
            if ($this->last_weekly_streak < $previousWeek) {
                $this->weekly_streak_current = 0;
            }
        }
    }

    private function updatePercentile(
        array $playlistPercentile,
        ?PlaylistItemUserHighScore $highScore,
        CarbonImmutable $startTime
    ): void {
        if ($highScore === null || $this->last_percentile_calculation >= $startTime) {
            return;
        }

        foreach ($playlistPercentile as $p => $totalScore) {
            if ($highScore->total_score >= $totalScore) {
                $this->{"{$p}_placements"}++;
            }
        }
        $this->last_percentile_calculation = $startTime;
    }
}
