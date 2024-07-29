<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Ds\Set;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyChallengeUserStats extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $attributes = [
        'daily_streak_best' => 0,
        'daily_streak_current' => 0,
        'playcount' => 0,
        'top_10p_placements' => 0,
        'top_50p_placements' => 0,
        'weekly_streak_best' => 0,
        'weekly_streak_current' => 0,
    ];

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

        $highScores = $playlist
            ->highScores()
            ->where('total_score', '>', 0)
            ->orderBy('total_score', 'DESC')
            ->get();
        $count = $highScores->count();
        // these variables are only used if there's anything in the array
        if ($count > 0) {
            $top50p = $highScores[max(0, (int) ($count * 0.5) - 1)]->total_score;
            $top10p = $highScores[max(0, (int) ($count * 0.1) - 1)]->total_score;
        }
        $highScoresByUserId = [];
        foreach ($highScores as $highScore) {
            $highScoresByUserId[$highScore->user_id] = $highScore;
        }
        $statsByUserId = static
            ::where('last_weekly_streak', '>=', $previousWeek->subDays(1))
            ->orWhereIn('user_id', array_keys($highScoresByUserId))
            ->get()
            ->keyBy('user_id');
        $userIds = new Set([...$statsByUserId->keys(), ...array_keys($highScoresByUserId)]);
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

            if ($highScore !== null && ($stats->last_percentile_calculation ?? $previousWeek) < $startTime) {
                if ($highScore->total_score >= $top10p) {
                    $stats->top_10p_placements += 1;
                }
                if ($highScore->total_score >= $top50p) {
                    $stats->top_50p_placements += 1;
                }
                $stats->last_percentile_calculation = $startTime;
            }

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

    public function updateStreak(
        bool $incrementing,
        CarbonImmutable $startTime,
        ?CarbonImmutable $currentWeek = null,
        ?CarbonImmutable $previousWeek = null
    ): void {
        $currentWeek ??= static::startOfWeek($startTime);
        $previousWeek ??= $currentWeek->subWeek(1);

        if ($incrementing) {
            if (($this->last_update ?? $previousWeek) < $startTime) {
                $this->playcount += 1;
                $this->daily_streak_current += 1;
            }

            if (($this->last_weekly_streak ?? $previousWeek) < $currentWeek) {
                $this->weekly_streak_current += 1;
            }
            $this->last_weekly_streak = $currentWeek;

            foreach (['daily', 'weekly'] as $type) {
                if ($this["{$type}_streak_best"] < $this["{$type}_streak_current"]) {
                    $this["{$type}_streak_best"] = $this["{$type}_streak_current"];
                }
            }
        } else {
            $this->daily_streak_current = 0;
            if ($this->last_weekly_streak === null || $this->last_weekly_streak < $previousWeek) {
                $this->weekly_streak_current = 0;
            }
        }

        $this->last_update = $startTime;
    }
}
