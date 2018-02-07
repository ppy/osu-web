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

namespace App\Models\Elasticsearch;

use App\Libraries\Elasticsearch\Search;
use App\Libraries\Elasticsearch\Query;

trait UserSearch
{
    public static function search($rawParams)
    {
        $max = config('osu.search.max.user');

        $params = [];
        $params['query'] = presence($rawParams['query'] ?? null);
        $params['limit'] = clamp(get_int($rawParams['limit'] ?? null) ?? static::SEARCH_DEFAULTS['limit'], 1, 50);
        $params['page'] = max(1, get_int($rawParams['page'] ?? 1));
        $size = $params['limit'];
        $from = ($params['page'] - 1) * $size;

        $search = static::searchUsername($params['query'], $from, $size);
        $response = $search->response()->recordType(get_called_class());

        $total = $response->total();

        return [
            'total' => min($total, Search::MAX_RESULTS), // FIXME: apply the cap somewhere more sensible?
            'over_limit' => $total > $max,
            'data' => $response->records()->get(),
            'params' => $params,
        ];
    }

    public static function searchUsername(string $username, $from, $size) : Search
    {
        return (new Search(static::esIndexName()))
            ->query(static::usernameSearchQuery($username ?? ''))
            ->from($from)
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

        return (new Query())
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
