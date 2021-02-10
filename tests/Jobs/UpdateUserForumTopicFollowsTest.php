<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Jobs;

use App\Models\Forum\Forum;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicWatch;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Tests\TestCase;

class UpdateUserForumTopicFollowsTest extends TestCase
{
    public function testRemoveUserWithNoWatchPermission()
    {
        $forum = factory(Forum::class, 'child')->create();
        $adminForum = factory(Forum::class, 'child')->create(['forum_id' => config('osu.forum.admin_forum_id')]);
        config()->set('osu.forum.admin_forum_id', $adminForum->getKey());
        $anotherForum = factory(Forum::class, 'child')->create();
        $topic = factory(Topic::class)->create(['forum_id' => $forum->getKey()]);
        $user = factory(User::class)->create();

        TopicWatch::setState($topic, $user, 'watching_mail');
        $notification = Notification::create([
            'notifiable_id' => $topic->getKey(),
            'notifiable_type' => $topic->getMorphClass(),
            'name' => Notification::FORUM_TOPIC_REPLY,
            'details' => [],
        ]);
        $zz = UserNotification::create([
            'notification_id' => $notification->getKey(),
            'user_id' => $user->getKey(),
            'created_at' => now()->subHour(1),
        ]);

        $watchesCount = TopicWatch::count();
        $userNotificationsCount = UserNotification::count();

        $topic->moveTo($anotherForum);

        $this->assertSame($watchesCount, TopicWatch::count());
        $this->assertSame($userNotificationsCount, UserNotification::count());

        app()->make('OsuAuthorize')->cacheReset();
        $topic->moveTo($adminForum);

        $this->assertSame($watchesCount - 1, TopicWatch::count());
        $this->assertSame($userNotificationsCount - 1, UserNotification::count());
    }
}
