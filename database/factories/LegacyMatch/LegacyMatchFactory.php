<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\LegacyMatch\LegacyMatch;

$factory->define(LegacyMatch::class, function (Faker\Generator $faker) {
    return [
        'name' => function () use ($faker) {
            return $faker->sentence();
        },
        'start_time' => Carbon\Carbon::now(),
        'private' => 0,
    ];
});

$factory->state(LegacyMatch::class, 'private', function (Faker\Generator $faker) {
    return [
        'private' => 1,
    ];
});

$factory->state(LegacyMatch::class, 'tourney', function (Faker\Generator $faker) {
    return [
        'keep_forever' => 1,
    ];
});
