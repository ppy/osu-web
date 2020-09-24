<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        parent::__construct(Post::esIndexName(), $params ?? new ForumSearchParams());
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

    private function childQuery(): HasChildQuery
    {
        $query = new BoolQuery();

        if ($this->params->queryString !== null) {
            $query->must(QueryHelper::queryString($this->params->queryString, ['search_content']));
        }

        if (isset($this->params->username)) {
            $user = User::lookup($this->params->username);
            $query->filter(['term' => ['poster_id' => $user ? $user->user_id : -1]]);
        }

        $query->mustNot(['terms' => ['poster_id' => $this->params->blockedUserIds()]]);

        return (new HasChildQuery('posts', 'posts'))
            ->size(3)
            ->scoreMode('max')
            ->source(['topic_id', 'post_id', 'post_time', 'poster_id', 'search_content'])
            ->highlight(
                (new Highlight())
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
    public function firstPostsMap(): array
    {
        $ids = $this->response()->ids('post_id');

        $search = (new BasicSearch(Post::esIndexName(), 'forumsearch_firstposts'))
            ->size(count($ids))
            ->query(
                (new BoolQuery())
                    ->filter(['term' => ['type' => 'posts']])
                    ->filter(['terms' => ['post_id' => $ids]])
            )->source(['topic_id', 'search_content']);

        $map = [];
        foreach ($search->response() as $post) {
            $map[$post->source('topic_id')] = $post;
        }

        return $map;
    }

    public function response(): SearchResponse
    {
        return parent::response()->recordType(Topic::class)->idField('topic_id');
    }

    /**
     * Returns a Builder for a Collection of all the users that appeared in this query.
     *
     * @return Builder
     */
    public function users(): Builder
    {
        $ids = array_merge(
            $this->response()->ids('poster_id'),
            $this->response()->innerHitsIds('posts', 'poster_id')
        );

        return User::whereIn('user_id', $ids);
    }
}
