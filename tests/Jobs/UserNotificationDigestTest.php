<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Jobs;

use App\Jobs\Notifications\BroadcastNotificationBase;
use App\Jobs\Notifications\ForumTopicReply;
use App\Mail\UserNotificationDigest as UserNotificationDigestMail;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicWatch;
use App\Models\User;
use App\Models\UserNotificationOption;
use Event;
use Mail;
use Queue;
use Tests\TestCase;

class UserNotificationDigestTest extends TestCase
{
    public function testForumTopicReplyNotificationsShouldNotRenotify(): void
    {
        $sender = User::factory()->create();
        $topic = Topic::factory()->create();
        $user = User::factory()->create();

        $user->notificationOptions()->create([
            'name' => UserNotificationOption::FORUM_TOPIC_REPLY,
            'details' => ['mail' => true],
        ]);
        TopicWatch::setState($topic, $user, 'watching_mail');

        $post = Post::factory()->create([
            'poster_id' => $sender,
            'topic_id' => $topic,
        ]);

        $this->broadcastAndSendMail(new ForumTopicReply($post, $sender));
        Mail::assertSent(UserNotificationDigestMail::class);

        $this->clearMailFake();

        (new ForumTopicReply($post, $sender))->dispatch();
        $this->broadcastAndSendMail(new ForumTopicReply($post, $sender));
        // update shouldn't be sent
        Mail::assertNotSent(UserNotificationDigestMail::class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
        Mail::fake();
    }

    private function broadcastAndSendMail(BroadcastNotificationBase $notification): void
    {
        $notification->dispatch();
        $this->runFakeQueue();

        // run mail jobs
        $this->artisan('notifications:send-mail');
        $this->runFakeQueue();
    }
}
