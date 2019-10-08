<?php

use Carbon\Carbon;

$factory->define(App\Models\Multiplayer\Game::class, function (Faker\Generator $faker) {
    $beatmap = App\Models\Beatmap::inRandomOrder()->first();

    return [
        'beatmap_id' => $beatmap->beatmap_id,
        'start_time' => Carbon::now()->subSeconds($beatmap->total_length),
        'play_mode' => $beatmap->playmode,
        'scoring_type' => $faker->numberBetween(0, 3),
        'team_type' => $faker->numberBetween(0, 3),
    ];
});

$factory->state(App\Models\Multiplayer\Game::class, 'in_progress', function (Faker\Generator $faker) {
    return [
        'end_time' => null,
    ];
});

$factory->state(App\Models\Multiplayer\Game::class, 'complete', function (Faker\Generator $faker) {
    return [
        'end_time' => Carbon::now(),
    ];
});
