<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Carbon\Carbon;

$factory->define(App\Models\Build::class, function (Faker\Generator $faker) {
    $date = $faker->dateTimeBetween('-5 years');

    $streams = config('osu.changelog.update_streams');
    $stream_count = count($streams);

    return [
        'version' => Carbon::instance($date)->format('Ymd'),
        'date' => $date,
        'users' => rand(100, 10000),
        'stream_id' => $streams[rand(0, $stream_count - 1)],
    ];
});
