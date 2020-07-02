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
    public function testDeliveryMasks($mask, $type, $result)
    {
        $userNotification = new UserNotification(['delivery' => $mask]);
        $this->assertSame($result, $userNotification->isDelivery($type));
    }

    /**
     * Didn't accidentally break scope sanity test
     */
    public function testScopeHasMailDelivery()
    {
        $values = array_values(UserNotification::DELIVERY_OFFSETS);
        rsort($values);
        $max = 2 ** ($values[0] + 1);

        for ($i = 0; $i < $max; $i++) {
            UserNotification::create([
                'delivery' => $i,
                'notification_id' => 1,
                'user_id' => $i,
            ]);
        }

        $userNotifications = UserNotification::hasMailDelivery()->get();
        $this->assertTrue(
            $userNotifications->reduce(function ($carry, $userNotification) {
                return $carry && $userNotification->isMail();
            }, true)
        );
    }

    public function deliveryMaskDataProvider()
    {
        return [
            [0, 'mail', false],
            [0, 'push', false],

            [1, 'mail', false],
            [1, 'push', true],

            [2, 'mail', true],
            [2, 'push', false],

            [3, 'mail', true],
            [3, 'push', true],
        ];
    }
}
