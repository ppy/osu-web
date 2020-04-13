<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Events\NewNotificationEvent;
use App\Jobs\BroadcastNotification;
use App\Models\Beatmapset;
use App\Models\Chat\Channel;
use App\Models\Notification;
use App\Models\User;
use Event;
use Queue;

class BroadcastNotificationTest extends TestCase
{
    protected $sender;

    /**
     * @dataProvider sendNotificationDataProvider
     */
    public function testSendNotificationIfPushNotification($enabled)
    {
        $user = factory(User::class)->create();
        $user->notificationOptions()->create([
            'name' => Notification::BEATMAPSET_DISCUSSION_POST_NEW,
            'details' => ['push' => $enabled],
        ]);

        $beatmapset = factory(Beatmapset::class)->states('with_discussion')->create([
            'user_id' => $user->getKey(),
        ]);
        $beatmapset->watches()->create(['user_id' => $user->getKey()]);

        $this->beatmapDiscussion = $beatmapset->beatmapDiscussions()->first();

        $params = [
            'beatmapset_id' => $beatmapset->getKey(),
            'beatmap_discussion' => [
                'message_type' => 'praise',
            ],
            'beatmap_discussion_post' => [
                'message' => 'Hello',
            ],
        ];

        $this
            ->actingAsVerified($this->sender)
            ->post(route('beatmap-discussion-posts.store'), $params)
            ->assertStatus(200);

        if ($enabled) {
            Queue::assertPushed(BroadcastNotification::class, function (BroadcastNotification $job) {
                $notification = $job->handle();

                return $notification !== null;
            });

            Event::assertDispatched(NewNotificationEvent::class);
        } else {
            Queue::assertNotPushed(BroadcastNotification::class, function (BroadcastNotification $job) {
                $notification = $job->handle();

                return $notification !== null;
            });

            Event::assertNotDispatched(NewNotificationEvent::class);
        }
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

    public function sendNotificationDataProvider()
    {
        return [
            [true],
            [false],
        ];
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
