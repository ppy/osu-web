<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Libraries;

use App\Models\Comment;
use App\Models\User;

class CommentBundle
{
    private $commentable;
    private $comments;
    private $parentId;
    private $lastLoadedId;
    private $order;

    public function __construct($commentable, $options = [])
    {
        $this->commentable = $commentable;

        $this->parentId = $options['parentId'] ?? null;
        $this->lastLoadedId = $options['lastLoadedId'] ?? null;
        $this->order = $options['order'] ?? null;
        $this->comments = $options['comments'] ?? null;
    }

    public function toArray()
    {
        if (isset($this->comments)) {
            $comments = $this->comments;
        } else {
            $comments = $this->getComments(
                $this->commentable->comments()->where(['parent_id' => $this->parentId]),
                $this->lastLoadedId
            );

            $nestedComments = null;

            for ($i = 0; $i < 2; $i++) {
                if ($i === 0) {
                    $parentIds = $comments->pluck('id');
                } else {
                    $parentIds = $nestedComments->pluck('id');
                }

                $nestedComments = $this->getComments(Comment::whereIn('parent_id', $parentIds), null, 50);
                $comments = $comments->concat($nestedComments);
            }
        }

        $userIds = $comments->pluck('user_id')
            ->concat($comments->pluck('edited_by_id'));

        $users = User::whereIn('user_id', $userIds)->get();

        $result = [
            'comments' => json_collection($comments, 'Comment'),
            'users' => json_collection($users, 'UserCompact'),
        ];

        if ($this->parentId === null) {
            $result['top_level_count'] = $this->commentable->comments()->whereNull('parent_id')->count();
        }

        return $result;
    }

    private function getComments($query, $lastLoadedId = null, $limit = 20)
    {
        if ($lastLoadedId !== null) {
            $query->where('id', '<', $lastLoadedId);
        }

        return $query
            ->orderBy('created_at', 'DESC')
            ->orderBy('id', 'DESC')
            ->limit($limit)
            ->get();
    }
}
