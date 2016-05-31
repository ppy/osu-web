<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Beatmap::class, function (Faker\Generator $faker) {
    $name = $faker->sentence(3);
    $length = rand(30, 200);
    $hits = rand(100, 2000);
    $hitsSpinner = rand(0, 5);
    $hitsNormal = round(($hits - $hitsSpinner) * 0.9);
    $hitsSlider = $hits - $hitsSpinner - $hitsNormal;
    $playCount = rand(0, 50000);

    return  [
        'filename' => $name,
        'checksum' => str_repeat('0', 32),
        'version' => $faker->domainWord,
        'total_length' => $length,
        'hit_length' => ($length - rand(0, 20)),
        'countTotal' => $hits,
        'countNormal' => $hitsNormal,
        'countSlider' => $hitsSlider,
        'countSpinner' => $hitsSpinner,
        'diff_drain' => rand(0, 10),
        'diff_size' => rand(0, 10),
        'diff_overall' => rand(0, 10),
        'diff_approach' => rand(0, 10),
        'playmode' => array_rand_val(App\Models\Beatmap::MODES),
        'approved' => (rand(0, 2) > 0),
        'difficultyrating' => (rand(0, 5000) / 1000),
        'playcount' => $playCount,
        'passcount' => round($playCount * 0.7),
    ];
});
