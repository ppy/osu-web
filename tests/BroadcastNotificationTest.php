<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Events\NewPrivateNotificationEvent;
use App\Jobs\BroadcastNotification;
use App\Models\Beatmapset;
use App\Models\User;
use App\Models\UserNotificationOption;
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
            'name' => UserNotificationOption::BEATMAPSET_MODDING,
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

        Queue::assertPushed(BroadcastNotification::class);
        $this->runFakeQueue();

        if ($enabled) {
            Event::assertDispatched(NewPrivateNotificationEvent::class);
        } else {
            Event::assertNotDispatched(NewPrivateNotificationEvent::class);
        }
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
