<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
use App\Libraries\Elasticsearch\Highlight;
use App\Libraries\Elasticsearch\Hit;
use App\Libraries\Elasticsearch\QueryHelper;
use App\Libraries\Elasticsearch\Search;
use App\Libraries\Elasticsearch\SearchResponse;
use App\Libraries\Elasticsearch\Sort;
use App\Models\Forum\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

// FIXME: remove ArrayAccess after refactored
class PostSearch extends Search
{
    public function __construct(?PostSearchParams $params = null)
    {
        parent::__construct(Post::esIndexName(), $params ?? new PostSearchParams);

        $this->highlight(
            (new Highlight)
                ->field('search_content')
                ->fragmentSize(static::HIGHLIGHT_FRAGMENT_SIZE)
                ->numberOfFragments(3)
        );

        $this->sort(new Sort('post_time', 'desc'));
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
            ->filter(['term' => ['poster_id' => $this->params->userId]])
            ->filter(['term' => ['type' => 'posts']])
            ->mustNot(['term' => ['topic_id' => 0]]);

        if (isset($this->params->queryString)) {
            $query->must(QueryHelper::queryString($this->params->queryString, ['search_content']));
        }

        $query->filter(['terms' => ['forum_id' => $this->params->filteredForumIds()]]);

        return $query;
    }

    public function data()
    {
        return $this->response();
    }

    public function response(): SearchResponse
    {
        return parent::response()->recordType(Post::class)->idField('post_id');
    }

    /**
     * Returns a Builder for a Collection of all the users that appeared in this query.
     *
     * @return Builder
     */
    public function users(): Builder
    {
        $ids = $this->response()->ids('poster_id');

        return User::whereIn('user_id', $ids);
    }
}
