<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Events\NewPrivateNotificationEvent;
use App\Jobs\BroadcastNotification;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotificationOption;
use Event;
use Queue;

class BeatmapsetDisqualifyTest extends TestCase
{
    /** @var Beatmapset */
    protected $beatmapset;

    /** @var User */
    protected $sender;

    /** @var User */
    protected $user;

    public function testDuplicateNotificationNotSent()
    {
        $this->beatmapset->watches()->create(['user_id' => $this->user->getKey()]);
        $this->createNotificationOption();

        $this->disqualify()->assertStatus(200);

        Queue::assertPushed(BroadcastNotification::class, function (BroadcastNotification $job) {
            return optional($job->handle())->name === Notification::BEATMAPSET_DISQUALIFY;
        });

        $dispatchedCount = 0;
        Event::assertDispatched(NewPrivateNotificationEvent::class, function (NewPrivateNotificationEvent $event) use (&$dispatchedCount) {
            if ($event->notification->name === Notification::BEATMAPSET_DISQUALIFY) {
                $this->assertSame(array_unique($event->getReceiverIds()), $event->getReceiverIds());
                $dispatchedCount++;
            }

            return true;
        });

        $this->assertSame(1, $dispatchedCount);
    }

    public function testNotificationSentIfWatching()
    {
        $this->beatmapset->watches()->create(['user_id' => $this->user->getKey()]);

        $this->disqualify()->assertStatus(200);

        Queue::assertPushed(BroadcastNotification::class, function (BroadcastNotification $job) {
            return optional($job->handle())->name === Notification::BEATMAPSET_DISQUALIFY;
        });

        Event::assertDispatched(NewPrivateNotificationEvent::class, function (NewPrivateNotificationEvent $event) {
            return $event->notification->name === Notification::BEATMAPSET_DISQUALIFY
                && in_array($this->user->getKey(), $event->getReceiverIds(), true);
        });
    }

    /**
     * @dataProvider booleanDataProvider
     */
    public function testNotificationSentWithPushNotificationDeliveryOption($pushEnabled)
    {
        $this->beatmapset->watches()->create(['user_id' => $this->user->getKey()]);
        $this->user->notificationOptions()->create([
            'name' => UserNotificationOption::BEATMAPSET_MODDING,
        ])->update(['details' => ['push' => $pushEnabled]]);

        $this->disqualify()->assertStatus(200);

        if ($pushEnabled) {
            Queue::assertPushed(BroadcastNotification::class, function (BroadcastNotification $job) {
                return optional($job->handle())->name === Notification::BEATMAPSET_DISQUALIFY;
            });

            Event::assertDispatched(NewPrivateNotificationEvent::class, function (NewPrivateNotificationEvent $event) {
                return $event->notification->name === Notification::BEATMAPSET_DISQUALIFY
                    && in_array($this->user->getKey(), $event->getReceiverIds(), true);
            });
        } else {
            // We want to assert the job was queued but because there should be no receivers, there won't be a notification generated.
            $jobDidRun = false;
            Queue::assertPushed(BroadcastNotification::class, function (BroadcastNotification $job) use (&$jobDidRun) {
                $job->handle();
                if ($job->getName() === Notification::BEATMAPSET_DISQUALIFY) {
                    $jobDidRun = true;
                }

                return true;
            });

            $this->assertTrue($jobDidRun);

            Event::assertNotDispatched(NewPrivateNotificationEvent::class, function (NewPrivateNotificationEvent $event) {
                return $event->notification->name === Notification::BEATMAPSET_DISQUALIFY;
            });
        }
    }

    public function testNotificationSentIfNotificationOptionsEnabled()
    {
        $this->createNotificationOption();

        $this->disqualify()->assertStatus(200);

        Queue::assertPushed(BroadcastNotification::class, function (BroadcastNotification $job) {
            return optional($job->handle())->name === Notification::BEATMAPSET_DISQUALIFY;
        });

        Event::assertDispatched(NewPrivateNotificationEvent::class, function (NewPrivateNotificationEvent $event) {
            return $event->notification->name === Notification::BEATMAPSET_DISQUALIFY
                && in_array($this->user->getKey(), $event->getReceiverIds(), true);
        });
    }

    public function testNotificationNotSentIfNotificationOptionsNotEnabled()
    {
        $this->disqualify()->assertStatus(200);

        Queue::assertNotPushed(BroadcastNotification::class, function (BroadcastNotification $job) {
            return optional($job->handle())->name === Notification::BEATMAPSET_DISQUALIFY;
        });

        Event::assertNotDispatched(NewPrivateNotificationEvent::class);
    }

    public function booleanDataProvider()
    {
        return [
            [true],
            [false],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();

        $this->beatmapset = factory(Beatmapset::class)->states('qualified', 'with_discussion')->create();
        $this->sender = $this->createUserWithGroup('bng');
        $this->user = factory(User::class)->create();

    }

    private function createNotificationOption()
    {
        $this->user->notificationOptions()->create([
            'name' => Notification::BEATMAPSET_DISQUALIFY,
        ])->update(['details' => ['modes' => array_keys(Beatmap::MODES)]]);
    }

    private function disqualify()
    {
        return $this
            ->actingAsVerified($this->sender)
            ->post(route('beatmap-discussion-posts.store'), [
                'beatmapset_id' => $this->beatmapset->beatmapset_id,
                'beatmap_discussion' => [
                    'message_type' => 'problem',
                ],
                'beatmap_discussion_post' => [
                    'message' => 'Hello',
                ],
            ]);
    }
}
