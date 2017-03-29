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

namespace App\Models;

use Cache;

class News
{
    public static function all($limit = 8)
    {
        $cache_key = "news_posts_{$limit}";
        $tumblr_token = env('TUMBLR_TOKEN');

        if (!presence($tumblr_token)) {
            return [];
        }

        if (Cache::has($cache_key)) {
            return Cache::get($cache_key);
        }

        $client = new \Tumblr\API\Client($tumblr_token);

        try {
            $posts = $client->getBlogPosts(env('TUMBLR_BLOG_NAME', 'osunews'), ['limit' => $limit])->posts;
            $posts = array_filter($posts, function ($post) {
                return
                    property_exists($post, 'id') &&
                    property_exists($post, 'body') &&
                    property_exists($post, 'title') &&
                    property_exists($post, 'date');
            });
        } catch (\Exception $e) {
            return [];
        }

        if (!empty($posts)) {
            Cache::put($cache_key, $posts, 5);
        }

        return $posts;
    }
}
