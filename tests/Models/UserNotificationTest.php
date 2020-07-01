<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Models\UserNotification;
use Tests\TestCase;

class UserNotificationTest extends TestCase
{
    /**
     * Didn't accidentally break masks sanity test.
     *
     * @dataProvider deliveryMaskDataProvider
     */
    public function testDeliveryMasks($mask, $method, $result)
    {
        $userNotification = new UserNotification(['delivery' => $mask]);
        $this->assertSame($result, $userNotification->$method());
    }

    public function testScopeHasMailDelivery()
    {
        for ($i = 0; $i < 4; $i++) {
            UserNotification::create([
                'delivery' => $i,
                'notification_id' => 1,
                'user_id' => $i
            ]);
        }

        $userNotifications = UserNotification::hasMailDelivery()->get();
        $userNotifications->each(function ($userNotification) {
            $this->assertTrue($userNotification->isMail(), "delivery mask {$userNotification->delivery} failed");
        });
    }

    public function deliveryMaskDataProvider()
    {
        return [
            [0, 'isMail', false],
            [0, 'isPush', false],

            [1, 'isMail', false],
            [1, 'isPush', true],

            [2, 'isMail', true],
            [2, 'isPush', false],

            [3, 'isMail', true],
            [3, 'isPush', true],
        ];
    }
}
