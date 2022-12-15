<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\Store\Product;

$factory->define(App\Models\Store\OrderItem::class, function (Faker\Generator $faker) {
    return [
        'order_id' => function () {
            return factory(Order::class)->create()->order_id;
        },
        'product_id' => function () {
            return factory(Product::class)->create()->product_id;
        },
        'quantity' => 1,
        'cost' => 12.0,
    ];
});

$factory->state(OrderItem::class, 'supporter_tag', function (Faker\Generator $faker) use ($factory) {
    return [
        'product_id' => Product::customClass(Product::SUPPORTER_TAG_NAME)->first(),
        'cost' => 4,
        'extra_data' => function (array $self) {
            // find the user for the generated item's order
            $order = Order::find($self['order_id']);
            $user = $order->user;

            return [
                'target_id' => $user->getKey(),
                'username' => $user->username,
                'duration' => 1,
            ];
        },
    ];
});

$factory->state(OrderItem::class, 'username_change', function (Faker\Generator $faker) use ($factory) {
    return [
        'product_id' => Product::customClass('username-change')->first(),
        'cost' => 0,
        'extra_info' => 'new_username',
    ];
});
