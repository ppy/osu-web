<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Traits;

use App\Models\Comment;

trait CommentableDefaults
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // title for display in comments listing
    abstract public function commentableTitle();
}
