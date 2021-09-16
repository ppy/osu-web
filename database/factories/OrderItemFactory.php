<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\Store\OrderItem::class, function (Faker\Generator $faker) {
    return [
        'order_id' => function () {
            return factory(App\Models\Store\Order::class)->create()->order_id;
        },
        'product_id' => function () {
            return factory(App\Models\Store\Product::class)->create()->product_id;
        },
        'quantity' => 1,
        'cost' => 12.0,
    ];
});

$factory->state(App\Models\Store\OrderItem::class, 'supporter_tag', function (Faker\Generator $faker) use ($factory) {
    return [
        'product_id' => App\Models\Store\Product::customClass('supporter-tag')->first(),
        'cost' => 4,
        'extra_data' => function (array $self) {
            // find the user for the generated item's order
            $order = App\Models\Store\Order::find($self['order_id']);
            $user = $order->user;

            return [
                'target_id' => (string) $user->user_id,
                'username' => $user->username,
                'duration' => 1,
            ];
        },
    ];
});

$factory->state(App\Models\Store\OrderItem::class, 'username_change', function (Faker\Generator $faker) use ($factory) {
    return [
        'product_id' => App\Models\Store\Product::customClass('username-change')->first(),
        'cost' => 0,
        'extra_info' => 'new_username',
    ];
});
