<?php

use App\Models\UserBanHistory;

$factory->define(UserBanHistory::class, function (Faker\Generator $faker) {
    return [
        'reason' => $faker->bs,
        // 5 minutes (300 seconds) times 2 to the nth power (as in the standard osu silence durations)
        'period' => 300 * (2 ** $faker->numberBetween(1, 10)),
        'banner_id' => App\Models\User::inRandomOrder()->first()->user_id,
    ];
});

$factory->state(UserBanHistory::class, 'silence', function (Faker\Generator $faker) {
    return ['ban_status' => 2];
});

$factory->state(UserBanHistory::class, 'restriction', function (Faker\Generator $faker) {
    return ['ban_status' => 1];
});

$factory->state(UserBanHistory::class, 'note', function (Faker\Generator $faker) {
    return ['ban_status' => 3];
});
