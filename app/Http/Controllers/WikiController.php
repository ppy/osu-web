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

namespace App\Http\Controllers;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\Highlight;
use App\Libraries\OsuWiki;
use App\Libraries\Search\BasicSearch;
use App\Libraries\WikiRedirect;
use App\Models\Wiki;
use App\Models\Wiki\Page;
use Request;

class WikiController extends Controller
{
    protected $section = 'help';
    protected $actionPrefix = 'wiki-';

    public function show($path = null)
    {
        if ($path === null) {
            return ujs_redirect(wiki_url());
        }

        if (OsuWiki::isImage($path)) {
            return $this->showImage($path);
        }

        $page = new Wiki\Page($path, $this->locale());

        if ($page->get() === null) {
            $redirectTarget = (new WikiRedirect())->resolve($path);
            if ($redirectTarget !== null && $redirectTarget !== $path) {
                return ujs_redirect(wiki_url('').'/'.ltrim($redirectTarget, '/'));
            }

            $correctPath = Wiki\Page::searchPath($path, $this->locale());
            if ($correctPath !== null && $correctPath !== $path) {
                return ujs_redirect(wiki_url($correctPath));
            }

            $status = 404;
        }

        return response()->view($page->template(), compact('page'), $status ?? 200);
    }

    public function update($path)
    {
        priv_check('WikiPageRefresh')->ensureCan();

        (new Wiki\Page($path, $this->locale()))->forget();

        return ujs_redirect(Request::getUri());
    }

    public function suggestions()
    {
        $queryString = request('query');

        $suggestions = [];

        if (presence($queryString)) {
            $langQuery = (new BoolQuery())
                ->shouldMatch(1)
                ->should(['constant_score' => [
                    'boost' => 1000,
                    'filter' => [
                        'match' => [
                            'locale' => $this->locale() ?? App::getLocale(),
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

            $titleQuery = (new BoolQuery())
                ->must(['match' => [
                    'title' => [
                        'query' => $queryString,
                        'operator' => 'and',
                    ],
                ]]);

            $highlight = (new Highlight())
                ->field('title', ['number_of_fragments' => 0]);

            $response = (new BasicSearch(Page::esIndexName(), 'wiki_search_suggestions'))
                ->source(['title'])
                ->highlight($highlight)
                ->query((new BoolQuery)
                    ->must($langQuery)
                    ->must($titleQuery))
                ->response();

            foreach ($response as $hit) {
                if (count($suggestions) === 10) {
                    break;
                }

                if (!in_array(strtolower($hit->source('title')), array_column($suggestions, 'clean'))) {
                    $suggestions[] = [
                        'html' => strtolower($hit->highlights('title')[0]),
                        'clean' => strtolower($hit->source('title')),
                    ];
                }
            }
        }

        return response()->json($suggestions);
    }

    private function showImage($path)
    {
        $image = (new Wiki\Image($path, Request::url(), Request::header('referer')))->get();

        session(['_strip_cookies' => true]);

        if ($image === null) {
            return response('Not found', 404);
        }

        return response($image['data'], 200)
            ->header('Content-Type', $image['type'])
            // 10 years max-age
            ->header('Cache-Control', 'max-age=315360000, public');
    }
}
