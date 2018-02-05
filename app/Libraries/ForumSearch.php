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

use App\Libraries\Elasticsearch\Query;
use App\Libraries\Elasticsearch\Search;
use App\Libraries\Elasticsearch\SearchResults;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;
use Carbon\Carbon;
use Es;

class ForumSearch extends Query
{
    protected $includeSubForums = false;

    /**
     * @return $this
     */
    public function queryString(string $queryString)
    {
        $this->queryString = $queryString;

        return $this;
    }

    /**
     * @return $this
     */
    public function byUsername(?string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return $this
     */
    public function includeSubForums(bool $flag)
    {
        $this->includeSubForums = $flag;

        return $this;
    }

    /**
     * @return $this
     */
    public function inForum(?int $forumId)
    {
        $this->forumId = $forumId;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray() : array
    {
        $query = (new Query())
            ->should(['query_string' => [
                'fields' => ['search_content'],
                'query' => $this->queryString,
            ]])
            ->filter(['term' => ['type' => 'topics']])
            ->shouldMatch(1);

        $childQuery = $this->childQuery($this->queryString, $this->forumId);
        $query->should(['has_child' => $childQuery]);

        if (isset($this->forumId)) {
            $forumIds = $this->includeSubForums
                ? Forum::findOrFail($this->forumId)->allSubForums()
                : [$this->forumId];
            $forumQuery = ['terms' => ['forum_id' => $forumIds]];

            $query->filter($forumQuery);
        }

        $query->must(['has_child' => static::firstPostQuery()]);

        return $query->toArray();
    }

    public function childQuery(string $queryString) : array
    {
        $query = (new Query())
            ->must(['query_string' => [
                'fields' => ['search_content'],
                'query' => $queryString,
            ]]);

        if (isset($this->username)) {
            $user = User::where('username', '=', $this->username)->first();
            $userQuery = ['term' => ['user_id' => $user ? $user->user_id : -1]];

            $query->filter(['term' => ['poster_id' => $user ? $user->user_id : -1]]);
        }

        return [
            'type' => 'posts',
            'score_mode' => 'max',
            'inner_hits' => [
                '_source' => ['topic_id', 'post_id', 'search_content'],
                'name' => 'posts',
                'size' => 3,
                'highlight' => [
                    'fields' => [
                        'search_content' => new \stdClass(),
                    ],
                ],
            ],
            'query' => $query->toArray(),
        ];
    }

    public static function firstPostQuery() : array
    {
        return [
            'type' => 'posts',
            'score_mode' => 'none',
            'inner_hits' => [
                '_source' => 'search_content',
                'name' => 'first_post',
                'size' => 1,
                'sort' => [['post_id' => ['order' => 'asc']]],
            ],
            'query' => ['match_all' => new \stdClass()],
        ];
    }

    public static function search(string $queryString, array $options = []) : array
    {
        $query = (new static())
            ->queryString($queryString)
            ->inForum(get_int($options['forum_id'] ?? null))
            ->includeSubForums(get_bool($options['forum_children'] ?? false))
            ->byUsername(presence($options['username'] ?? null));

        $search = (new Search(Post::esIndexName()))
            ->page($options['page'] ?? 1)
            ->size($options['size'] ?? $options['limit'] ?? 50)
            ->query($query)
            ->highlight('search_content');

        return [
            $search->results(),
            $search->getPageParams(),
        ];
    }
}
