<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\Contest::class, function (Faker\Generator $faker) {
    return [
        'name' => function () use ($faker) {
            return $faker->sentence();
        },
        'description_enter' => function () use ($faker) {
            return $faker->paragraph();
        },
        'description_voting' => function () use ($faker) {
            return $faker->paragraph();
        },
        'type' => 'art',
        'header_url' => '/images/headers/generic.jpg',
        'visible' => 1,
    ];
});

$factory->state(App\Models\Contest::class, 'pending', function (Faker\Generator $faker) {
    return [
        'entry_starts_at' => Carbon\Carbon::now()->addMonths(1),
        'entry_ends_at' => Carbon\Carbon::now()->addMonths(2),
        'voting_starts_at' => Carbon\Carbon::now()->addMonths(3),
        'voting_ends_at' => Carbon\Carbon::now()->addMonths(4),
    ];
});

$factory->state(App\Models\Contest::class, 'entry', function (Faker\Generator $faker) {
    return [
        'entry_starts_at' => Carbon\Carbon::now()->subMonths(1),
        'entry_ends_at' => Carbon\Carbon::now()->addMonths(1),
        'voting_starts_at' => Carbon\Carbon::now()->addMonths(2),
        'voting_ends_at' => Carbon\Carbon::now()->addMonths(3),
    ];
});

$factory->state(App\Models\Contest::class, 'voting', function (Faker\Generator $faker) {
    return [
        'entry_starts_at' => Carbon\Carbon::now()->subMonths(3),
        'entry_ends_at' => Carbon\Carbon::now()->subMonths(2),
        'voting_starts_at' => Carbon\Carbon::now()->subMonths(1),
        'voting_ends_at' => Carbon\Carbon::now()->addMonths(1),
    ];
});

$factory->state(App\Models\Contest::class, 'completed', function (Faker\Generator $faker) {
    return [
        'entry_starts_at' => Carbon\Carbon::now()->subMonths(4),
        'entry_ends_at' => Carbon\Carbon::now()->subMonths(3),
        'voting_starts_at' => Carbon\Carbon::now()->subMonths(2),
        'voting_ends_at' => Carbon\Carbon::now()->subMonths(1),
    ];
});
