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
use App\Models\CommentVote;
use App\Models\User;

class CommentBundle
{
    const DEFAULT_PAGE = 1;
    const DEFAULT_LIMIT = 50;
    const DEFAULT_SORT = 'new';

    const SORTS = [
        'new' => ['order' => 'DESC', 'columns' => ['created_at', 'id']],
        'old' => ['order' => 'ASC', 'columns' => ['created_at', 'id']],
        'top' => ['order' => 'DESC', 'columns' => ['votes_count_cache', 'created_at', 'id']],
    ];

    public $depth;
    public $filterByParentId;
    public $includeCommentableMeta;
    public $includeParent;
    public $params;

    private $commentable;
    private $comments;
    private $lastLoadedId;
    private $user;

    public function __construct($commentable, $options = [])
    {
        $this->commentable = $commentable;

        $this->params = [
            'parent_id' => null,
            'cursor' => [
                'created_at' => null,
                'id' => null,
                'votes_count' => null,
            ],
            'limit' => static::DEFAULT_LIMIT,
            'page' => static::DEFAULT_PAGE,
            'sort' => static::DEFAULT_SORT,
        ];
        $this->setParams($options['params'] ?? []);

        $this->comments = $options['comments'] ?? null;
        $this->additionalComments = $options['additionalComments'] ?? [];
        $this->depth = $options['depth'] ?? 2;
        $this->filterByParentId = $options['filterByParentId'] ?? true;
        $this->includeCommentableMeta = $options['includeCommentableMeta'] ?? false;
        $this->includeParent = $options['includeParent'] ?? false;
        $this->user = $options['user'] ?? auth()->user();
    }

    public function toArray()
    {
        $hasMore = false;

        if (isset($this->comments)) {
            $comments = $this->comments;
        } else {
            $comments = $this->getComments($this->commentsQuery(), false);

            if ($comments->count() > $this->params['limit']) {
                $hasMore = true;
                $comments->pop();
            }

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

        $comments = $comments->concat($this->additionalComments);

        $result = [
            'comments' => json_collection($comments, 'Comment', $this->commentIncludes()),
            'has_more' => $hasMore,
            'has_more_id' => $this->params['parent_id'],
            'user_votes' => $this->getUserVotes($comments),
            'users' => json_collection($this->getUsers($comments), 'UserCompact'),
        ];

        if ($this->params['parent_id'] === null && $this->filterByParentId) {
            $result['top_level_count'] = $this->commentsQuery()->whereNull('parent_id')->count();
        }

        if ($this->includeCommentableMeta) {
            $commentables = $comments->pluck('commentable')->concat([null]);
            $result['commentable_meta'] = json_collection($commentables, 'CommentableMeta');
        }

        return $result;
    }

    public function commentIncludes()
    {
        $includes = [];

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
        if (array_key_exists('cursor', $input) && is_array($input['cursor'])) {
            if (array_key_exists('created_at', $input['cursor'])) {
                $this->params['cursor']['created_at'] = parse_time_to_carbon(get_string($input['cursor']['created_at']));
            }
            if (array_key_exists('id', $input['cursor'])) {
                $this->params['cursor']['id'] = get_int($input['cursor']['id']);
            }
            if (array_key_exists('votes_count', $input['cursor'])) {
                $this->params['cursor']['votes_count'] = get_int($input['cursor']['votes_count']);
            }
        }
        if (array_key_exists('limit', $input)) {
            $this->params['limit'] = clamp(get_int($input['limit']), 1, 100);
        }
        if (array_key_exists('page', $input)) {
            $this->params['page'] = max(get_int($input['page']), 1);
        }
        if (array_key_exists($input['sort'] ?? null, static::SORTS)) {
            $this->params['sort'] = $input['sort'];
        }
    }

    public function getParams()
    {
        $params = [];

        if ($this->params['cursor']['created_at'] !== null) {
            $params['cursor']['created_at'] = json_time($this->params['cursor']['created_at']);
        }
        if ($this->params['cursor']['id'] !== null) {
            $params['cursor']['id'] = $this->params['cursor']['id'];
        }
        if ($this->params['cursor']['votes_count'] !== null) {
            $params['cursor']['votes_count'] = $this->params['cursor']['votes_count'];
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

        if ($this->params['sort'] !== static::DEFAULT_SORT) {
            $params['sort'] = $this->params['sort'];
        }

        return $params;
    }

    private function getComments($query, $isChildren = true)
    {
        $sort = static::SORTS[$this->params['sort']];
        $queryLimit = $this->params['limit'];

        if (!$isChildren) {
            if ($this->filterByParentId) {
                $query->where(['parent_id' => $this->params['parent_id']]);
            }

            $queryLimit++;
            $values = [];

            foreach ($sort['columns'] as $column) {
                $key = $column === 'votes_count_cache' ? 'votes_count' : $column;
                $value = $this->params['cursor'][$key];
                if (isset($value)) {
                    $values[$column] = $value;
                }
            }

            if (count($values) > 0 && count($values) === count($sort['columns'])) {
                $direction = $sort['order'] === 'DESC' ? '<' : '>';
                $key = implode(',', $sort['columns']);
                foreach ($values as $value) {
                    $bindingKeys[] = '?';
                    $bindingValues[] = $value;
                }
                $bindingKey = implode(',', $bindingKeys);

                $query->whereRaw("({$key}) {$direction} ({$bindingKey})", $bindingValues);
            } else {
                $query->offset($this->params['limit'] * ($this->params['page'] - 1));
            }
        }

        if ($this->includeCommentableMeta) {
            $query->with('commentable');
        }

        if ($this->includeParent) {
            $query->with('parent');
        }

        foreach ($sort['columns'] as $column) {
            $query->orderBy($column, $sort['order']);
        }

        return $query->limit($queryLimit)->get();
    }

    private function getUserVotes($comments)
    {
        if ($this->user === null) {
            return [];
        }

        $ids = $comments->pluck('id');

        return CommentVote::where(['user_id' => $this->user->getKey()])
            ->whereIn('comment_id', $ids)
            ->pluck('comment_id');
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
