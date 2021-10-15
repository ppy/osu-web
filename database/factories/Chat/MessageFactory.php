<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\User;

$factory->define(Message::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->bs,
        'user_id' => function () {
            return User::factory()->create()->user_id;
        },
        'channel_id' => function () {
            return factory(Channel::class)->create()->channel_id;
        },
    ];
});
