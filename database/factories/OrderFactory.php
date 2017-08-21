<?php

$factory->define(App\Models\Store\Order::class, function (Faker\Generator $faker) {
    return  [
        'user_id' => function () {
            return factory(App\Models\User::class)->create(['user_sig' => ''])->user_id;
        }
    ];
});
