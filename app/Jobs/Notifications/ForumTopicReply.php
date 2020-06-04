<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Forum\Post;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotificationOption;

class ForumTopicReply extends BroadcastNotificationBase
{
    const NOTIFICATION_OPTION_NAME = UserNotificationOption::FORUM_TOPIC_REPLY;

    protected $post;

    public static function getMailText(Notification $notification): string
    {
        $link = route('forum.posts.show', $notification['details']->post_id ?? 0);

        return "new forum post in {$notification->details['title']} by {$notification->details['username']} {$link}";
    }

    public function __construct(Post $post, User $source)
    {
        parent::__construct($source);

        $this->post = $post;
    }

    public function getDetails(): array
    {
        return [
            'title' => $this->post->topic->topic_title,
            'post_id' => $this->post->getKey(),
            'cover_url' => optional($this->post->topic->cover)->fileUrl(),
        ];
    }

    public function getListeningUserIds(): array
    {
        return $this->post
            ->topic
            ->watches()
            ->where('mail', true)
            ->where('user_id', '<>', $this->source->getKey())
            ->pluck('user_id')
            ->all();
    }

    public function getNotifiable()
    {
        return $this->post->topic;
    }

    public function getTimestamp()
    {
        return $this->post->post_time;
    }
}
