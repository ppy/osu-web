<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\UserAccountHistory;

$factory->define(UserAccountHistory::class, function (Faker\Generator $faker) {
    return [
        'reason' => $faker->bs,
        // 5 minutes (300 seconds) times 2 to the nth power (as in the standard osu silence durations)
        'period' => 300 * (2 ** $faker->numberBetween(1, 10)),
        'banner_id' => App\Models\User::inRandomOrder()->first()->user_id,
    ];
});

$factory->state(UserAccountHistory::class, 'silence', function (Faker\Generator $faker) {
    return ['ban_status' => 2];
});

$factory->state(UserAccountHistory::class, 'restriction', function (Faker\Generator $faker) {
    return ['ban_status' => 1];
});

$factory->state(UserAccountHistory::class, 'note', function (Faker\Generator $faker) {
    return ['ban_status' => 0];
});
