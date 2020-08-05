<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Jobs;

use App\Mail\UserNotificationDigest as UserNotificationDigestMail;
use App\Models\Beatmapset;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotificationOption;
use Event;
use Mail;
use Queue;
use Tests\TestCase;

class UserNotificationDigestTest extends TestCase
{
    protected $sender;

    public function testBeatmapsetStateNotificationsShouldNotRenotify()
    {
        $user = factory(User::class)->create();
        $user->notificationOptions()->create([
            'name' => UserNotificationOption::BEATMAPSET_MODDING,
            'details' => ['mail' => true],
        ]);

        $beatmapset = factory(Beatmapset::class)->states('with_discussion')->create([
            'user_id' => $user->getKey(),
        ]);

        $beatmapset->watches()->create([
            'last_read' => now()->subSecond(), // make sure last_read isn't the same second the test runs.
            'user_id' => $user->getKey(),
        ]);

        // beatmapset_state type notifications
        $notificationTypes = [
            Notification::BEATMAPSET_DISQUALIFY,
            Notification::BEATMAPSET_LOVE,
            Notification::BEATMAPSET_NOMINATE,
            Notification::BEATMAPSET_QUALIFY,
            Notification::BEATMAPSET_RANK,
            Notification::BEATMAPSET_RESET_NOMINATIONS,
        ];

        foreach ($notificationTypes as $type) {
            broadcast_notification($type, $beatmapset, $this->sender);
        }

        // run broadcast
        $this->runFakeQueue();

        // run mail jobs
        $this->artisan('notifications:send-mail');
        $this->runFakeQueue();
        Mail::assertSent(UserNotificationDigestMail::class);

        $this->clearMailFake();

        // simulate more notifications
        foreach ($notificationTypes as $type) {
            broadcast_notification($type, $beatmapset, $this->sender);
        }

        $this->runFakeQueue();

        // new 'generic' notifications shouldn't be sent again
        $this->artisan('notifications:send-mail');
        $this->runFakeQueue();
        Mail::assertNotSent(UserNotificationDigestMail::class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
        Mail::fake();

        $this->sender = factory(User::class)->create();
    }
}
