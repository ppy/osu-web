<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    const SEARCH_DEFAULTS = [
        'query' => null,
        'limit' => 20,
        'page' => 1,
    ];

    public static function search($rawParams)
    {
        $max = config('osu.search.max.user');

        $params = [];
        $params['query'] = presence($rawParams['query'] ?? null);
        $params['limit'] = clamp(get_int($rawParams['limit'] ?? null) ?? static::SEARCH_DEFAULTS['limit'], 1, 50);
        $params['page'] = max(1, get_int($rawParams['page'] ?? 1));

        return static::searchUsername($params['query'], $params['page'], $params['limit']);
    }

    public static function searchUsername(string $username, $page, $size) : self
    {
        return (new static(User::esIndexName(), User::class))
            ->query(static::usernameSearchQuery($username ?? ''))
            ->page($page)
            ->size($size);
    }

    public static function usernameSearchQuery(string $username)
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

        return (new BoolQuery())
            ->shouldMatch(1)
            ->should(['match' => ['username.raw' => ['query' => $username, 'boost' => 5]]])
            ->should(['multi_match' => array_merge(['query' => $username], $lowercase_stick)])
            ->should(['multi_match' => array_merge(['query' => $username], $whitespace_stick)])
            ->should(['match_phrase' => ['username._slop' => $username]])
            ->mustNot(['term' => ['is_old' => true]])
            ->filter(['term' => ['user_warnings' => 0]])
            ->filter(['term' => ['user_type' => 0]]);
    }
}
