<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Jobs;

use App\Mail\UserNotificationDigest as UserNotificationDigestMail;
use App\Models\Beatmapset;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
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
        $this->user->notificationOptions()->create([
            'name' => UserNotificationOption::BEATMAPSET_MODDING,
            'details' => ['mail' => true],
        ]);

        $beatmapset = factory(Beatmapset::class)->states('with_discussion')->create([
            'user_id' => $this->user->getKey(),
        ]);

        $beatmapset->watches()->create([
            'last_read' => now()->subSecond(), // make sure last_read isn't the same second the test runs.
            'user_id' => $this->user->getKey(),
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

        $this->broadcastAndSendMail($notificationTypes, $beatmapset, $this->sender);
        Mail::assertSent(UserNotificationDigestMail::class);

        $this->clearMailFake();

        // simulate more notifications
        $this->broadcastAndSendMail($notificationTypes, $beatmapset, $this->sender);
        // new 'generic' notifications shouldn't be sent again
        Mail::assertNotSent(UserNotificationDigestMail::class);
    }

    public function testForumTopicReplyNotificationsShouldNotRenotify()
    {
        $this->user->notificationOptions()->create([
            'name' => UserNotificationOption::FORUM_TOPIC_REPLY,
            'details' => ['mail' => true],
        ]);

        $forum = factory(Forum::class, 'parent')->create();
        $topic = factory(Topic::class)->make();
        $forum->topics()->save($topic);
        $topic->refresh();

        $topic->watches()->create(['mail' => true, 'user_id' => $this->user->getKey()]);

        $post = factory(Post::class)->create([
            'post_username' => $this->sender->username,
            'poster_id' => $this->sender->getKey(),
            'forum_id' => $forum->getKey(),
            'topic_id' => $topic->getKey(),
        ]);

        $this->broadcastAndSendMail([Notification::FORUM_TOPIC_REPLY], $post, $this->sender);
        Mail::assertSent(UserNotificationDigestMail::class);

        $this->clearMailFake();

        $this->broadcastAndSendMail([Notification::FORUM_TOPIC_REPLY], $post, $this->sender);
        // update shouldn't be sent
        Mail::assertNotSent(UserNotificationDigestMail::class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
        Mail::fake();

        $this->user = factory(User::class)->create();
        $this->sender = factory(User::class)->create();
    }

    private function broadcastAndSendMail(array $notificationTypes, $object, User $source)
    {
        foreach ($notificationTypes as $type) {
            broadcast_notification($type, $object, $source);
        }

        $this->runFakeQueue();

        // run mail jobs
        $this->artisan('notifications:send-mail');
        $this->runFakeQueue();
    }
}
