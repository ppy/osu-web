<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\Tournament::class, function (Faker\Generator $faker) {
    return [
        'name' => "Such {$faker->word}",
        'description' => $faker->sentence,
        'play_mode' => 0,
        'rank_min' => 1,
        'rank_max' => 5000,
        'signup_open' => function () {
            return Carbon\Carbon::now();
        },
        'signup_close' => function () {
            return Carbon\Carbon::now()->addMonths(1);
        },
        'start_date' => function () {
            return Carbon\Carbon::now()->addMonths(2);
        },
        'end_date' => function () {
            return Carbon\Carbon::now()->addMonths(3);
        },
    ];
});
