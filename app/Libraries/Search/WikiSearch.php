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
            $params ?? new WikiSearchParams,
            Page::class
        );

        $this->highlight(
            (new Highlight)
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

        return (new BoolQuery)
            ->must($visibilityQuery)
            ->must($langQuery)
            ->must($matchQuery);
    }
}
