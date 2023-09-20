<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Wiki;

use App\Libraries\Elasticsearch\Hit;
use App\Libraries\Elasticsearch\Sort;
use App\Libraries\Search\BasicSearch;
use App\Models\Wiki\Page;

class WikiSitemap
{
    public $titles = []; // stores the titles
    public $sitemap = []; // stores the tree structure

    public static function allPagesSearch()
    {
        return (new BasicSearch(Page::esIndexName(), 'wiki_sitemap'))
            ->query(['exists' => ['field' => 'page']])
            ->sort(new Sort('path.keyword', 'asc'))
            ->sort(new Sort('locale.keyword', 'asc'));
    }

    public static function get()
    {
        static $default = [
            'titles' => [],
            'sitemap' => [],
        ];

        return cache_remember_mutexed('wiki:sitemap', Page::CACHE_DURATION, $default, function () {
            return (new static())->generate()->toArray();
        });
    }

    public static function expire()
    {
        cache_expire_with_fallback('wiki:sitemap');
    }

    // like array_set, but with / and no null key
    private static function arraySet(&$array, string $key, $value)
    {
        $keys = explode('/', $key);

        // phpcs:ignore
        while (count($keys) > 1) {
            $key = array_shift($keys);

            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }

    public function generate()
    {
        $cursor = ['', ''];
        while ($cursor !== null) {
            $search = static::allPagesSearch()->searchAfter(array_values($cursor));
            $response = $search->response();

            foreach ($response as $hit) {
                $this->parse($hit);
            }

            $cursor = $search->getSortCursor();
        }

        return $this;
    }

    public function toArray()
    {
        return [
            'sitemap' => $this->sitemap,
            'titles' => $this->titles,
        ];
    }

    private function parse(Hit $hit)
    {
        $page = Page::fromEs($hit);
        $key = $hit->source('locale').'/'.$hit->source('path');

        $this->titles[$key] = $page->title();

        if ($page->locale === config('app.fallback_locale')) {
            static::arraySet($this->sitemap, $page->path, null);
        }
    }
}
