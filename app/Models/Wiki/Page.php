<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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

class Page implements WikiObject
{
    // in minutes
    const REINDEX_AFTER = 300;
    const VERSION = 1;

    const TEMPLATES = [
        'markdown_page' => 'wiki.show',
        'main_page' => 'wiki.main',
    ];

    const RENDERERS = [
        'markdown_page' => App\Libraries\Wiki\MarkdownRenderer::class,
        'main_page' => App\Libraries\Wiki\MainPageRenderer::class,
    ];

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

        if ($this->get() === null) {
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

            $rendererClass = $this->renderer();
            $indexContent = (new $rendererClass($this, $content))->renderIndexable();

            $params['body'] = [
                'locale' => $this->locale,
                'page' => json_encode($this->get()),
                'page_text' => $indexContent,
                'path' => $this->path,
                'path_clean' => static::cleanupPath($this->path),
                'title' => strip_tags($this->title()),
                'tags' => $this->tags(),
                'layout' => $this->layout(),
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

    public function isOutdated() : bool
    {
        return $this->get()['header']['outdated'] ?? false;
    }

    public function isLegalTranslation() : bool
    {
        return $this->isTranslation()
            && ($this->get()['header']['legal'] ?? false);
    }

    public function isTranslation() : bool
    {
        return $this->locale !== config('app.fallback_locale');
    }

    /**
     * {@inheritdoc}
     */
    public function get($synchronous = false)
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
                        // prefilling the header so layout() works
                        $this->cache['page']['header'] = OsuMarkdown::parseYamlHeader($body)['header'];

                        $rendererClass = $this->renderer();

                        $page = (new $rendererClass($this, $body))->render();
                    }
                }

                $this->cache['page'] = $page;

                if ($fetch && ($index ?? true)) {
                    $job = new EsIndexDocument($this);

                    if ($synchronous) {
                        $job->handle();
                    } else {
                        dispatch($job);
                    }
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
            && (new static($this->parentPath(), $this->requestedLocale))->get() !== null;
    }

    public function parentPath()
    {
        if (($pos = strrpos($this->path, '/')) !== false) {
            return substr($this->path, 0, $pos);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function forget($synchronous = false)
    {
        unset($this->cache['page']);

        $job = new EsDeleteDocument($this);

        if ($synchronous) {
            $job->handle();
        } else {
            dispatch($job);
        }
    }

    public function tags()
    {
        return $this->get()['header']['tags'] ?? [];
    }

    public function title($withSubtitle = false)
    {
        if ($this->get() === null) {
            return trans('wiki.show.missing_title');
        }

        $title = presence($this->get()['header']['title'] ?? null) ?? $this->defaultTitle;

        if ($withSubtitle && present($this->subtitle())) {
            $title = $this->subtitle().' / '.$title;
        }

        return $title;
    }

    public function subtitle()
    {
        if ($this->get() === null) {
            return;
        }

        return presence($this->get()['header']['subtitle'] ?? null) ?? $this->defaultSubtitle;
    }

    public function layout()
    {
        if ($this->get() === null) {
            return;
        }

        return presence($this->get()['header']['layout'] ?? null) ?? 'markdown_page';
    }

    public function template()
    {
        if ($this->get() === null) {
            return static::TEMPLATES['markdown_page'];
        }

        if (!array_key_exists($this->layout(), static::TEMPLATES)) {
            throw new \Exception('Invalid wiki page type');
        }

        return static::TEMPLATES[$this->layout()];
    }

    public function renderer()
    {
        if ($this->get() === null) {
            return;
        }

        if (!array_key_exists($this->layout(), static::RENDERERS)) {
            throw new \Exception('Invalid wiki page type');
        }

        return static::RENDERERS[$this->layout()];
    }

    private function log($action)
    {
        Log::info("wiki ({$action}): {$this->pagePath()}");
    }
}
