<?php

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
    return [
        'type' => rand(0, 1) === 0 ? 'timeline' : 'general',
    ];
});

$factory->defineAs(BeatmapDiscussion::class, 'timeline', function () {
    return  [
        'timestamp' => 0,
        'message_type' => 'problem',
    ];
});

$factory->defineAs(BeatmapDiscussion::class, 'general', function () {
    return  [
        'timestamp' => null,
        'message_type' => 'problem',
    ];
});
