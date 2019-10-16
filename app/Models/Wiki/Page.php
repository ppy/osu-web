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
use App\Libraries\Markdown\OsuMarkdown;
use App\Libraries\OsuWiki;
use App\Libraries\Search\BasicSearch;
use App\Traits\EsIndexable;
use Carbon\Carbon;
use Exception;
use Log;

class Page implements WikiObject
{
    use EsIndexable;

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

        $search = (new BasicSearch(static::esIndexName(), 'wiki_searchpath'))
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

    public static function esIndexName()
    {
        return config('osu.elasticsearch.prefix').'wiki_pages';
    }

    public static function esSchemaFile()
    {
        return config_path('schemas/wiki_pages.json');
    }

    public static function esType()
    {
        return 'wiki_pages';
    }

    public function getEsId()
    {
        return $this->pagePath();
    }

    public function editUrl()
    {
        return 'https://github.com/'.OsuWiki::USER.'/'.OsuWiki::REPOSITORY.'/tree/master/wiki/'.$this->pagePath();
    }

    public function toEsJson()
    {
        if ($this->get() === null) {
            $this->log('index document empty');

            $json = [
                'locale' => null,
                'page' => null,
                'page_text' => null,
                'path' => null,
                'path_clean' => null,
                'title' => null,
                'tags' => [],
                'layout' => null,
            ];
        } else {
            $this->log('index document');

            $content = $this->getContent();

            $rendererClass = $this->renderer();
            $indexContent = (new $rendererClass($this, $content))->renderIndexable();

            $json = [
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

        return array_merge($json, [
            'indexed_at' => json_time(Carbon::now()),
            'version' => static::VERSION,
        ]);
    }

    public function esDeleteDocument(array $options = [])
    {
        $this->log('delete document');

        return parent::esDeleteDocument([
            'client' => ['ignore' => 404],
        ]);
    }

    public static function esReindexAll(array $options = [], ?callable $progress = null)
    {
        $files = OsuWiki::getFileTree('wiki', true, true);

        $count = 0;

        foreach ($files as $file) {
            $file = OsuWiki::parseGitHubPath($file['path']);
            $page = new static($file['path'], $file['locale']);

            (new EsIndexDocument($page))->handle();

            if ($progress) {
                $progress(++$count);
            }
        }
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
    public function get()
    {
        if (!array_key_exists('page', $this->cache)) {
            foreach (array_unique([$this->requestedLocale, config('app.fallback_locale')]) as $locale) {
                $this->locale = $locale;

                $response = (new BasicSearch(static::esIndexName(), 'wiki_page_lookup'))
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
    public function forget()
    {
        dispatch(new EsDeleteDocument($this));
        unset($this->cache['page']);
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
