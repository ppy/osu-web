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
use App\Libraries\Elasticsearch\QueryHelper;
use App\Libraries\Elasticsearch\Search;
use App\Libraries\Elasticsearch\SearchResponse;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ForumSearch extends Search
{
    public function __construct(?ForumSearchParams $params = null)
    {
        parent::__construct(Post::esIndexName(), $params ?? new ForumSearchParams);
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
    public function getQuery()
    {
        $query = (new BoolQuery())
            ->should($this->childQuery())
            ->shouldMatch(1)
            ->filter(['term' => ['type' => 'topics']]);

        // skip the topic search if doing a username; needs a more complicated
        // query to accurately filter the results which isn't implemented yet.
        if (!isset($this->params->username) && $this->params->queryString !== null) {
            $query->should(QueryHelper::queryString($this->params->queryString, ['search_content']));
        }

        $query->filter(['terms' => ['forum_id' => $this->params->filteredForumIds()]]);

        if (isset($this->params->topicId)) {
            $query->filter(['term' => ['topic_id' => $this->params->topicId]]);
        }

        return $query;
    }

    private function childQuery() : HasChildQuery
    {
        $query = new BoolQuery();

        if ($this->params->queryString !== null) {
            $query->must(QueryHelper::queryString($this->params->queryString, ['search_content']));
        }

        if (isset($this->params->username)) {
            $user = User::lookup($this->params->username);
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

    public function data()
    {
        return $this->response();
    }

    /**
     * Returns a mapping of the topic first posts keyed by topic_id.
     *
     * @return array
     */
    public function firstPostsMap() : array
    {
        $ids = $this->response()->ids('post_id');

        $search = (new BasicSearch(Post::esIndexName(), 'forumsearch_firstposts'))
            ->size(count($ids))
            ->query(
                (new BoolQuery)
                    ->filter(['term' => ['type' => 'posts']])
                    ->filter(['terms' => ['post_id' => $ids]])
            )->source(['topic_id', 'search_content']);

        $map = [];
        foreach ($search->response() as $post) {
            $map[$post->source('topic_id')] = $post;
        }

        return $map;
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
