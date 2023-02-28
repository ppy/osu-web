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

use App\Models\User;

$factory->define(App\Models\Changelog::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            $u = User::inRandomOrder()->first() ?? User::factory()->create();

            return $u->getKey();
        },
        'prefix' => $faker->randomElement(['*', '+', '?']),
        'category' => $faker->randomElement(['Web', 'Audio', 'Code', 'Editor', 'Gameplay', 'Graphics']),
        'message' => $faker->catchPhrase,
        'checksum' => $faker->md5,
        'date' => $faker->dateTimeBetween('-6 weeks', 'now'),
    ];
});
