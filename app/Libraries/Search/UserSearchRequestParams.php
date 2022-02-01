<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\Sort;

class UserSearchRequestParams extends UserSearchParams
{
    public function __construct(array $request)
    {
        parent::__construct();

        $this->queryString = presence(trim($request['query'] ?? null));
        $this->page = get_int($request['page'] ?? null);
        $this->from = $this->pageAsFrom($this->page);
        $this->recentOnly = get_bool($request['recent_only'] ?? null);
        $this->parseSort(get_string($request['sort'] ?? null));
    }

    public function isLoginRequired(): bool
    {
        return true;
    }

    private function parseSort(?string $sortStr): void
    {
        $sortStr = $sortStr ?? '';

        $options = explode('_', $sortStr);
        $field = $options[0];
        $order = $options[1] ?? null;

        if (!in_array($field, static::VALID_SORT_FIELDS, true)) {
            $field = static::DEFAULT_SORT_FIELD;
        }

        if (!in_array($order, ['asc', 'desc'], true)) {
            $order = static::defaultSortOrder($field);
        }

        $lastvisitOrder = $order;
        switch ($field) {
            case 'username':
                $this->sorts[] = new Sort('username.raw', $order);
                $lastvisitOrder = $order === 'desc' ? 'asc' : 'desc';
                break;
            default:
                $this->sorts[] = new Sort('_score', $order);
        }

        $this->sorts[] = new Sort('user_lastvisit', $lastvisitOrder);

        $this->sortField = $field;
        $this->sortOrder = $order;
    }
}
