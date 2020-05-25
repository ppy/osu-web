<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Notifications;

use App\Models\Forum\Post;
use App\Models\User;
use App\Models\UserNotificationOption;

class ForumTopicReply extends NotificationBase
{
    public function __construct(Post $object, ?User $source)
    {
        parent::__construct($object, $source);

        $this->notifiable = $this->object->topic;
    }

    public function getDetails(): array
    {
        // TODO: $this->params['created_at'] = $this->object->post_time;

        return [
            'title' => $this->notifiable->topic_title,
            'post_id' => $this->object->getKey(),
            'cover_url' => optional($this->notifiable->cover)->fileUrl(),
        ];
    }

    public function getReceiverIds(): array
    {
        $userIds = $this->object
            ->topic
            ->watches()
            ->where('mail', true)
            ->where('user_id', '<>', $this->source->getKey())
            ->pluck('user_id')
            ->all();

        return static::filterUserIdsForNotificationOption(
            $userIds,
            UserNotificationOption::FORUM_TOPIC_REPLY
        );
    }
}
