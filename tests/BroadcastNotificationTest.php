<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Events\NewNotificationEvent;
use App\Jobs\BroadcastNotification;
use App\Models\Chat\Channel;
use App\Models\User;
use Event;
use Queue;

class BroadcastNotificationTest extends TestCase
{
    protected $sender;

    public function testExcludesSenderFromNotifications()
    {

    }

    public function testSendNotificationIfPushNotificationEnabled()
    {

    }


    public function testDoesNotSendNotificationIfPushNotificationDisabled()
    {

    }

    public function testSendsNotificationIfOptionNotSet()
    {
        $user = factory(User::class)->create();

        $channel = factory(Channel::class)->states('pm')->create();
        $channel->addUser($this->sender);
        $channel->addUser($user);
        $channel->receiveMessage($this->sender, 'test', false);

        Queue::assertPushed(BroadcastNotification::class, function (BroadcastNotification $job) use ($user) {
            $notification = $job->handle();
            $receiverIds = $notification->userNotifications()->pluck('user_id')->all();

            $this->assertSame([$user->getKey()], $receiverIds);

            return $notification !== null;
        });

        // if private notification, should assert receiverIds.
        Event::assertDispatched(NewNotificationEvent::class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        // mocking the queue so we can run the job manually to get the created notification.
        Queue::fake();
        Event::fake();

        $this->sender = factory(User::class)->create();
    }
}
