<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\UserMonthlyPlaycount::class, function (Faker\Generator $faker) {
    return [
        'year_month' => function () use ($faker) {
            return sprintf('%02d%02d', $faker->numberBetween(7, Carbon\Carbon::now()->format('y')), $faker->numberBetween(1, 12));
        },
        'playcount' => $faker->numberBetween(500, 2000),
    ];
});
