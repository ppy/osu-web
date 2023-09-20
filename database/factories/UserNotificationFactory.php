<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;

class UserNotificationFactory extends Factory
{
    protected $model = UserNotification::class;

    public function definition(): array
    {
        return [
            'delivery' => UserNotification::deliveryMask(array_rand(UserNotification::DELIVERY_OFFSETS)),
            'notification_id' => Notification::factory(),
            'user_id' => User::factory(),
        ];
    }
}
