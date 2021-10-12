<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Commands;

use App\Mail\UserNotificationDigest;
use App\Models\Beatmapset;
use App\Models\Count;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\UserNotificationOption;
use Mail;
use Tests\TestCase;

class NotificationsSendMailTest extends TestCase
{
    public function testDoesNotSendMailAlreadySent()
    {
        $lastId = Count::lastMailUserNotificationIdSent();
        $lastId->count = UserNotification::orderBy('id', 'desc')->first()->getKey();
        $lastId->save();

        $this->artisan('notifications:send-mail');

        Mail::assertNotSent(UserNotificationDigest::class);
    }

    public function testLastNotificationIdSentDoesNotGoBackwards()
    {
        $to = UserNotification::orderBy('id', 'desc')->first()->getKey();
        $lastId = Count::lastMailUserNotificationIdSent();
        $lastId->count = $to + 10;
        $lastId->save();

        $this->artisan('notifications:send-mail', ['--from' => 0, '--to' => $to]);
        Mail::assertSent(UserNotificationDigest::class, 1);
        $this->assertSame($to + 10, Count::lastMailUserNotificationIdSent()->count);
    }

    public function testSendsMailAndUpdatesCounter()
    {
        $this->artisan('notifications:send-mail');

        // both notifications should go into the same mail
        // TODO: split out multiple notification test after making it easier to trigger notifications for testing.
        Mail::assertSent(UserNotificationDigest::class, 1);
        $this->assertSame(UserNotification::orderBy('id', 'desc')->first()->getKey(), Count::lastMailUserNotificationIdSent()->count);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();

        $sender = factory(User::class)->create();
        $user = factory(User::class)->create();
        $user->notificationOptions()->create([
            'name' => UserNotificationOption::BEATMAPSET_MODDING,
            'details' => ['mail' => true],
        ]);

        $beatmapsets = [
            Beatmapset::factory()->withDiscussion()->create(['user_id' => $user]),
            Beatmapset::factory()->withDiscussion()->create(['user_id' => $user]),
        ];

        foreach ($beatmapsets as $beatmapset) {
            $beatmapset->watches()->create([
                'last_read' => now()->subSecond(),
                'user_id' => $user->getKey(),
            ]);
            $this
                ->actingAsVerified($sender)
                ->post(route('beatmapsets.discussions.posts.store'), $this->makeBeatmapsetDiscussionPostParams($beatmapset, 'praise'));
        }
    }
}
