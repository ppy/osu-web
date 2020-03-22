<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

class CommentBundleParams
{
    const DEFAULT_PAGE = 1;
    const DEFAULT_LIMIT = 50;
    const DEFAULT_SORT = 'new';

    const SORTS = [
        'new' => ['created_at' => 'DESC', 'id' => 'DESC'],
        'old' => ['created_at' => 'ASC', 'id' => 'ASC'],
        'top' => ['votes_count_cache' => 'DESC', 'created_at' => 'DESC', 'id' => 'DESC'],
    ];

    public $commentableId;
    public $commentableType;
    public $parentId;
    public $cursor;
    public $limit;
    public $page;
    public $sort;

    public function __construct($params, $user)
    {
        $this->parentId = null;
        $this->cursor = [
            'createdAt' => null,
            'id' => null,
            'votesCount' => null,
        ];
        $this->limit = static::DEFAULT_LIMIT;
        $this->page = static::DEFAULT_PAGE;
        $this->sort = optional($user)->profileCustomization()->comments_sort ?? static::DEFAULT_SORT;

        $this->setAll($params);
    }

    public function setAll($params)
    {
        if (array_key_exists('parent_id', $params)) {
            $this->parentId = get_int($params['parent_id']);
        }

        if (array_key_exists('cursor', $params) && is_array($params['cursor'])) {
            if (array_key_exists('created_at', $params['cursor'])) {
                $this->cursor['createdAt'] = parse_time_to_carbon(get_string($params['cursor']['created_at']));
            }
            if (array_key_exists('id', $params['cursor'])) {
                $this->cursor['id'] = get_int($params['cursor']['id']);
            }
            if (array_key_exists('votes_count', $params['cursor'])) {
                $this->cursor['votesCount'] = get_int($params['cursor']['votes_count']);
            }
        }

        if (array_key_exists('limit', $params)) {
            $this->limit = clamp(get_int($params['limit']), 1, 100);
        }

        if (array_key_exists('page', $params)) {
            $this->page = max(get_int($params['page']), 1);
        }

        if (array_key_exists($params['sort'] ?? null, static::SORTS)) {
            $this->sort = $params['sort'];
        }

        $this->commentableId = $params['commentable_id'] ?? null;
        $this->commentableType = $params['commentable_type'] ?? null;
    }

    public function filterByParentId()
    {
        return $this->parentId !== null;
    }

    public function forUrl()
    {
        $params = [
            'commentable_id' => $this->commentableId,
            'commentable_type' => $this->commentableType,
        ];

        if ($this->cursor['createdAt'] !== null) {
            $params['cursor']['created_at'] = json_time($this->cursor['createdAt']);
        }
        if ($this->cursor['id'] !== null) {
            $params['cursor']['id'] = $this->cursor['id'];
        }
        if ($this->cursor['votesCount'] !== null) {
            $params['cursor']['votes_count'] = $this->cursor['votesCount'];
        }

        if ($this->parentId !== null) {
            $params['parent_id'] = $this->parentId;
        }

        if ($this->page !== static::DEFAULT_PAGE) {
            $params['page'] = $this->page;
        }

        if ($this->limit !== static::DEFAULT_LIMIT) {
            $params['limit'] = $this->limit;
        }

        if ($this->sort !== static::DEFAULT_SORT) {
            $params['sort'] = $this->sort;
        }

        return $params;
    }

    public function sortDbOptions()
    {
        return static::SORTS[$this->sort];
    }

    public function parentIdForWhere()
    {
        return $this->parentId === 0 ? null : $this->parentId;
    }
}
