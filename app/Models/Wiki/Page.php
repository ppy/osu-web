<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Wiki;

use App\Exceptions\GitHubNotFoundException;
use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\Es;
use App\Libraries\Elasticsearch\QueryHelper;
use App\Libraries\Elasticsearch\Sort;
use App\Libraries\LocaleMeta;
use App\Libraries\Markdown\OsuMarkdown;
use App\Libraries\OsuWiki;
use App\Libraries\Search\BasicSearch;
use App\Libraries\Wiki\MainPageRenderer;
use App\Libraries\Wiki\MarkdownRenderer;
use App\Models\Elasticsearch\WikiPageTrait;
use Carbon\Carbon;
use Exception;
use Log;

class Page implements WikiObject
{
    use WikiPageTrait;

    const CACHE_DURATION = 5 * 60 * 60;
    const VERSION = 9;

    const TEMPLATES = [
        'markdown_page' => 'wiki.show',
        'main_page' => 'wiki.main',
    ];

    const RENDERERS = [
        'markdown_page' => MarkdownRenderer::class,
        'main_page' => MainPageRenderer::class,
    ];

    public $locale;
    public $path;
    public $requestedLocale;

    private $defaultSubtitle;
    private $defaultTitle;
    private $source;
    private $page;
    private $parent = false;

    public static function cleanupPath($path)
    {
        return strtolower(str_replace(['-', '/', '_'], ' ', $path));
    }

    public static function fromEs($hit)
    {
        $source = $hit->source();
        $path = $source['path'];
        $locale = $source['locale'];

        if ($path === null || $locale === null) {
            $pagePath = static::parsePagePath($hit['_id']);

            $path = $pagePath['path'];
            $locale = $pagePath['locale'];
        }

        $page = new static($path, $locale);
        $page->setSource($source);

        return $page;
    }

    public static function lookup($path, $locale, $requestedLocale = null)
    {
        $page = new static($path, $locale, $requestedLocale);
        $page->esFetch();

        return $page;
    }

    public static function lookupForController($path, $locale)
    {
        $page = static::lookup($path, $locale)->sync();

        if (!$page->isVisible() && $page->isTranslation()) {
            $page = static::lookup($path, config('app.fallback_locale'), $locale)->sync();
        }

        return $page;
    }

    public static function parsePagePath($pagePath)
    {
        $matches = null;
        preg_match('#^(?<path>.+)/(?<locale>[^/]+)\.md$#', $pagePath, $matches);

        return [
            'path' => $matches['path'] ?? null,
            'locale' => $matches['locale'] ?? null,
        ];
    }

