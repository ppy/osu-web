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
            $params ?? new UserSearchParams,
            User::class
        );
    }

    public function records()
    {
        return $this->response()->records()->with(['country', 'userProfileCustomization'])->get();
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
            ->mustNot(['term' => ['is_old' => true]])
            ->filter(['term' => ['user_warnings' => 0]])
            ->filter(['term' => ['user_type' => 0]]);

        if ($this->params->queryString !== null) {
            $query->shouldMatch(1)
                ->should(['match' => ['username.raw' => ['query' => $this->params->queryString, 'boost' => 5]]])
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

    protected function maxResults() : int
    {
        return config('osu.search.max.user');
    }
}
