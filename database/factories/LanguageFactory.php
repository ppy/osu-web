<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\Language::class, function (Faker\Generator $faker) {
    return [
        'name' => function () use ($faker) {
            // 'name' is varchar(50) and some generated strings are longer than that
            return substr($faker->country(), 0, 50);
        },
    ];
});
