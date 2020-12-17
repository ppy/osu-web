<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App;
use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\Highlight;
use App\Libraries\Elasticsearch\RecordSearch;
use App\Models\Wiki\Page;
use App\Models\Wiki\PageSearchResult;

class WikiSearch extends RecordSearch
{
    public function __construct(?WikiSearchParams $params = null)
    {
        parent::__construct(
            Page::esIndexName(),
            $params ?? new WikiSearchParams(),
            Page::class
        );

        $this->highlight(
            (new Highlight())
                // number_of_fragments: 0 forces the entire field to be returned instead of a fragment.
                ->field('title', ['number_of_fragments' => 0])
                ->field('page_text', ['no_match_size' => 300])
                ->fragmentSize(150)
                ->numberOfFragments(5)
        );
    }

    public function records()
    {
        $response = $this->response();

        $pages = [];

        foreach ($response as $hit) {
            $page = PageSearchResult::fromEs($hit);

            $pages[] = $page;
        }

        return $pages;
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
                        'locale' => $this->params->locale ?? App::getLocale(),
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

        $matchQuery = new BoolQuery();
        if ($this->params->queryString !== null) {
            $matchQuery->shouldMatch(1)
                ->should(['match' => [
                    'tags' => [
                        'query' => $this->params->queryString,
                        'boost' => 10,
                    ],
                ]])
                ->should(['match' => [
                    'title' => [
                        'query' => $this->params->queryString,
                        'boost' => 10,
                    ],
                ]])
                ->should(['match' => [
                    'path_clean' => [
                        'query' => $this->params->queryString,
                        'boost' => 9,
                    ],
                ]]);

            if (!$this->params->isQueryStringTooShort()) {
                $matchQuery->should(['match' => [
                    'page_text' => $this->params->queryString,
                ]]);
            }
        }

        $visibilityQuery = ['exists' => ['field' => 'page']];

        return (new BoolQuery())
            ->must($visibilityQuery)
            ->must($langQuery)
            ->must($matchQuery);
    }
}
