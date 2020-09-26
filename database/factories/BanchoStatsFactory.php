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

use Carbon\Carbon;

$factory->define(App\Models\BanchoStats::class, function (Faker\Generator $faker) {
    return [
        'users_irc' => 100 + $faker->randomNumber(2),
        'users_osu' => 10000 + $faker->randomNumber(4),
        'multiplayer_games' => 200 + $faker->randomNumber(3),
        'date' => new Carbon(),
    ];
});
