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

use App\Exceptions\GitHubNotFoundException;
use App\Exceptions\GitHubTooLargeException;
use App\Libraries\OsuMarkdownProcessor;
use App\Libraries\OsuWiki;
use Cache;
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

    public static function search($params)
    {
        $params = static::searchParams($params);

        $query = es_query_and_words($params['query']);

        $searchParams = [
            'index' => config('osu.elasticsearch.index').':wiki_pages',
            'type' => 'wiki_page',
            'size' => $params['limit'],
            'from' => ($params['page'] - 1) * $params['limit'],
            'q' => $query,
        ];

        return Es::search($searchParams)['hits']['hits'];
    }

    public static function searchParams($params)
    {
        $params['query'] = $params['query'] ?? null;
        $params['limit'] = max(1, min(50, $params['limit'] ?? 50));
        $params['page'] = max(1, $params['page'] ?? 1);
        $params['user_ids'] = get_arr($params['user_ids'] ?? null, 'get_int');
        $params['forum_ids'] = get_arr($params['forum_ids'] ?? null, 'get_int');
        $params['topic_id'] = get_int($params['topic_id'] ?? null);

        return $params;
    }

    public function __construct($path, $locale)
    {
        $this->path = OsuWiki::cleanPath($path);
        $this->requestedLocale = $locale;
        $this->locale = $locale;

        $defaultTitles = explode('/', str_replace('_', ' ', $this->path));
        $this->defaultTitle = array_pop($defaultTitles);
        $this->defaultSubtitle = array_pop($defaultTitles);
    }

    public function cacheKeyLocales()
    {
        return 'wiki:page:locales:'.$this->path;
    }

    public function cacheKeyPage()
    {
        return 'wiki:page:page:'.static::cacheVersionPage().':'.$this->pagePath();
    }

    public function editUrl()
    {
        return 'https://github.com/'.OsuWiki::USER.'/'.OsuWiki::REPOSITORY.'/tree/master/wiki/'.$this->pagePath();
    }

    public function fetchLocales()
    {
        $locales = [];

        try {
            $data = OsuWiki::fetch('wiki/'.$this->path);
        } catch (GitHubNotFoundException $e) {
            return $locales;
        } catch (GitHubTooLargeException $e) {
            return $locales;
        }

        // check if it's a file, not a directory.
        if (isset($data['name'])) {
            return $locales;
        }

        foreach ($data as $entry) {
            $hasMatch = preg_match(
                '/^(\w{2}(?:-\w{2})?)\.md$/',
                $entry['name'],
                $matches
            );

            if ($hasMatch === 1) {
                $locales[] = $matches[1];
            }
        }

        return $locales;
    }

    public function indexAdd($page = null)
    {
        $params = [
            'index' => config('osu.elasticsearch.index').':wiki_pages',
            'type' => 'wiki_page',
            'id' => $this->pagePath(),
            'body' => [
                'locale' => $this->locale,
                'path' => $this->path,
                'page' => $page ?? $this->page(),
            ],
        ];

        Es::index($params);
    }

    public function locales()
    {
        if (!array_key_exists('locales', $this->cache)) {
            $this->cache['locales'] = Cache::remember(
                $this->cacheKeyLocales(),
                static::CACHE_DURATION,
                function () {
                    return $this->fetchLocales();
                }
            );
        }

        return $this->cache['locales'];
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
                            $page = OsuWiki::fetchContent('wiki/'.$this->pagePath());
                        } catch (GitHubNotFoundException $_e) {
                            $page = null;
                        }

                        // FIXME: add indexAdd/Remove accordingly.
                        if (present($page)) {
                            return OsuMarkdownProcessor::process($page, [
                                'path' => route('wiki.show', $this->path),
                            ]);
                        } else {
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
        Cache::forget($this->cacheKeyLocales());
    }

    public function title()
    {
        if ($this->page() === null) {
            return trans('wiki.show.missing_title');
        }

        return presence($this->page()['header']['title'] ?? null) ?? $this->defaultTitle;
    }

    public function subtitle()
    {
        if ($this->page() === null) {
            return;
        }

        return presence($this->page()['header']['subtitle'] ?? null) ?? $this->defaultSubtitle;
    }
}
