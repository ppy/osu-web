<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\LegacyMatch\Game;
use Carbon\Carbon;

$factory->define(Game::class, function (Faker\Generator $faker) {
    $beatmap = App\Models\Beatmap::inRandomOrder()->first();

    return [
        'beatmap_id' => $beatmap->beatmap_id,
        'start_time' => Carbon::now()->subSeconds($beatmap->total_length),
        'play_mode' => $beatmap->playmode,
        'scoring_type' => $faker->numberBetween(0, 3),
        'team_type' => $faker->numberBetween(0, 3),
    ];
});

$factory->state(Game::class, 'in_progress', function (Faker\Generator $faker) {
    return [
        'end_time' => null,
    ];
});

$factory->state(Game::class, 'complete', function (Faker\Generator $faker) {
    return [
        'end_time' => Carbon::now(),
    ];
});
