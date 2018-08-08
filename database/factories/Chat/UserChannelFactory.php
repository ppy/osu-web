<?php

use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
use App\Models\User;

$factory->define(UserChannel::class, function (Faker\Generator $faker) {
    return  [
        'user_id' => function () {
            return factory(User::class)->create()->user_id;
        },
        'channel_id' => function () {
            return factory(Channel::class)->create()->channel_id;
        },
    ];
});
