<?php

$factory->define(App\Models\UserMonthlyPlaycount::class, function (Faker\Generator $faker) {
    return [
        'year_month' => sprintf('%02d%02d', $faker->numberBetween(7, Carbon\Carbon::now()->format('y')), $faker->numberBetween(1, 12)),
        'playcount' => $faker->numberBetween(500, 2000),
    ];
});
