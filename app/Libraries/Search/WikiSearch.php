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

use App;
use App\Libraries\Elasticsearch\RecordSearch;
use App\Libraries\Elasticsearch\Query;
use App\Models\Wiki\Page;

class WikiSearch extends RecordSearch
{
    public function records()
    {
        $response = $this->response();

        $pages = [];

        foreach ($response->hits() as $hit) {
            $page = new Page(null, null, $hit['_source']);

            $pages[] = $page;
        }

        return $pages;
    }

    public static function search($rawParams, $locale = null)
    {
        $locale ?? ($locale = config('app.fallback_locale'));
        $params = static::searchParams($rawParams);
        $matchParams = [];

        if (!present($params['query'])) {
            return [];
        }

        $langQuery = (new Query())
            ->shouldMatch(1)
            ->should(['constant_score' => [
                'boost' => 1000,
                'filter' => [
                    'match' => [
                        'locale' => $params['locale'] ?? App::getLocale(),
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

        $matchQuery = (new Query())
            ->shouldMatch(1)
            ->should(['match' => [
                'tags' => [
                    'query' => $params['query'],
                    'boost' => 10,
                ],
            ]])
            ->should(['match' => [
                'title' => [
                    'query' => $params['query'],
                    'boost' => 10,
                ],
            ]])
            ->should(['match' => [
                'path_clean' => [
                    'query' => $params['query'],
                    'boost' => 9,
                ],
            ]])
            ->should(['match' => [
                'page_text' => $params['query'],
            ]]);

        $query = (new Query)->must($langQuery)->must($matchQuery);
        $search = (new static(config('osu.elasticsearch.index.wiki_pages'), Page::class))
            ->size($params['limit'])
            ->page($params['page'])
            ->query($query);

        return $search;
    }

    public static function searchParams($params)
    {
        $params['query'] = presence($params['query'] ?? null);
        $params['limit'] = clamp($params['limit'] ?? 50, 1, 50);
        $params['page'] = max(1, $params['page'] ?? 1);
        $params['locale'] = $params['locale'] ?? null;

        return $params;
    }
}
