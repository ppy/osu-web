<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Exceptions\InvalidNotificationException;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotificationOption;

class CommentNew extends BroadcastNotificationBase
{
    const NOTIFICATION_OPTION_NAME = Notification::COMMENT_NEW;

    protected $comment;

    public static function getMailLink(Notification $notification): string
    {
        // TODO: actual item commented on.
        return route('comments.show', $notification->details['comment_id']);
    }

    public function __construct(Comment $comment, User $source)
    {
        parent::__construct($source);

        $this->comment = $comment;

        if ($this->comment->commentable === null) {
            throw new InvalidNotificationException("{$this->name}: comment #{$this->comment->getKey()} missing commentable");
        }
    }

    public function getDetails(): array
    {
        $details = [
            'comment_id' => $this->comment->getKey(),
            'title' => $this->comment->commentable->commentableTitle(),
            'content' => truncate($this->comment->message, static::CONTENT_TRUNCATE),
            'cover_url' => $this->comment->commentable->notificationCover(),
        ];

        if ($this->comment->parent !== null) {
            $details['reply_to'] = [
                'user_id' => $this->comment->parent->user_id,
            ];
        }

        return $details;
    }

    public function getListeningUserIds(): array
    {
        $userIds = Follow::whereNotifiable($this->comment->commentable)
            ->where(['subtype' => 'comment'])
            ->pluck('user_id');

        if ($this->comment->parent !== null) {
            // also notify parent if option is enabled.
            $user = $this->comment->parent->user;
            if ($user !== null) {
                $notificationOption = $user->notificationOptions()->where('name', Notification::COMMENT_NEW)->first();

                if ($notificationOption->details[UserNotificationOption::COMMENT_REPLY] ?? true) {
                    $userIds->push($user->getKey());
                }
            }
        }

        return $userIds->all();
    }

    public function getNotifiable()
    {
        return $this->comment->commentable;
    }
}
