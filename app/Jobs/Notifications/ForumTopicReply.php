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

    public static function getMailLink(Notification $notification): string
    {
        // link to start=unread since all updates get collapsed into one line.
        return route('forum.topics.show', ['start' => 'unread', 'topic' => $notification->notifiable_id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function shouldSendMail(Notification $notification, $watches, $time): bool
    {
        $watch = $watches['topics'][$notification->notifiable_id] ?? null;
        if ($watch === null) {
            return false;
        }

        // make the model dirty so UserNotificationDigest job can batch update.
        $watch->notify_status = true;

        return true;
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
