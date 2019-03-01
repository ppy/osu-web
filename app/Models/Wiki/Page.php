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

namespace App\Models\Wiki;

use App;
use App\Exceptions\GitHubNotFoundException;
use App\Jobs\EsDeleteDocument;
use App\Jobs\EsIndexDocument;
use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\Es;
use App\Libraries\Markdown\OsuMarkdown;
use App\Libraries\OsuWiki;
use App\Libraries\Search\BasicSearch;
use Carbon\Carbon;
use Exception;
use Log;
use Sentry;

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

    private $source; // source document from elasticsearch;

    public static function cleanupPath($path)
    {
        return strtolower(str_replace(['-', '/', '_'], ' ', $path));
    }

    public static function searchIndexConfig($params = [])
    {
        return array_merge([
            'index' => config('osu.elasticsearch.index.wiki_pages'),
            'type' => 'wiki_page',
        ], $params);
    }

    public static function searchPath($path, $locale)
    {
        $searchPath = static::cleanupPath($path);

        $localeQuery = [
            ['constant_score' => [
                'boost' => 1000,
                'filter' => [
                    'match' => [
                        'locale' => $locale ?? App::getLocale(),
                    ],
                ],
            ]],
            ['constant_score' => [
                'filter' => [
                    'match' => [
                        'locale' => config('app.fallback_locale'),
                    ],
                ],
            ]],
        ];

        $query = (new BoolQuery())
            ->must(['match' => ['path_clean' => es_query_and_words($searchPath)]])
            ->should($localeQuery)
            ->shouldMatch(1);

        $search = (new BasicSearch(config('osu.elasticsearch.index.wiki_pages'), 'wiki_searchpath'))
            ->source('path')
            ->query($query);

        $response = $search->response();

        if ($response->total() === 0) {
            return;
        }

        foreach ($response as $hit) {
            $resultPath = static::cleanupPath($hit->source('path'));

            if ($resultPath === $searchPath) {
                return $hit->source('path');
            }
        }
    }

    public function __construct($path, $locale, $esCache = null)
    {
        $this->source = $esCache;
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

    public function esIndexDocument()
    {
        $params = static::searchIndexConfig();

        if ($this->page() === null) {
            $this->log('index document empty');

            $params['body'] = [
                'locale' => null,
                'page' => null,
                'page_text' => null,
                'path' => null,
                'path_clean' => null,
                'title' => null,
                'tags' => [],
            ];
        } else {
            $this->log('index document');

            $content = $this->getContent();
            $indexContent = (new OsuMarkdown('wiki', [
                'relative_url_root' => wiki_url($this->path),
            ]))->load($content)->toIndexable();

            $params['body'] = [
                'locale' => $this->locale,
                'page' => json_encode($this->page()),
                'page_text' => $indexContent,
                'path' => $this->path,
                'path_clean' => static::cleanupPath($this->path),
                'title' => $this->title(),
                'tags' => $this->tags(),
            ];
        }

        $params['id'] = $this->pagePath();
        $params['body']['indexed_at'] = json_time(Carbon::now());
        $params['body']['version'] = static::VERSION;

        return Es::getClient()->index($params);
    }

    public function esDeleteDocument()
    {
        $this->log('delete document');

        return Es::getClient()->delete(static::searchIndexConfig([
            'id' => $this->pagePath(),
            'client' => ['ignore' => 404],
        ]));
    }

    /**
     * Gets the markdown content for the page from Github.
     *
     * @param bool $force Force any cached value to refresh.
     * @return string|null
     */
    public function getContent(bool $force = false)
    {
        $key = "content_{$this->locale}";
        if (!array_key_exists($key, $this->cache) || $force) {
            try {
                $this->log('fetch');

                $this->cache[$key] = OsuWiki::fetchContent('wiki/'.$this->pagePath());
            } catch (GitHubNotFoundException $e) {
                $this->log('not found');

                $this->cache[$key] = null;
            }
        }

        return $this->cache[$key];
    }

    public function getSource()
    {
        return $this->source;
    }

    public function isOutdated()
    {
        return $this->page()['header']['outdated'] ?? false;
    }

    public function isLegalTranslation()
    {
        return $this->locale !== config('app.fallback_locale')
            && ($this->page()['header']['legal'] ?? false);
    }

    public function page()
    {
        if (!array_key_exists('page', $this->cache)) {
            foreach (array_unique([$this->requestedLocale, config('app.fallback_locale')]) as $locale) {
                $this->locale = $locale;

                $response = (new BasicSearch(config('osu.elasticsearch.index.wiki_pages'), 'wiki_page_lookup'))
                    ->source(['page', 'indexed_at', 'version'])
                    ->query([
                        'term' => [
                            '_id' => $this->pagePath(),
                        ],
                    ])
                    ->response();

                $page = null;
                $fetch = true;

                if ($response->total() > 0) {
                    $result = $response[0]->source();
                    $expired = Carbon
                        ::parse($result['indexed_at'])
                        ->addMinutes(static::REINDEX_AFTER)
                        ->isPast();
                    $wrongVersion = $result['version'] !== static::VERSION;
                    $fetch = $expired || $wrongVersion;

                    if (!$fetch) {
                        $pageString = $result['page'] ?? null;
                        $page = json_decode($pageString, true);
                    }
                }

                if ($fetch) {
                    try {
                        $body = $this->getContent();
                    } catch (Exception $e) {
                        $body = null;
                        $index = false;
                        log_error($e);
                    }

                    if (present($body)) {
                        $page = (new OsuMarkdown('wiki', [
                            'relative_url_root' => wiki_url($this->path),
                        ]))->load($body)->toArray();
                    }
                }

                $this->cache['page'] = $page;

                if ($fetch && ($index ?? true)) {
                    dispatch(new EsIndexDocument($this));
                }

                if ($page !== null) {
                    break;
                }
            }
        }

        return $this->cache['page'];
    }

    public function pagePath()
    {
        return $this->path.'/'.$this->locale.'.md';
    }

    public function hasParent()
    {
        return $this->parentPath() !== null
            && (new static($this->parentPath(), $this->requestedLocale))->page() !== null;
    }

    public function parentPath()
    {
        if (($pos = strrpos($this->path, '/')) !== false) {
            return substr($this->path, 0, $pos);
        }
    }

    public function refresh()
    {
        dispatch(new EsDeleteDocument($this));
    }

    public function tags()
    {
        return $this->page()['header']['tags'] ?? [];
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

    private function log($action)
    {
        $pagePath = $this->pagePath();
        $message = "wiki ({$action}): {$pagePath}";

        Log::info($message);
        Sentry::captureMessage($message, [], [
            'extra' => [
                'action' => $action,
                'pagePath' => $pagePath,
            ],
            'fingerprint' => ['wiki logging'],
            'level' => 'info',
        ]);
    }
}
