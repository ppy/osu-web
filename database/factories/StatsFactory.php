<?php

if (!function_exists('generateStats')) {
    function generateStats()
    {
        // Base template for all modes to use

        $acc = (float) (rand(850000, 1000000)) / 10000; // 85.0000 - 100.0000
        $score = (float) rand(500000, 2000000000) * 2; // 500k - 4bil
        $playcount = rand(1000, 250000); // 1k - 250k

        return [
          'level' => rand(1, 104),
          'count300' => rand(10000, 5000000), // 10k to 5mil
          'count100' => rand(10000, 2000000), // 10k to 2mil
          'count50' => rand(10000, 1000000), // 10k to 1mil
          'countMiss' => rand(10000, 1000000), // 10k to 1mil
          'accuracy_total' => rand(1000, 250000), // 1k to 250k. unsure what field is for
          'accuracy_count' => rand(1000, 250000), // 1k to 250k. unsure what field is for
          'accuracy' => $acc,
          'accuracy_new' => $acc,
          'playcount' => $playcount,
          'fail_count' => rand($playcount * 0.1, $playcount * 0.2),
          'exit_count' => rand($playcount * 0.2, $playcount * 0.3),
          'ranked_score' => $score,
          'total_score' => $score * 1.4,
          'x_rank_count' => round($playcount * 0.001),
          's_rank_count' => round($playcount * 0.05),
          'a_rank_count' => round($playcount * 0.2),
          'rank_score' => $score,
          'rank_score_index' => rand(1, 500000),
          'max_combo' => rand(500, 4000),
        ];
    }
}

$factory->define(App\Models\UserStatistics\Osu::class, function (Faker\Generator $faker) {
    return generateStats();
});

$factory->define(App\Models\UserStatistics\Fruits::class, function (Faker\Generator $faker) {
    return generateStats();
});

$factory->define(App\Models\UserStatistics\Mania::class, function (Faker\Generator $faker) {
    return generateStats();
});

$factory->define(App\Models\UserStatistics\Taiko::class, function (Faker\Generator $faker) {
    return generateStats();
});
