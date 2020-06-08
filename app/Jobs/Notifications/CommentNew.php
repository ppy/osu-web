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

    public static function getMailLink(Notification $notification): string
    {
        // TODO: actual item commented on.
        return route('comments.show', $notification->details['comment_id']);
    }

    public static function getMailText(Notification $notification): string
    {
        return trans("notifications.item.{$notification->notifiable_type}.comment.{$notification->name}", $notification->details);
    }

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
        return Follow::whereNotifiable($this->comment->commentable)
            ->where(['subtype' => 'comment'])
            ->pluck('user_id')
            ->all();
    }

    public function getNotifiable()
    {
        return $this->comment->commentable;
    }
}
