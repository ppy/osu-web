<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\UserNotification;

$factory->define(UserNotification::class, function (Faker\Generator $faker) {
    return [
        'delivery' => UserNotification::deliveryMask(array_rand(UserNotification::DELIVERY_OFFSETS)),
        'notification_id' => rand(),
        'user_id' => rand(),
    ];
});
