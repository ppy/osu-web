<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Tests\TestCase;

class UserNotificationTest extends TestCase
{
    public function testDeleteOnlyDeleteOrphanNotification()
    {
        $userA = factory(User::class)->create();
        $userB = factory(User::class)->create();

        $notification = factory(Notification::class)->create();

        $userNotificationA = factory(UserNotification::class)->create([
            'notification_id' => $notification->getKey(),
            'user_id' => $userA->getKey(),
        ]);

        $userNotificationB = factory(UserNotification::class)->create([
            'notification_id' => $notification->getKey(),
            'user_id' => $userB->getKey(),
        ]);

        $initialNotificationCount = Notification::count();
        $initialUserNotificationCount = UserNotification::count();

        UserNotification::bulkDelete($userA, [
            'notifications' => [
                ['id' => $notification->getKey()],
            ],
        ]);

        $this->assertSame(UserNotification::count(), $initialUserNotificationCount - 1);
        $this->assertSame(Notification::count(), $initialNotificationCount);
        $this->assertNull(UserNotification::find($userNotificationA->getKey()));
        $this->assertTrue(Notification::where('id', $notification->getKey())->exists());
    }

    public function testDeleteByIds()
    {
        $user = factory(User::class)->create();

        $notificationA = factory(Notification::class)->create();
        $notificationB = factory(Notification::class)->create();

        $userNotificationA = factory(UserNotification::class)->create([
            'notification_id' => $notificationA->getKey(),
            'user_id' => $user->getKey(),
        ]);

        $userNotificationB = factory(UserNotification::class)->create([
            'notification_id' => $notificationB->getKey(),
            'user_id' => $user->getKey(),
        ]);

        $initialNotificationCount = Notification::count();
        $initialUserNotificationCount = UserNotification::count();

        UserNotification::bulkDelete($user, [
            'notifications' => [
                ['id' => $notificationA->getKey()],
            ],
        ]);

        $this->assertSame(UserNotification::count(), $initialUserNotificationCount - 1);
        $this->assertSame(Notification::count(), $initialNotificationCount - 1);
        $this->assertNull(UserNotification::find($userNotificationA->getKey()));
        $this->assertNull(Notification::find($notificationA->getKey()));
        $this->assertTrue(UserNotification::where('id', $userNotificationB->getKey())->exists());
        $this->assertTrue(Notification::where('id', $notificationB->getKey())->exists());
    }

    public function testDeleteByNotificationIdentyByStack()
    {
        $user = factory(User::class)->create();

        $notificationA = factory(Notification::class)->create([
            'name' => Notification::BEATMAPSET_DISCUSSION_LOCK,
            'notifiable_id' => 1,
            'notifiable_type' => 'beatmapset',
        ]);
        $notificationB = factory(Notification::class)->create([
            'name' => $notificationA->name,
            'notifiable_id' => $notificationA->notifiable_id,
            'notifiable_type' => $notificationA->notifiable_type,
        ]);
        $notificationC = factory(Notification::class)->create([
            'name' => $notificationA->name,
            'notifiable_id' => 2,
            'notifiable_type' => $notificationA->notifiable_type,
        ]);

        $userNotificationA = factory(UserNotification::class)->create([
            'notification_id' => $notificationA->getKey(),
            'user_id' => $user->getKey(),
        ]);

        $userNotificationB = factory(UserNotification::class)->create([
            'notification_id' => $notificationB->getKey(),
            'user_id' => $user->getKey(),
        ]);

        $userNotificationC = factory(UserNotification::class)->create([
            'notification_id' => $notificationC->getKey(),
            'user_id' => $user->getKey(),
        ]);

        $initialUserNotificationCount = UserNotification::count();
        $initialNotificationCount = Notification::count();

        UserNotification::bulkDelete($user, [
            'category' => $notificationA->category,
            'object_type' => $notificationA->notifiable_type,
            'object_id' => $notificationA->notifiable_id,
        ]);

        $this->assertSame(UserNotification::count(), $initialUserNotificationCount - 2);
        $this->assertSame(Notification::count(), $initialNotificationCount - 2);
        $this->assertNull(UserNotification::find($userNotificationA->getKey()));
        $this->assertNull(UserNotification::find($userNotificationB->getKey()));
        $this->assertTrue(UserNotification::where('id', $userNotificationC->getKey())->exists());
        $this->assertTrue(Notification::where('id', $notificationC->getKey())->exists());
    }

    public function testDeleteByNotificationIdentityByObjectType()
    {
        $user = factory(User::class)->create();

        $notificationA = factory(Notification::class)->create([
            'name' => Notification::BEATMAPSET_DISCUSSION_LOCK,
            'notifiable_type' => 'beatmapset',
        ]);
        $notificationB = factory(Notification::class)->create([
            'name' => $notificationA->name,
            'notifiable_type' => 'beatmapset',
        ]);
        $notificationC = factory(Notification::class)->create([
            'name' => Notification::COMMENT_NEW,
            'notifiable_type' => 'news_post',
        ]);

        $userNotificationA = factory(UserNotification::class)->create([
            'notification_id' => $notificationA->getKey(),
            'user_id' => $user->getKey(),
        ]);

        $userNotificationB = factory(UserNotification::class)->create([
            'notification_id' => $notificationB->getKey(),
            'user_id' => $user->getKey(),
        ]);

        $userNotificationC = factory(UserNotification::class)->create([
            'notification_id' => $notificationC->getKey(),
            'user_id' => $user->getKey(),
        ]);

        $initialUserNotificationCount = UserNotification::count();
        $initialNotificationCount = Notification::count();

        UserNotification::bulkDelete($user, [
            'object_type' => $notificationA->notifiable_type,
        ]);

        $this->assertSame(UserNotification::count(), $initialUserNotificationCount - 2);
        $this->assertSame(Notification::count(), $initialNotificationCount - 2);
        $this->assertNull(UserNotification::find($userNotificationA->getKey()));
        $this->assertNull(Notification::find($notificationA->getKey()));
        $this->assertNull(UserNotification::find($userNotificationB->getKey()));
        $this->assertNull(Notification::find($notificationB->getKey()));
        $this->assertTrue(UserNotification::where('id', $userNotificationC->getKey())->exists());
        $this->assertTrue(Notification::where('id', $notificationC->getKey())->exists());
    }

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
