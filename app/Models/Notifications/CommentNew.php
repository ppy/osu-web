<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Notifications;

use App\Exceptions\InvalidNotificationException;
use App\Models\Follow;
use App\Models\User;

class CommentNew extends NotificationBase
{
    public function __construct($object, ?User $source)
    {
        parent::__construct($object, $source);

        $this->notifiable = $object->commentable;

        if ($this->notifiable === null) {
            throw new InvalidNotificationException("comment_new: comment #{$this->object->getKey()} missing commentable");
        }

        if ($this->source === null) {
            throw new InvalidNotificationException("comment_new: comment #{$this->object->getKey()} missing source");
        }
    }

    public function getDetails(): array
    {
        return [
            'comment_id' => $this->object->getKey(),
            'title' => $this->object->commentable->commentableTitle(),
            'content' => truncate($this->object->message, static::CONTENT_TRUNCATE),
            'cover_url' => $this->object->commentable->notificationCover(),
        ];
    }

    public function getListentingUserIds(): array
    {
        return Follow::whereNotifiable($this->object->commentable)
            ->where(['subtype' => 'comment'])
            ->pluck('user_id')
            ->all();
    }
}
