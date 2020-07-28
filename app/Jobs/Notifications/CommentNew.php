<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Follow;
use App\Models\Notification;

class CommentNew extends CommentBase
{
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
}
