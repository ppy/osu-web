<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Exceptions\InvalidNotificationException;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Notification;
use App\Models\User;

class CommentNew extends BroadcastNotificationBase
{
    protected $comment;

    public function __construct(Comment $comment, User $source)
    {
        parent::__construct($source);

        $this->comment = $comment;

        if ($this->comment->commentable === null) {
            throw new InvalidNotificationException("comment_new: comment #{$this->comment->getKey()} missing commentable");
        }
    }

    public function getDetails(): array
    {
        return [
            'comment_id' => $this->comment->getKey(),
            'title' => $this->comment->commentable->commentableTitle(),
            'content' => truncate($this->comment->message, static::CONTENT_TRUNCATE),
            'cover_url' => $this->comment->commentable->notificationCover(),
        ];
    }

    public function getListeningUserIds(): array
    {
        $userIds = Follow::whereNotifiable($this->comment->commentable)
            ->where(['subtype' => 'comment']);

        if ($this->comment->parent_id !== null) {
            $userIds->where('user_id', '<>', $this->comment->parent->user_id);
            broadcast_notification(Notification::COMMENT_REPLY, $this->comment, $this->source);
        }

        return $userIds->pluck('user_id')->all();
    }

    public function getNotifiable()
    {
        return $this->comment->commentable;
    }
}
