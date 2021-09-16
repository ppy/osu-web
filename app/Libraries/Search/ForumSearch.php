<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\BoolQuery;
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
    public static function getHighlights(Hit $hit, string $field)
    {
        $highlights = $hit->highlights($field, static::HIGHLIGHT_FRAGMENT_SIZE * 2);
        $highlightsText = implode(' ... ', $highlights);

        if ($highlightsText !== '') {
            return blade_safe($highlightsText);
        }
    }

    public function __construct(?ForumSearchParams $params = null)
    {
        parent::__construct(Post::esIndexName(), $params ?? new ForumSearchParams());

        $this->source(['topic_id', 'post_id', 'post_time', 'poster_id', 'search_content', 'topic_title']);
        $this->highlight(
            (new Highlight())
                ->field('topic_title')
                ->field('search_content')
                ->fragmentSize(static::HIGHLIGHT_FRAGMENT_SIZE)
                ->numberOfFragments(3)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery()
    {
        $query = (new BoolQuery())
            ->filter(['terms' => ['forum_id' => $this->params->filteredForumIds()]]);

        if (isset($this->params->topicId)) {
            $query->filter(['term' => ['topic_id' => $this->params->topicId]]);
        }

        if ($this->params->queryString !== null) {
            $query->must(QueryHelper::queryString($this->params->queryString, ['search_content', 'topic_title']));
        }

        if (isset($this->params->username)) {
            $user = User::lookup($this->params->username);
            $query->filter(['term' => ['poster_id' => $user ? $user->user_id : -1]]);
        }

        $query->mustNot(['terms' => ['poster_id' => $this->params->blockedUserIds()]]);

        return $query;
    }

    public function isTopicSpecificSearch()
    {
        return isset($this->params->topicId);
    }

    public function data()
    {
        return $this->response();
    }

    /**
     * Returns a Builder for a Collection of all the posts that appeared in this query.
     *
     * @return array
     */
    public function topics(): Builder
    {
        return Topic::whereIn('topic_id', $this->response()->ids('topic_id'));
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
        return User::whereIn('user_id', $this->response()->ids('poster_id'));
    }
}
