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
use Es;

class ForumSearch
{
    public static function buildQuery(string $queryString, string $bool = 'must', ?string $type = null)
    {
        $body = [
            'query' => [
                'bool' => [
                    $bool => [
                        ['query_string' => ['query' => es_query_and_words($queryString)]],
                    ],
                ]
            ],
        ];

        if ($type !== null) {
            $body['query']['bool']['filter'] = [
                ['term' => ['type' => $type]],
            ];
        }

        return $body;
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

    public static function search($query, array $options = [])
    {
        // FIXME: extract all the page-limit mapping junk away
        $page = max(1, $options['page'] ?? 1);
        $size = clamp($options['size'] ?? $options['limit'] ?? 50, 1, 50);
        $from = ($page - 1) * $size;

        if (is_string($query)) {
            $body = static::buildQuery($query, 'should', 'topics');
            $body['query']['bool']['minimum_should_match'] = 1;
        }

        $childQuery = static::hasChildQuery();
        $body['query']['bool']['should'][] = [
            'has_child' => array_merge($childQuery, static::buildQuery($query, 'must')),
        ];

        $body['highlight'] = [
            'fields' => [
                'title' => new \stdClass(),
            ],
        ];

        $body['size'] = $size;
        $body['from'] = $from;

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
