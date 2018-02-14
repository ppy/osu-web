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

use App\Libraries\Elasticsearch\HasChild;
use App\Libraries\Elasticsearch\Query;
use App\Libraries\Elasticsearch\Search;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;

class ForumSearch extends Search
{
    protected $includeSubforums;
    protected $username;
    protected $forumId;

    public function __construct(string $index, array $options = [])
    {
        parent::__construct($index, $options);

        $this->queryString = $options['query'];
        $this->includeSubforums = get_bool($options['includeSubforums'] ?? false);
        $this->username = presence($options['username'] ?? null);
        $this->forumId = get_int($options['forumId'] ?? null);
        $this->topicId = get_int($options['topicId'] ?? null);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        $match = ['query_string' => [
            'fields' => ['search_content'],
            'query' => $this->queryString,
        ]];

        $query = (new Query())
            ->must(static::firstPostQuery()->toArray())
            ->should($this->childQuery()->toArray())
            ->shouldMatch(1)
            ->filter(['term' => ['type' => 'topics']]);

        // skip the topic search if doing a username; needs a more complicated
        // query to accurately filter the results which isn't implemented yet.
        if (!isset($this->username)) {
            $query->should($match);
        }

        if (isset($this->forumId)) {
            $forumIds = $this->includeSubforums
                ? Forum::findOrFail($this->forumId)->allSubForums()
                : [$this->forumId];

            $query->filter(['terms' => ['forum_id' => $forumIds]]);
        }

        if (isset($this->topicId)) {
            $query->filter(['term' => ['topic_id' => $this->topicId]]);
        }

        $this->query($query);

        return parent::toArray();
    }

    private function childQuery() : HasChild
    {
        $query = (new Query())
            ->must(['query_string' => [
                'fields' => ['search_content'],
                'query' => $this->queryString,
            ]]);

        if (isset($this->username)) {
            $user = User::where('username', '=', $this->username)->first();
            $query->filter(['term' => ['poster_id' => $user ? $user->user_id : -1]]);
        }

        return (new HasChild('posts', 'posts'))
            ->size(3)
            ->scoreMode('max')
            ->source(['topic_id', 'post_id', 'search_content'])
            ->highlight('search_content')
            ->query($query);
    }

    private static function firstPostQuery() : HasChild
    {
        return (new HasChild('posts', 'first_post'))
            ->size(1)
            ->sort(['post_id' => ['order' => 'asc']])
            ->query(['match_all' => new \stdClass()])
            ->source('search_content');
    }

    public static function search(array $params)
    {
        $options = [
            'query' => $params['query'],
            'forumId' => $params['forum_id'] ?? null,
            'topicId' => $params['topic_id'] ?? null,
            'includeSubforums' => $params['forum_children'] ?? false,
            'username' => $params['username'] ?? null,
        ];

        $search = (new static(Post::esIndexName(), $options))
            ->page($params['page'] ?? 1)
            ->size($params['size'] ?? $params['limit'] ?? 50)
            ->highlight('search_content');

        $results = $search->response()->recordType(Topic::class)->idField('topic_id');
        $pagination = $search->getPageParams();

        return [
            'data' => $results,
            'total' => min($results->total(), static::MAX_RESULTS),
            'params' => ['limit' => $pagination['limit'], 'page' => $pagination['page']],
        ];
    }
}
