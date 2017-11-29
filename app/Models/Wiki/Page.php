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
use Carbon\Carbon;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Es;

class Page
{
    // in minutes
    const REINDEX_AFTER = 300;
    const VERSION = 1;

    public $locale;
    public $requestedLocale;

    private $cache = [];
    private $defaultTitle;
    private $defaultSubtitle;

    public static function cleanupPath($path)
    {
        return strtolower(str_replace(['-', '/', '_'], ' ', $path));
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
                    ['constant_score' => [
                        'boost' => 1000,
                        'query' => [
                            'match' => [
                                'locale' => $params['locale'] ?? App::getLocale(),
                            ],
                        ],
                    ]],
                    ['constant_score' => [
                        'query' => [
                            'match' => [
                                'locale' => config('app.fallback_locale'),
                            ],
                        ],
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
            'index' => config('osu.elasticsearch.index').':wiki_pages_20171130',
            'type' => 'wiki_page',
        ], $params);
    }

    public static function searchParams($params)
    {
        $params['query'] = presence($params['query'] ?? null);
        $params['limit'] = clamp($params['limit'] ?? 50, 1, 50);
        $params['page'] = max(1, $params['page'] ?? 1);
        $params['locale'] = $params['locale'] ?? null;

        return $params;
    }

    public static function searchPath($path, $locale)
    {
        $searchPath = static::cleanupPath($path);

        $params = static::searchIndexConfig();
        $params['_source'] = 'path';
        $params['size'] = 10;
        $params['body']['query']['bool']['must'][] = [
            'match' => [
                'path_clean' => es_query_and_words($searchPath),
            ],
        ];
        $params['body']['query']['bool']['must'][] = [
            'match' => [
                'locale' => $locale,
            ],
        ];

        $results = Es::search($params)['hits']['hits'];

        if (count($results) === 0) {
            return;
        }

        foreach ($results as $result) {
            $resultPath = static::cleanupPath($result['_source']['path']);

            if ($resultPath === $searchPath) {
                return $result['_source']['path'];
            }
        }
    }

    public function __construct($path, $locale, $esCache = null)
    {
        if ($esCache !== null) {
            $path = $esCache['path'];
            $locale = $esCache['locale'];
            $this->cache['page'] = json_decode($esCache['page'], true);
        }

        $this->path = OsuWiki::cleanPath($path);
        $this->requestedLocale = $locale;
        $this->locale = $locale;

        $defaultTitles = explode('/', str_replace('_', ' ', $this->path));
        $this->defaultTitle = array_pop($defaultTitles);
        $this->defaultSubtitle = array_pop($defaultTitles);
    }

    public function editUrl()
    {
        return 'https://github.com/'.OsuWiki::USER.'/'.OsuWiki::REPOSITORY.'/tree/master/wiki/'.$this->pagePath();
    }

    public function indexAdd($page)
    {
        $params = static::searchIndexConfig();

        if ($page === null) {
            $params['body'] = [
                'locale' => null,
                'path' => null,
                'path_clean' => null,
                'page_text' => null,
                'page' => null,
            ];
        } else {
            $params['body'] = [
                'locale' => $this->locale,
                'path' => $this->path,
                'path_clean' => static::cleanupPath($this->path),
                'page_text' => replace_tags_with_spaces($page['output']),
                'page' => json_encode($page),
            ];
        }

        $params['id'] = $this->pagePath();
        $params['body']['indexed_at'] = json_time(Carbon::now());
        $params['body']['version'] = static::VERSION;

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

    public function isOutdated()
    {
        return $this->page()['header']['outdated'] ?? false;
    }

    public function page()
    {
        if (!array_key_exists('page', $this->cache)) {
            foreach (array_unique([$this->requestedLocale, config('app.fallback_locale')]) as $locale) {
                $this->locale = $locale;

                $config = static::searchIndexConfig([
                    '_source' => ['page', 'indexed_at', 'version'],
                    'body' => [
                        'query' => [
                            'term' => [
                                '_id' => $this->pagePath(),
                            ],
                        ],
                    ],
                ]);

                try {
                    $search = Es::search($config)['hits']['hits'];
                } catch (Missing404Exception $e) {
                    // hopefully just the index not yet created
                }

                $page = null;
                $fetch = true;

                if (isset($search) && count($search) > 0) {
                    $result = $search[0]['_source'];
                    $expired = Carbon
                        ::parse($result['indexed_at'])
                        ->addMinutes(static::REINDEX_AFTER)
                        ->isPast();
                    $wrongVersion = $result['version'] !== static::VERSION;
                    $fetch = $expired || $wrongVersion;

                    if (!$fetch) {
                        $pageString = $search[0]['_source']['page'] ?? null;
                        $page = json_decode($pageString, true);
                    }
                }

                if ($fetch) {
                    try {
                        $body = OsuWiki::fetchContent('wiki/'.$this->pagePath());
                    } catch (GitHubNotFoundException $_e) {
                        $body = null;
                    }

                    if (present($body)) {
                        $page = OsuMarkdownProcessor::process($body, [
                            'path' => route('wiki.show', $this->path),
                        ]);
                    }

                    $this->indexAdd($page);
                }

                if ($page !== null) {
                    break;
                }
            }

            $this->cache['page'] = $page;
        }

        return $this->cache['page'];
    }

    public function pagePath()
    {
        return $this->path.'/'.$this->locale.'.md';
    }

    public function refresh()
    {
        return $this->indexRemove();
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
