<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
$factory->define(App\Models\BeatmapFailtimes::class, function (Faker\Generator $faker) {
    $array = [];

    for ($i = 1; $i <= 100; $i++) {
        $field = 'p'.strval($i);
        $array = array_merge($array, [$field => rand(1, 10000)]);
    }

    return $array;
});

$factory->defineAs(App\Models\BeatmapFailtimes::class, 'fail', function (Faker\Generator $faker) use ($factory) {
    $array = $factory->raw(App\Models\BeatmapFailtimes::class);

    return array_merge($array, ['type' => 'fail']);
});

$factory->defineAs(App\Models\BeatmapFailtimes::class, 'retry', function (Faker\Generator $faker) use ($factory) {
    $array = $factory->raw(App\Models\BeatmapFailtimes::class);

    return array_merge($array, ['type' => 'exit']);
});
