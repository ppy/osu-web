<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\ChatFilter::class, function (Faker\Generator $faker) {
    return [
        'match' => $faker->unique()->word,
        'replacement' => $faker->word,
    ];
});
