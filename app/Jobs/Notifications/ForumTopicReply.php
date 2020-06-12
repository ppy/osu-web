<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Forum\Post;
use App\Models\User;
use App\Models\UserNotificationOption;

class ForumTopicReply extends BroadcastNotificationBase
{
    const NOTIFICATION_OPTION_NAME = UserNotificationOption::FORUM_TOPIC_REPLY;

    public function __construct(Post $object, User $source)
    {
        parent::__construct($object, $source);
    }

    public function getDetails(): array
    {
        return [
            'title' => $this->getNotifiable()->topic_title,
            'post_id' => $this->object->getKey(),
            'cover_url' => optional($this->getNotifiable()->cover)->fileUrl(),
        ];
    }

    public function getListeningUserIds(): array
    {
        return $this->object
            ->topic
            ->watches()
            ->where('mail', true)
            ->where('user_id', '<>', $this->source->getKey())
            ->pluck('user_id')
            ->all();
    }

    public function getNotifiable()
    {
        return $this->object->topic;
    }

    public function getTimestamp()
    {
        return $this->object->post_time;
    }
}
