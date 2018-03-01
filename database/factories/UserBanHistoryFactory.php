<?php


$factory->define(App\Models\UserBanHistory::class, function (Faker\Generator $faker) {
    return [
        'reason' => $faker->bs,
        // 5 minutes (300 seconds) times 2 to the nth power (as in the standard osu silence durations)
        'period' => 300 * (2 ** $faker->numberBetween(1, 10)),
        'banner_id' => App\Models\User::inRandomOrder()->first()->user_id,
    ];
});

$factory->state(App\Models\UserBanHistory::class, 'silence', function (Faker\Generator $faker) {
    return [
        'ban_status' => 2,
    ];
});

$factory->state(App\Models\UserBanHistory::class, 'restriction', function (Faker\Generator $faker) {
    return [
        'ban_status' => 1,
    ];
});

$factory->state(App\Models\UserBanHistory::class, 'note', function (Faker\Generator $faker) {
    return [
        'ban_status' => 3,
    ];
});
