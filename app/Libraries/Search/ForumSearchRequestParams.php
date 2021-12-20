<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\Sort;

class ForumSearchRequestParams extends ForumSearchParams
{
    public function __construct(array $request)
    {
        parent::__construct();

        $this->queryString = presence(trim($request['query'] ?? null));
        $this->page = get_int($request['page'] ?? null);
        $this->from = $this->pageAsFrom($this->page);
        $this->includeSubforums = get_bool($request['forum_children'] ?? false);
        $this->username = presence(trim($request['username'] ?? null));
        $this->forumId = get_int($request['forum_id'] ?? null);
        $this->topicId = get_int($request['topic_id'] ?? null);
        $this->parseSort(get_string($request['sort'] ?? null));
    }

    public function isLoginRequired(): bool
    {
        return true;
    }

    private function parseSort(?string $sortStr): void
    {
        $options = explode('_', $sortStr ?? '');
        $field = $options[0];
        $order = $options[1] ?? null;

        if (!in_array($field, static::VALID_SORT_FIELDS, true)) {
            $field = $this->queryString === null ? 'created' : 'relevance';
        }

        if (!in_array($order, ['asc', 'desc'], true)) {
            $order = static::DEFAULT_SORT_ORDER;
        }

        switch ($field) {
            case 'created':
                // just post_id
                break;
            default:
                $field = 'relevance';
                $this->sorts[] = new Sort('_score', $order);
        }

        $this->sorts[] = new Sort('post_id', $order);
        $this->sortField = $field;
        $this->sortOrder = $order;
    }
}
