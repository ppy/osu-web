<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\ContestEntry::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return App\Models\User::factory()->create()->user_id;
        },
        'entry_url' => '/images/headers/generic.jpg',
        'name' => $faker->words(3, true),
        'masked_name' => $faker->words(3, true),
    ];
});
