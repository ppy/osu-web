<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

class CommentReply extends CommentBase
{
    public function getListeningUserIds(): array
    {
        $parent = $this->comment->parent;
        if (!$parent->trashed()
            && $parent->user_id !== $this->comment->user_id) {
            return [$parent->user_id];
        }

        return [];
    }
}
