<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

if (!function_exists('generateStats')) {
    function generateStats()
    {
        // Base template for all modes to use

        $acc = (float) (rand(850000, 1000000)) / 10000; // 85.0000 - 100.0000
        $score = (float) rand(500000, 2000000000) * 2; // 500k - 4bil
        $pp = (float) rand(1, 15000);
        $playcount = rand(1000, 250000); // 1k - 250k

        return [
            'level' => rand(1, 104),
            'count300' => rand(10000, 5000000), // 10k to 5mil
            'count100' => rand(10000, 2000000), // 10k to 2mil
            'count50' => rand(10000, 1000000), // 10k to 1mil
            'countMiss' => rand(10000, 1000000), // 10k to 1mil
            'accuracy_total' => rand(1000, 250000), // 1k to 250k. unsure what field is for
            'accuracy_count' => rand(1000, 250000), // 1k to 250k. unsure what field is for
            'accuracy' => $acc / 100,
            'accuracy_new' => $acc,
            'playcount' => $playcount,
            'fail_count' => rand($playcount * 0.1, $playcount * 0.2),
            'exit_count' => rand($playcount * 0.2, $playcount * 0.3),
            'rank' => rand(1, 500000),
            'ranked_score' => $score,
            'total_score' => $score * 1.4,
            'total_seconds_played' => rand($playcount * 120 * 0.3, $playcount * 120 * 0.7),
            'x_rank_count' => round($playcount * 0.001),
            'xh_rank_count' => round($playcount * 0.0003),
            's_rank_count' => round($playcount * 0.05),
            'sh_rank_count' => round($playcount * 0.02),
            'a_rank_count' => round($playcount * 0.2),
            'rank_score' => $pp,
            'rank_score_index' => rand(1, 500000),
            'max_combo' => rand(500, 4000),
        ];
    }
}

foreach (array_keys(App\Models\Beatmap::MODES) as $mode) {
    $factory->define(App\Models\UserStatistics\Model::getClass($mode), function (Faker\Generator $faker) {
        return generateStats();
    });

    $factory->define(App\Models\UserStatistics\Spotlight\Model::getClass($mode), function (Faker\Generator $faker) {
        $stats = generateStats();
        unset($stats['accuracy_new']);
        unset($stats['total_seconds_played']);
        unset($stats['xh_rank_count']);
        unset($stats['sh_rank_count']);
        unset($stats['rank_score']);
        unset($stats['rank_score_index']);

        return $stats;
    });
}
