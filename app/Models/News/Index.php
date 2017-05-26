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

namespace App\Models\News;

use App\Libraries\OsuWiki;
use Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class Index
{
    const VERSION = 2;
    const CACHE_DURATION = 5;

    public static function all($page = null, $limit = null)
    {
        $page = max(1, $page ?? 1);
        $limit = clamp($limit ?? 10, 10, 50);

        $start = ($page - 1) * $limit;
        $end = $limit + $start;

        $files = static::index();

        $posts = [];

        foreach ($files as $i => $file) {
            if ($i < $start) {
                continue;
            }

            if ($i >= $end) {
                break;
            }

            if (($file['type'] ?? null) !== 'file') {
                continue;
            }

            if (!ends_with($file['name'], '.md')) {
                continue;
            }

            $posts[] = new Post(Post::nameId($file['name']), $files);
        }

        if ($start > 0) {
            $newerPosts = $page - 1;
        }

        if ($end < count($files)) {
            $olderPosts = $page + 1;
        }

        return new LengthAwarePaginator($posts, count($files), $limit, $page, [
            'path' => route('news.index'),
        ]);
    }

    public static function cacheClear()
    {
        Cache::forget(static::cacheKey());
    }

    public static function cacheKey()
    {
        return 'news:index:'.static::VERSION;
    }

    public static function index()
    {
        return Cache::remember(
            static::cacheKey(),
            static::CACHE_DURATION,
            function () {
                return array_reverse(OsuWiki::fetch('news'));
            }
        );
    }
}
