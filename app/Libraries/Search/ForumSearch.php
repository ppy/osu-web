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
use App\Libraries\Elasticsearch\Sort;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ForumSearch extends Search
{
    public function __construct(ForumSearchParams $params)
    {
        parent::__construct(Post::esIndexName(), $params);
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
        $query = (new BoolQuery())
            ->must(static::firstPostQuery()->toArray())
            ->should($this->childQuery()->toArray())
            ->shouldMatch(1)
            ->filter(['term' => ['type' => 'topics']]);

        // skip the topic search if doing a username; needs a more complicated
        // query to accurately filter the results which isn't implemented yet.
        if (!isset($this->params->username) && $this->params->queryString !== null) {
            $query->should(QueryHelper::queryString($this->params->queryString, ['search_content']));
        }

        if (isset($this->params->forumId)) {
            $forumIds = $this->params->includeSubforums
                ? Forum::findOrFail($this->params->forumId)->allSubForums()
                : [$this->params->forumId];

            $query->filter(['terms' => ['forum_id' => $forumIds]]);
        }

        $this->query($query);

        return parent::toArray();
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

    private static function firstPostQuery() : HasChildQuery
    {
        return (new HasChildQuery('posts', 'first_post'))
            ->size(1)
            ->sort(new Sort('post_id', 'asc'))
            ->query(['match_all' => new \stdClass()])
            ->source('search_content');
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

    protected function getDefaultSize() : int
    {
        return 20;
    }
}
