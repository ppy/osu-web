<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Libraries\MorphMap;
use App\Models\Notification;

$factory->define(Notification::class, function (Faker\Generator $faker) {
    return [
        'notifiable_type' => array_rand_val(MorphMap::MAP),
        'notifiable_id' => rand(),
        'name' => array_rand(Notification::NAME_TO_CATEGORY),
        'details' => [],
    ];
});
