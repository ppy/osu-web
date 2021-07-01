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

$states = [
    'timeline' => [
        'timestamp' => 0,
        'message_type' => 'problem',
    ],
    'general' => [
        'timestamp' => null,
        'message_type' => 'problem',
    ],
    'review' => [
        'message_type' => 'review',
    ],
];

$factory->define(BeatmapDiscussion::class, fn () => array_rand_val($states));

foreach ($states as $state => $attributes) {
    $factory->state(BeatmapDiscussion::class, $state, $attributes);
}
