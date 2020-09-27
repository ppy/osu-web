<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

$factory->define(App\Models\Country::class, function (Faker\Generator $faker) {
    return [
        'acronym' => $faker->unique()->countryCode,
        'name' => $faker->unique()->country,
        'rankedscore' => rand(5000000, 500000000) * 10000,
        'playcount' => rand(10000000, 200000000),
        'usercount' => rand(10000, 600000),
        'pp' => rand(1000000, 45000000),
    ];
});
