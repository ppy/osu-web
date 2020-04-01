<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Models\Forum\Forum;

trait HasFilteredForums
{
    public function filteredForumIds()
    {
        if (isset($this->forumId)) {
            $forumIds = $this->includeSubforums
                ? Forum::findOrFail($this->forumId)->allSubForums()
                : [$this->forumId];

            $forums = Forum::whereIn('forum_id', $forumIds)->get();
        } else {
            $forums = Forum::all();
        }

        return $forums->filter(function ($forum) {
            return priv_check('ForumView', $forum)->can();
        })->pluck('forum_id');
    }
}
