<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\RecordSearch;
use App\Models\User;

class UserSearch extends RecordSearch
{
    public function __construct(?UserSearchParams $params = null)
    {
        parent::__construct(
            User::esIndexName(),
            $params ?? new UserSearchParams(),
            User::class
        );
    }

    public function records()
    {
        return $this->response()->records()->with(['country', 'userProfileCustomization', 'userGroups'])->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery()
    {
        static $lowercase_stick = [
            'analyzer' => 'username_lower',
            'type' => 'most_fields',
            'fields' => ['username', 'username._*'],
        ];

        static $whitespace_stick = [
            'analyzer' => 'whitespace',
            'type' => 'most_fields',
            'fields' => ['username', 'username._*'],
        ];

        $query = (new BoolQuery())
            ->mustNot(['terms' => ['_id' => $this->params->blockedUserIds()]])
            ->mustNot(['term' => ['is_old' => true]])
            ->filter(['term' => ['user_warnings' => 0]])
            ->filter(['term' => ['user_type' => 0]]);

        if ($this->params->queryString !== null) {
            $query->shouldMatch(1)
                ->should(['term' => ['_id' => ['value' => $this->params->queryString, 'boost' => 100]]])
                ->should(['match' => ['username.raw' => ['query' => $this->params->queryString, 'boost' => 5]]])
                ->should(['match' => ['previous_usernames' => ['query' => $this->params->queryString]]])
                ->should(['multi_match' => array_merge(['query' => $this->params->queryString], $lowercase_stick)])
                ->should(['multi_match' => array_merge(['query' => $this->params->queryString], $whitespace_stick)])
                ->should(['match_phrase' => ['username._slop' => $this->params->queryString]]);
        }

        if ($this->params->recentOnly) {
            $query->filter([
                'range' => [
                    'user_lastvisit' => [
                        'gte' => 'now-90d',
                    ],
                ],
            ]);
        }

        return $query;
    }

    protected function maxResults(): int
    {
        return config('osu.search.max.user');
    }
}
