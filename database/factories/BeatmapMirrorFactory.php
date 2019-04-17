<?php

use App\Models\BeatmapMirror;

$factory->define(BeatmapMirror::class, function (Faker\Generator $faker) {
    return  [
        'base_url' => 'http://beatmap-download.test/',
        'traffic_used' => rand(0, pow(2, 32)),
        'secret_key' => function () use ($faker) {
            return $faker->password();
        },
        'provider_user_id' => 2,
        'enabled' => 1,
        'version' => BeatmapMirror::MIN_VERSION_TO_USE,
    ];
});

$factory->state(BeatmapMirror::class, 'default', function () {
    return [
        'mirror_id' => config('osu.beatmap_processor.mirrors_to_use')[0],
    ];
});
