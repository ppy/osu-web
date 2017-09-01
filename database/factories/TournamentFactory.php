<?php

$factory->define(App\Models\Tournament::class, function (Faker\Generator $faker) {
    return  [
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
