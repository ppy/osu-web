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

use App\Models\BeatmapDiscussion;

$factory->define(BeatmapDiscussion::class, function (Faker\Generator $faker) use ($factory) {
    $type = rand(0, 1) === 0 ? 'timeline' : 'general';

    return $factory->raw(BeatmapDiscussion::class, [], $type);
});

$factory->defineAs(BeatmapDiscussion::class, 'timeline', function () {
    return [
        'timestamp' => 0,
        'message_type' => 'problem',
    ];
});

$factory->defineAs(BeatmapDiscussion::class, 'general', function () {
    return [
        'timestamp' => null,
        'message_type' => 'problem',
    ];
});

$factory->defineAs(BeatmapDiscussion::class, 'review', function () {
    return [
        'message_type' => 'review',
    ];
});
