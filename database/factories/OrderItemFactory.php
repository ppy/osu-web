<?php

$factory->define(App\Models\Store\OrderItem::class, function (Faker\Generator $faker) {
    return  [
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

$factory->defineAs(App\Models\Store\OrderItem::class, 'supporter_tag', function (Faker\Generator $faker) {
    return  [
        'order_id' => function () {
            return factory(App\Models\Store\Order::class)->create()->id;
        },
        'product_id' => 10,
        'quantity' => 1,
        'cost' => 12.0,
        'extra_data' => function () {
            $user = factory(App\Models\User::class)->create();
            return [
                'target_id' => (string) $user->id,
                'username' => $user->username,
                'duration' => 4,
            ];
        },
    ];
});

$factory->defineAs(App\Models\Store\OrderItem::class, 'username_change', function (Faker\Generator $faker) {
    return  [
        'order_id' => function () {
            return factory(App\Models\Store\Order::class)->create()->id;
        },
        'product_id' => 1,
        'quantity' => 1,
        'cost' => 0,
        'extra_info' => 'new_username',
    ];
});
