<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\UserStatistics;

use App\Models\User;
use Database\Factories\Factory;

abstract class ModelFactory extends Factory
{
    private static function randPlaycount(array $attr, float $min, float $max): int
    {
        return rand((int) ($attr['playcount'] * $min), (int) ($attr['playcount'] * $max));
    }

    private static function getUser(array $attr): ?User
    {
        return isset($attr['user_id'])
            ? ($attr['user_id'] instanceof User
                ? $attr['user_id']
                : User::find($attr['user_id'])
            ) : null;
    }

    public function definition(): array
    {
        return $this->generateStats();
    }

    private function generateStats(): array
    {
        return [
            'accuracy_count' => rand(1000, 250000), // 1k to 250k. unsure what field is for
            'accuracy_new' => (float) (rand(850000, 1000000)) / 10000, // 85.0000 - 100.0000
            'accuracy_total' => rand(1000, 250000), // 1k to 250k. unsure what field is for
            'count100' => rand(10000, 2000000), // 10k to 2mil
            'count300' => rand(10000, 5000000), // 10k to 5mil
            'count50' => rand(10000, 1000000), // 10k to 1mil
            'countMiss' => rand(10000, 1000000), // 10k to 1mil
            'level' => rand(1, 104),
            'max_combo' => rand(500, 4000),
            'playcount' => rand(1000, 250000), // 1k - 250k
            'rank' => rand(1, 500000),
            'rank_score' => (float) rand(1, 15000),
            'rank_score_index' => rand(1, 500000),
            'ranked_score' => (float) rand(500000, 2000000000) * 2, // 500k - 4bil

            'accuracy' => fn (array $attr) => $attr['accuracy_new'] / 100,
            'country_acronym' => fn (array $attr) => static::getUser($attr)?->country_acronym ?? '',
            'exit_count' => fn (array $attr) => static::randPlaycount($attr, 0.2, 0.3),
            'fail_count' => fn (array $attr) => static::randPlaycount($attr, 0.1, 0.2),
            'total_score' => fn (array $attr) => $attr['ranked_score'] * 1.4,
            'total_seconds_played' => fn (array $attr) => static::randPlaycount($attr, 120 * 0.3, 120 * 0.7),

            // The multipliers should sum up to less than 1
            'xh_rank_count' => fn (array $attr) => round($attr['playcount'] * 0.0003),
            'x_rank_count' => fn (array $attr) => round($attr['playcount'] * 0.001),
            'sh_rank_count' => fn (array $attr) => round($attr['playcount'] * 0.02),
            's_rank_count' => fn (array $attr) => round($attr['playcount'] * 0.05),
            'a_rank_count' => fn (array $attr) => round($attr['playcount'] * 0.2),
        ];
    }
}
