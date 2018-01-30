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

namespace App\Libraries;

use App\Libraries\Elasticsearch\SearchResults;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use Carbon\Carbon;
use Es;

class ForumSearch
{
    public static function buildQuery(string $queryString, string $bool = 'must', ?string $type = null)
    {
        $query = [
            'bool' => [
                $bool => [
                    ['query_string' => [
                        'fields' => ['post_preview', 'title'],
                        'query' => $queryString,
                    ]],
                ],
            ]
        ];

        if ($type !== null) {
            $query['bool']['filter'] = [
                ['term' => ['type' => $type]],
            ];
        }

        return $query;
    }

    public static function hasChildQuery($source = ['topic_id', 'post_id', 'post_preview'])
    {
        return [
            'type' => 'posts',
            'score_mode' => 'max',
            'inner_hits' => [
                '_source' => $source,
                'highlight' => [
                    'fields' => [
                        'post_preview' => new \stdClass(),
                    ],
                ],
            ],
        ];
    }

    public static function scoringFunctions()
    {
        return [
            [
                'linear' => [
                    'post_time' => [
                        'origin' => Carbon::now()->toIso8601String(),
                        'scale' => '30d',
                        'offset' => '30d',
                        'decay' => '0.99',
                    ],
                ],
            ],
        ];
    }


    public static function search($queryString, array $options = [])
    {
        // FIXME: extract all the page-limit mapping junk away
        $page = max(1, $options['page'] ?? 1);
        $size = clamp($options['size'] ?? $options['limit'] ?? 50, 1, 50);
        $from = ($page - 1) * $size;

        $query = static::buildQuery($queryString, 'should', 'topics');
        $query['bool']['minimum_should_match'] = 1;

        $childQuery = static::hasChildQuery();
        $innerQuery = static::buildQuery($queryString, 'must');

        $query['bool']['should'][] = [
            'has_child' => array_merge($childQuery, ['query' => $innerQuery]),
        ];

        $body = [
            'highlight' => ['fields' => ['title' => new \stdClass()]],
            'size' => $size,
            'from' => $from,
            'query' => $query,
        ];



        return [
            new SearchResults(
                Es::search([
                    'index' => Post::esIndexName(),
                    'body' => $body,
                ]),
                'posts'
            ),
            ['limit' => $size, 'page' => $page],
        ];
    }
}