    public static function searchPath($path, $locale)
    {
        $searchPath = static::cleanupPath($path);

        $currentLocaleQuery =
            ['constant_score' => [
                'boost' => 1000,
                'filter' => [
                    'match' => [
                        'locale' => $locale ?? app()->getLocale(),
                    ],
                ],
            ]];

        $fallbackLocaleQuery =
            ['constant_score' => [
                'filter' => [
                    'match' => [
                        'locale' => config('app.fallback_locale'),
                    ],
                ],
            ]];

        $query = (new BoolQuery())
            ->must(QueryHelper::queryString($searchPath, ['path_clean'], 'and'))
            ->must(['exists' => ['field' => 'page']])
            ->should($currentLocaleQuery)
            ->should($fallbackLocaleQuery)
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

    public function __construct($path, $locale, $requestedLocale = null)
    {
        $this->path = OsuWiki::cleanPath($path);
        $this->locale = $locale;
        $this->requestedLocale = $requestedLocale ?? $locale;

        $defaultTitles = explode('/', str_replace('_', ' ', $this->path));
        $this->defaultTitle = array_pop($defaultTitles);
        $this->defaultSubtitle = array_pop($defaultTitles);
    }

    public function otherLocales()
    {
        if (!$this->isVisible()) {
            return [];
        }

        $query = (new BoolQuery())
            ->must(['term' => ['path.keyword' => $this->path]])
            ->must(['exists' => ['field' => 'page']]);
        $search = (new BasicSearch(static::esIndexName(), 'wiki_searchlocales'))
            ->source('locale')
            ->sort(new Sort('locale.keyword', 'asc'))
            ->query($query);
        $response = $search->response();

        $locales = [];
        foreach ($response->hits() as $hit) {
            $locale = $hit['_source']['locale'] ?? null;
            if ($locale !== null && $locale !== $this->locale && LocaleMeta::isValid($locale)) {
                $locales[] = $locale;
            }
        }

        return $locales;
    }

    public function editUrl()
    {
        return 'https://github.com/'.OsuWiki::user().'/'.OsuWiki::repository().'/tree/'.OsuWiki::branch().'/wiki/'.$this->pagePath();
    }

    public function esDeleteDocument(array $options = [])
    {
        $this->log('delete document');

        return Es::getClient()->delete([
            'client' => ['ignore' => 404],
            'id' => $this->pagePath(),
            'index' => $options['index'] ?? static::esIndexName(),
            'type' => '_doc',
        ]);
    }

    public function esIndexDocument(array $options = [])
    {
        if ($this->page === null) {
            $this->log('index document empty');
        } else {
            $this->log('index document');
        }

        return Es::getClient()->index([
            'body' => $this->source,
            'id' => $this->pagePath(),
            'index' => $options['index'] ?? static::esIndexName(),
            'type' => '_doc',
        ]);
    }

    public function esFetch()
    {
        $response = (new BasicSearch(static::esIndexName(), 'wiki_page_lookup'))
            ->source(['markdown', 'page', 'indexed_at', 'version'])
            ->query([
                'term' => [
                    '_id' => $this->pagePath(),
                ],
            ])
            ->response();

        if ($response->total() > 0) {
            $this->setSource($response[0]->source());
        }
    }

    public function get()
    {
        return $this->page;
    }

    public function getMarkdown()
    {
        return $this->source['markdown'] ?? null;
    }

    public function hasParent()
    {
        return $this->parent() !== null;
    }

    public function needsCleanup(): bool
    {
        return $this->page['header']['needs_cleanup'] ?? false;
    }

    public function parent()
    {
        if ($this->parent === false) {
            $parentPath = $this->parentPath();

            if ($parentPath === null) {
                $parent = null;
            } else {
                $parent = static::lookup($this->parentPath(), $this->requestedLocale);

                if (!$parent->isVisible()) {
                    $parent = null;
                }
            }

            $this->parent = $parent;
        }

        return $this->parent;
    }

    public function isLegalTranslation(): bool
    {
        return $this->isTranslation()
            && ($this->page['header']['legal'] ?? false);
    }

    public function isOutdated(): bool
    {
        return $this->page['header']['outdated'] ?? false;
    }

    public function isTranslation(): bool
    {
        return $this->locale !== config('app.fallback_locale');
    }

    public function isVisible()
    {
        return $this->page !== null;
    }

    public function layout($layout = null)
    {
        $layout = presence($layout)
            ?? presence($this->page['header']['layout'] ?? null)
            ?? 'markdown_page';

        if (!array_key_exists($layout, static::RENDERERS)) {
            throw new Exception('Invalid wiki page type');
        }

        return $layout;
    }

    public function needsSync()
    {
        return $this->source === null
            || Carbon::parse($this->source['indexed_at'])
                ->addSeconds(static::CACHE_DURATION)
                ->isPast()
            || $this->source['version'] !== static::VERSION;
    }

    public function pagePath()
    {
        return $this->path.'/'.$this->locale.'.md';
    }

    public function parentPath()
    {
        if (($pos = strrpos($this->path, '/')) !== false) {
            return substr($this->path, 0, $pos);
        }
    }

    public function setSource($source)
    {
        $this->source = $source;
        $page = $source['page'] ?? null;

        if ($page !== null) {
            $this->page = json_decode($source['page'], true);
        }
    }

    public function subtitle()
    {
        if ($this->page === null) {
            return;
        }

        if ($this->parent() !== null) {
            return $this->parent()->title();
        }

        return presence($this->page['header']['subtitle'] ?? null) ?? $this->defaultSubtitle;
    }

    public function sync($force = false, $indexName = null)
    {
        if (!$force && !$this->needsSync()) {
            return $this;
        }

        try {
            $this->log('fetch');

            $content = OsuWiki::fetchContent('wiki/'.$this->pagePath());
        } catch (GitHubNotFoundException $e) {
            $this->log('not found');
        } catch (Exception $e) {
            // log and do nothing
            log_error($e);

            return $this;
        }

        $source = [
            'locale' => $this->locale,
            'page' => null,
            'page_text' => null,
            'path' => $this->path,
            'path_clean' => static::cleanupPath($this->path),
            'tags' => [],
            'title' => null,
            'indexed_at' => json_time(now()),
            'version' => static::VERSION,
        ];

        if (isset($content)) {
            $layout = OsuMarkdown::parseYamlHeader($content)['header']['layout'] ?? null;
            $layout = $this->layout($layout);
            $rendererClass = static::RENDERERS[$layout];
            $contentRenderer = (new $rendererClass($this, $content));

            $this->page = $contentRenderer->render();
            $pageIndex = $contentRenderer->renderIndexable();

            $source['markdown'] = $content;
            $source['page'] = json_encode($this->page);
            $source['page_text'] = $pageIndex;
            $source['title'] = strip_tags($this->title());
            $source['tags'] = $this->tags();
            $source['layout'] = $layout;
        }

        $this->source = $source;
        $this->esIndexDocument(['index' => $indexName]);

        return $this;
    }

    public function tags()
    {
        return $this->page['header']['tags'] ?? [];
    }

    public function template()
    {
        return $this->page === null
            ? static::TEMPLATES['markdown_page']
            : static::TEMPLATES[$this->layout()];
    }

    public function title($withSubtitle = false)
    {
        if ($this->page === null) {
            return trans('wiki.show.missing_title');
        }

        $title = presence($this->page['header']['title'] ?? null) ?? $this->defaultTitle;

        if ($withSubtitle && present($this->subtitle())) {
            $title = $this->subtitle().' / '.$title;
        }

        return $title;
    }

    private function log($action)
    {
        Log::info("wiki ({$action}): {$this->pagePath()}");
    }
}
