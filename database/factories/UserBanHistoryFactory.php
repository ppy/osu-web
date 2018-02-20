<?php


$factory->define(App\Models\UserBanHistory::class, function (Faker\Generator $faker) {
    return [
        'reason' => $faker->bs,
        'period' => 300 << $faker->numberBetween(0, 10),
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
