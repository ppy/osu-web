<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\UpdateStream::class, function (Faker\Generator $faker) {
    return [
        'name' => function () use ($faker) {
            return $faker->colorName();
        },
        'pretty_name' => function () use ($faker) {
            return $faker->colorName();
        },
    ];
});
