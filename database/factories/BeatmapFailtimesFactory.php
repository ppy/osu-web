<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
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
