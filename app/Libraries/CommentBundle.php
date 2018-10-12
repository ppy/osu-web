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
    const DEFAULT_PAGE = 1;
    const DEFAULT_LIMIT = 50;

    public $depth;
    public $filterByParentId;
    public $includeCommentableMeta;
    public $includeParent;
    public $params;

    private $commentable;
    private $comments;
    private $lastLoadedId;

    public function __construct($commentable, $options = [])
    {
        $this->commentable = $commentable;

        $this->params = [
            'parent_id' => null,
            'last_loaded_id' => null,
            'limit' => static::DEFAULT_LIMIT,
            'page' => static::DEFAULT_PAGE,
        ];
        $this->setParams($options['params'] ?? []);

        $this->comments = $options['comments'] ?? null;
        $this->depth = $options['depth'] ?? 2;
        $this->filterByParentId = $options['filterByParentId'] ?? true;
        $this->includeCommentableMeta = $options['includeCommentableMeta'] ?? false;
        $this->includeParent = $options['includeParent'] ?? false;
    }

    public function toArray()
    {
        if (isset($this->comments)) {
            $comments = $this->comments;
        } else {
            $comments = $this->getComments($this->commentsQuery(), false);

            $nestedComments = null;

            for ($i = 0; $i < $this->depth; $i++) {
                if ($i === 0) {
                    $parentIds = $comments->pluck('id');
                } else {
                    $parentIds = $nestedComments->pluck('id');
                }

                $nestedComments = $this->getComments(Comment::whereIn('parent_id', $parentIds));
                $comments = $comments->concat($nestedComments);
            }
        }

        $users = $this->getUsers($comments);

        $result = [
            'comments' => json_collection($comments, 'Comment', $this->commentIncludes()),
            'users' => json_collection($users, 'UserCompact'),
        ];

        if ($this->params['parent_id'] === null && $this->filterByParentId) {
            $result['top_level_count'] = $this->commentsQuery()->whereNull('parent_id')->count();
        }

        return $result;
    }

    public function commentIncludes()
    {
        $includes = [];

        if ($this->includeCommentableMeta) {
            $includes[] = 'commentable_meta';
        }

        if ($this->includeParent) {
            $includes[] = 'parent';
        }

        return $includes;
    }

    public function commentsQuery()
    {
        if (isset($this->commentable)) {
            return $this->commentable->comments();
        } else {
            return Comment::select();
        }
    }

    public function setParams($input)
    {
        if (array_key_exists('parent_id', $input)) {
            $this->params['parent_id'] = get_int($input['parent_id']);
        }
        if (array_key_exists('last_loaded_id', $input)) {
            $this->params['last_loaded_id'] = get_int($input['last_loaded_id']);
        }
        if (array_key_exists('limit', $input)) {
            $this->params['limit'] = clamp(get_int($input['limit']), 1, 100);
        }
        if (array_key_exists('page', $input)) {
            $this->params['page'] = max(get_int($input['page']), 1);
        }
    }

    public function getParams()
    {
        $params = [];

        if ($this->params['last_loaded_id'] !== null) {
            $params['last_loaded_id'] = $this->params['last_loaded_id'];
        }

        if ($this->params['parent_id'] !== null) {
            $params['parent_id'] = $this->params['parent_id'];
        }

        if ($this->params['page'] !== static::DEFAULT_PAGE) {
            $params['page'] = $this->params['page'];
        }

        if ($this->params['limit'] !== static::DEFAULT_LIMIT) {
            $params['limit'] = $this->params['limit'];
        }

        return $params;
    }

    private function getComments($query, $isChildren = true)
    {
        if (!$isChildren) {
            // FIXME: This should be replaced with multi-column comparison
            // which also includes the created_at, in line with actual ORDER BY
            // used in the final query.
            if ($this->params['last_loaded_id'] !== null) {
                $query->where('id', '<', $this->params['last_loaded_id']);
            }

            if ($this->filterByParentId) {
                $query->where(['parent_id' => $this->params['parent_id']]);
            }

            $query->offset($this->params['limit'] * ($this->params['page'] - 1));
        }

        if ($this->includeCommentableMeta) {
            $query->with('commentable');
        }

        if ($this->includeParent) {
            $query->with('parent');
        }

        return $query
            ->orderBy('created_at', 'DESC')
            ->orderBy('id', 'DESC')
            ->limit($this->params['limit'])
            ->get();
    }

    private function getUsers($comments)
    {
        $userIds = $comments->pluck('user_id')
            ->concat($comments->pluck('edited_by_id'));

        if ($this->includeParent) {
            foreach ($comments as $comment) {
                if ($comment->parent !== null) {
                    $userIds[] = $comment->parent->user_id;
                }
            }
        }

        return User::whereIn('user_id', $userIds)->get();
    }
}
