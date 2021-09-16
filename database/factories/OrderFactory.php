<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\Store\Order::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create(['user_sig' => ''])->user_id;
        },
    ];
});

$factory->state(App\Models\Store\Order::class, 'paid', function (Faker\Generator $faker) use ($factory) {
    $date = Carbon\Carbon::now();

    return [
        'paid_at' => $date,
        'status' => 'paid',
        'transaction_id' => "test-{$date->timestamp}",
    ];
});

$factory->state(App\Models\Store\Order::class, 'incart', function (Faker\Generator $faker) {
    return [
        'status' => 'incart',
    ];
});

$factory->state(App\Models\Store\Order::class, 'processing', function (Faker\Generator $faker) {
    return [
        'status' => 'processing',
    ];
});

$factory->state(App\Models\Store\Order::class, 'checkout', function (Faker\Generator $faker) {
    return [
        'status' => 'checkout',
    ];
});

$factory->state(App\Models\Store\Order::class, 'shipped', function (Faker\Generator $faker) {
    return [
        'status' => 'shipped',
    ];
});

$factory->state(App\Models\Store\Order::class, 'shopify', function (Faker\Generator $faker) {
    return [
        // Doesn't need to be a gid for tests.
        'transaction_id' => App\Models\Store\Order::PROVIDER_SHOPIFY.'-'.now()->timestamp,
    ];
});
