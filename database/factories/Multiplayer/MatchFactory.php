<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\Multiplayer\Match::class, function (Faker\Generator $faker) {
    return [
        'name' => function () use ($faker) {
            return $faker->sentence();
        },
        'start_time' => Carbon\Carbon::now(),
        'private' => 0,
    ];
});

$factory->state(App\Models\Multiplayer\Match::class, 'private', function (Faker\Generator $faker) {
    return [
        'private' => 1,
    ];
});

$factory->state(App\Models\Multiplayer\Match::class, 'tourney', function (Faker\Generator $faker) {
    return [
        'keep_forever' => 1,
    ];
});
