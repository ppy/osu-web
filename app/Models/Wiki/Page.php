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

namespace App\Models\Wiki;

use App;
use App\Exceptions\GitHubNotFoundException;
use App\Libraries\OsuMarkdownProcessor;
use App\Libraries\OsuWiki;
use Cache;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Es;

class Page
{
    // in minutes
    const CACHE_DURATION = 300;
    const VERSION = 1;

    public $locale;
    public $requestedLocale;

    private $cache = [];
    private $defaultTitle;
    private $defaultSubtitle;

    public static function cacheVersionPage()
    {
        return static::VERSION.'.'.OsuMarkdownProcessor::VERSION;
    }

    public static function search($rawParams, $locale = null)
    {
        $locale ?? ($locale = config('app.fallback_locale'));
        $params = static::searchParams($rawParams);
        $matchParams = [];

        if (!present($params['query'])) {
            return [];
        }

        $searchParams = static::searchIndexConfig([
            'size' => $params['limit'],
            'from' => ($params['page'] - 1) * $params['limit'],
        ]);
        $searchParams['body']['query']['bool']['must'] = [];

        $searchParams['body']['query']['bool']['must'][] = [
            'bool' => [
                'minimum_should_match' => 1,
                'should' => [
                    ['term' => [
                            'locale' => [
                                'value' => $params['locale'] ?? App::getLocale(),
                                'boost' => 1000,
                            ],
                    ]],
                    ['term' => [
                            'locale' => config('app.fallback_locale'),
                    ]],
                ],
            ],
        ];

        $query = es_query_and_words($params['query']);
        $searchParams['body']['query']['bool']['must'][] = [
            'bool' => [
                'minimum_should_match' => 1,
                'should' => [
                    ['match' => [
                        'title' => [
                            'query' => $query,
                            'boost' => 10,
                        ],
                    ]],
                    ['match' => [
                        'path_clean' => [
                            'query' => $query,
                            'boost' => 9,
                        ],
                    ]],
                    ['match' => [
                        'page_text' => $query,
                    ]],
                ],
            ],
        ];

        $results = Es::search($searchParams);

        $pages = [];

        foreach ($results['hits']['hits'] as $hit) {
            $document = $hit['_source'];
            $page = new static(null, null, $document);

            $pages[] = $page;
        }

        return [
            'data' => $pages,
            'total' => $results['hits']['total'],
            'params' => $params,
        ];
    }

    public static function searchIndexConfig($params = [])
    {
        return array_merge([
            'index' => config('osu.elasticsearch.index').':wiki_pages',
            'type' => 'wiki_page',
        ], $params);
    }

    public static function searchParams($params)
    {
        $params['query'] = presence($params['query'] ?? null);
        $params['limit'] = clamp($params['limit'] ?? 50, 1, 50);
        $params['page'] = max(1, $params['page'] ?? 1);
        $params['locale'] = $params['locale'] ?? null;
        $params['user_ids'] = get_arr($params['user_ids'] ?? null, 'get_int');
        $params['forum_ids'] = get_arr($params['forum_ids'] ?? null, 'get_int');
        $params['topic_id'] = get_int($params['topic_id'] ?? null);

        return $params;
    }

    public function __construct($path, $locale, $esCache = null)
    {
        if ($esCache !== null) {
            $path = $esCache['path'];
            $locale = $esCache['locale'];
            $this->cache['page'] = $esCache['page'];
        }

        $this->path = OsuWiki::cleanPath($path);
        $this->requestedLocale = $locale;
        $this->locale = $locale;

        $defaultTitles = explode('/', str_replace('_', ' ', $this->path));
        $this->defaultTitle = array_pop($defaultTitles);
        $this->defaultSubtitle = array_pop($defaultTitles);
    }

    public function cacheKeyPage()
    {
        return 'wiki:page:page:'.static::cacheVersionPage().':'.$this->pagePath();
    }

    public function editUrl()
    {
        return 'https://github.com/'.OsuWiki::USER.'/'.OsuWiki::REPOSITORY.'/tree/master/wiki/'.$this->pagePath();
    }

    public function indexAdd($page = null)
    {
        $page ?? ($page = $this->page());

        $params = static::searchIndexConfig([
            'id' => $this->pagePath(),
            'body' => [
                'locale' => $this->locale,
                'path' => $this->path,
                'path_clean' => str_replace(['-', '/', '_'], ' ', $this->path),
                'title' => $page['header']['title'],
                'page_text' => strip_tags($page['output']),
                'page' => $page,
            ],
        ]);

        return Es::index($params);
    }

    public function indexRemove()
    {
        try {
            return Es::delete(static::searchIndexConfig([
                'id' => $this->pagePath(),
            ]));
        } catch (Missing404Exception $_e) {
            // do nothing
        }
    }

    public function page()
    {
        if (!array_key_exists('page', $this->cache)) {
            foreach (array_unique([$this->requestedLocale, config('app.fallback_locale')]) as $locale) {
                $this->locale = $locale;

                $this->cache['page'] = Cache::remember(
                    $this->cacheKeyPage(),
                    static::CACHE_DURATION,
                    function () {
                        try {
                            $body = OsuWiki::fetchContent('wiki/'.$this->pagePath());
                        } catch (GitHubNotFoundException $_e) {
                            $body = null;
                        }

                        if (present($body)) {
                            $page = OsuMarkdownProcessor::process($body, [
                                'path' => route('wiki.show', $this->path),
                            ]);
                            $this->indexAdd($page);

                            return $page;
                        } else {
                            $this->indexRemove();

                            return [];
                        }
                    }
                );

                if (!empty($this->cache['page'])) {
                    break;
                }
            }

            if (empty($this->cache['page'])) {
                $this->cache['page'] = null;
            }
        }

        return $this->cache['page'];
    }

    public function pagePath()
    {
        return $this->path.'/'.$this->locale.'.md';
    }

    public function refresh()
    {
        Cache::forget($this->cacheKeyPage());
    }

    public function title($withSubtitle = false)
    {
        if ($this->page() === null) {
            return trans('wiki.show.missing_title');
        }

        $title = presence($this->page()['header']['title'] ?? null) ?? $this->defaultTitle;

        if ($withSubtitle && present($this->subtitle())) {
            $title = $this->subtitle().' / '.$title;
        }

        return $title;
    }

    public function subtitle()
    {
        if ($this->page() === null) {
            return;
        }

        return presence($this->page()['header']['subtitle'] ?? null) ?? $this->defaultSubtitle;
    }
}
