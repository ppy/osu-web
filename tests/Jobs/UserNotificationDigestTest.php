<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Jobs;

use App\Jobs\Notifications\ForumTopicReply;
use App\Mail\UserNotificationDigest as UserNotificationDigestMail;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;
use App\Models\UserNotificationOption;
use Event;
use Mail;
use Queue;
use Tests\TestCase;

class UserNotificationDigestTest extends TestCase
{
    protected $sender;

    public function testForumTopicReplyNotificationsShouldNotRenotify()
    {
        $this->user->notificationOptions()->create([
            'name' => UserNotificationOption::FORUM_TOPIC_REPLY,
            'details' => ['mail' => true],
        ]);

        $forum = factory(Forum::class)->states('parent')->create();
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

        $this->broadcastAndSendMail(new ForumTopicReply($post, $this->sender));
        Mail::assertSent(UserNotificationDigestMail::class);

        $this->clearMailFake();

        (new ForumTopicReply($post, $this->sender))->dispatch();
        $this->broadcastAndSendMail(new ForumTopicReply($post, $this->sender));
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

    private function broadcastAndSendMail($notification)
    {
        $notification->dispatch();
        $this->runFakeQueue();

        // run mail jobs
        $this->artisan('notifications:send-mail');
        $this->runFakeQueue();
    }
}
