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
use App\Libraries\Elasticsearch\HasChildQuery;
use App\Libraries\Elasticsearch\Highlight;
use App\Libraries\Elasticsearch\Hit;
use App\Libraries\Elasticsearch\Search;
use App\Libraries\Elasticsearch\SearchResponse;
use App\Libraries\Search\HasCompatibility;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ForumSearch extends Search
{
    use HasCompatibility;

    protected $includeSubforums;
    protected $queryString;
    protected $username;
    protected $forumId;

    public function __construct(array $options = [])
    {
        parent::__construct(Post::esIndexName(), $options);

        $this->queryString = $options['query'];
        $this->includeSubforums = get_bool($options['includeSubforums'] ?? false);
        $this->username = presence($options['username'] ?? null);
        $this->forumId = get_int($options['forumId'] ?? null);
        $this->topicId = get_int($options['topicId'] ?? null);
    }

    // TODO: maybe move to a response/view helper?
    public function highlightsForHit(Hit $hit)
    {
        return implode(
            ' ... ',
            $hit->highlights(
                'search_content',
                static::HIGHLIGHT_FRAGMENT_SIZE * 2
            )
        );
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

        $query = (new BoolQuery())
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

    private function childQuery() : HasChildQuery
    {
        $query = (new BoolQuery())
            ->must(['query_string' => [
                'fields' => ['search_content'],
                'query' => $this->queryString,
            ]]);

        if (isset($this->username)) {
            $user = User::lookup($this->username);
            $query->filter(['term' => ['poster_id' => $user ? $user->user_id : -1]]);
        }

        return (new HasChildQuery('posts', 'posts'))
            ->size(3)
            ->scoreMode('max')
            ->source(['topic_id', 'post_id', 'post_time', 'poster_id', 'search_content'])
            ->highlight(
                (new Highlight)
                    ->field('search_content')
                    ->fragmentSize(static::HIGHLIGHT_FRAGMENT_SIZE)
                    ->numberOfFragments(3)
            )->query($query);
    }

    private static function firstPostQuery() : HasChildQuery
    {
        return (new HasChildQuery('posts', 'first_post'))
            ->size(1)
            ->sort(['post_id' => ['order' => 'asc']])
            ->query(['match_all' => new \stdClass()])
            ->source('search_content');
    }

    public static function normalizeParams(array $params = [])
    {
        return [
            'query' => $params['query'],
            'forumId' => $params['forum_id'] ?? null,
            'topicId' => $params['topic_id'] ?? null,
            'includeSubforums' => $params['forum_children'] ?? false,
            'username' => $params['username'] ?? null,
        ];
    }

    public static function search(array $params)
    {
        $options = $this->normalizeParams($params);

        return (new static($options))
            ->page($params['page'] ?? 1)
            ->size($params['size'] ?? $params['limit'] ?? 50);
    }

    public function data()
    {
        return $this->response();
    }

    public function response() : SearchResponse
    {
        return parent::response()->recordType(Topic::class)->idField('topic_id');
    }

    /**
     * Returns a Builder for a Collection of all the users that appeared in this query.
     *
     * @return Builder
     */
    public function users() : Builder
    {
        $ids = array_merge(
            $this->response()->ids('poster_id'),
            $this->response()->innerHitsIds('posts', 'poster_id')
        );

        return User::whereIn('user_id', $ids);
    }
}
