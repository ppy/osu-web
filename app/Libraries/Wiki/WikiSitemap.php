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
            ->sort(new Sort('_id', 'asc'));
    }

    public static function get()
    {
        static $default = [
            'titles' => [],
            'sitemap' => [],
        ];

        return cache_remember_mutexed('wiki:sitemap', Page::CACHE_DURATION, $default, function () {
            return (new static)->generate()->toArray();
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
        $cursor = [''];
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
            static::arraySet($this->sitemap, $page->path, $page->path);
        }
    }
}
