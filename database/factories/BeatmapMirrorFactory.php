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

use App\Models\BeatmapMirror;

$factory->define(BeatmapMirror::class, function () {
    return  [
        'base_url' => '',
        'secret_key' => '',
        'provider_user_id' => 0,
        'version' => BeatmapMirror::MIN_VERSION_TO_USE,
    ];
});

$factory->state(BeatmapMirror::class, 'default', function () {
    return [
        'mirror_id' => config('osu.beatmap_processor.mirrors_to_use')[0],
    ];
});
