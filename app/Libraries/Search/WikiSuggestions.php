<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\Highlight;
use App\Libraries\Elasticsearch\Search;
use App\Models\Wiki\Page;

class WikiSuggestions extends Search
{
    public function __construct(WikiSuggestionsParams $params)
    {
        parent::__construct(
            Page::esIndexName(),
            $params
        );

        $this->source(['title', 'path']);
        $this->highlight(
            (new Highlight())
                ->field('title.autocomplete')
                ->numberOfFragments(0)
        );
    }

    public function data()
    {
        return $this->response();
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery()
    {
        $langQuery = (new BoolQuery())
            ->shouldMatch(1)
            ->should(['constant_score' => [
                'boost' => 1000,
                'filter' => [
                    'match' => [
                        'locale' => app()->getLocale(),
                    ],
                ],
            ]])
            ->should(['constant_score' => [
                'filter' => [
                    'match' => [
                        'locale' => config('app.fallback_locale'),
                    ],
                ],
            ]]);

        return (new BoolQuery())
            ->must($langQuery)
            ->must([
                'match' => [
                    'title.autocomplete' => [
                        'query' => $this->params->queryString,
                        'operator' => 'and',
                    ],
                ],
            ]);
    }
}
