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
            (new Highlight)
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

        return (new BoolQuery)
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
