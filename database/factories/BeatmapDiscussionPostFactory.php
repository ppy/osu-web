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

use App\Models\BeatmapDiscussionPost;

$factory->define(BeatmapDiscussionPost::class, function (Faker\Generator $faker) {
    return [
        'message' => $faker->sentence(10),
    ];
});

$factory->state(BeatmapDiscussionPost::class, 'timeline', function (Faker\Generator $faker) {
    return [
        'message' => "00:00.000 {$faker->sentence(10)}",
    ];
});
