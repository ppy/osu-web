<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\CommentBundle;
use App\Models\NewsPost;

/**
 * @group News
 */
class NewsController extends Controller
{
    /**
     * Get News Listing
     *
     * Returns a list of news posts and related metadata.
     *
     * ---
     *
     * ### Response Format
     *
     * Field                     | Type                    | Notes
     * --------------------------|-------------------------|------
     * news_posts                | [NewsPost](#newspost)[] | Includes `preview`.
     * news_sidebar.current_year | number                  | Year of the first post's publish time, or current year if no posts returned.
     * news_sidebar.news_posts   | [NewsPost](#newspost)[] | All posts published during `current_year`.
     * news_sidebar.years        | number[]                | All years during which posts have been published.
     * search.limit              | number                  | Clamped limit input.
     * search.sort               | string                  | Always `published_desc`.
     * cursor                    | [Cursor](#cursor)       | |
     *
     * <aside class="notice">
     *   <a href="#newspost">NewsPost</a> collections queried by year will also include posts published in November and December of the previous year if the current date is the same year and before April.
     * </aside>
     *
     * @queryParam limit integer Maximum number of posts (12 default, 1 minimum, 21 maximum). No-example
     * @queryParam year integer Year to return posts from. No-example
     * @queryParam cursor [Cursor](#cursor) for pagination. No-example
     * @response {
     *   "news_posts": [
     *     {
     *       "id": 964,
     *       "author": "RockRoller",
     *       "edit_url": "https://github.com/ppy/osu-wiki/tree/master/news/2021-05-27-skinning-contest-results.md",
     *       "first_image": "https://i.ppy.sh/d431ff921955d5c8792dc9bae40ac082d4e53131/68747470733a2f2f6f73752e7070792e73682f77696b692f696d616765732f7368617265642f6e6577732f323032312d30352d32372d736b696e6e696e672d636f6e746573742d726573756c74732f736b696e6e696e675f636f6e746573745f62616e6e65722e6a7067",
     *       "published_at": "2021-05-27T12:00:00+00:00",
     *       "updated_at": "2021-05-28T17:11:35+00:00",
     *       "slug": "2021-05-27-skinning-contest-results",
     *       "title": "Skinning Contest: Results Out",
     *       "preview": "The ship full of skins is now back with your votes. Check out the results for our first-ever official skinning contest right here!"
     *     },
     *     // ...
     *   ],
     *   "news_sidebar": {
     *     "current_year": 2021,
     *     "news_posts": [
     *       {
     *         "id": 964,
     *         "author": "RockRoller",
     *         "edit_url": "https://github.com/ppy/osu-wiki/tree/master/news/2021-05-27-skinning-contest-results.md",
     *         "first_image": "https://i.ppy.sh/d431ff921955d5c8792dc9bae40ac082d4e53131/68747470733a2f2f6f73752e7070792e73682f77696b692f696d616765732f7368617265642f6e6577732f323032312d30352d32372d736b696e6e696e672d636f6e746573742d726573756c74732f736b696e6e696e675f636f6e746573745f62616e6e65722e6a7067",
     *         "published_at": "2021-05-27T12:00:00+00:00",
     *         "updated_at": "2021-05-28T17:11:35+00:00",
     *         "slug": "2021-05-27-skinning-contest-results",
     *         "title": "Skinning Contest: Results Out"
     *       },
     *       // ...
     *     ],
     *     "years": [2021, 2020, 2019, 2018, 2017, 2016, 2015, 2014, 2013]
     *   },
     *   "search": {
     *     "limit": 12,
     *     "sort": "published_desc"
     *   },
     *   "cursor": {
     *     "published_at": "2021-05-09T18:00:00.000000Z",
     *     "id": 953
     *   }
     * }
     */
    public function index()
    {
        $params = request()->all();
        $format = $params['format'] ?? null;
        $isFeed = $format === 'atom' || $format === 'rss';
        $limit = $isFeed ? 20 : 12;

        $search = NewsPost::search(array_merge(compact('limit'), $params));

        $posts = $search['query']->get();

        if ($isFeed) {
            return ext_view("news.index-{$format}", compact('posts'), $format);
        }

        $postsJson = [
            'news_posts' => json_collection($posts, 'NewsPost', ['preview']),
            'news_sidebar' => $this->sidebarMeta($posts[0] ?? null),
            'search' => $search['params'],
            'cursor' => $search['cursorHelper']->next($posts),
        ];

        if (is_json_request()) {
            return $postsJson;
        } else {
            return ext_view('news.index', [
                'atom' => [
                    'url' => route('news.index', ['format' => 'atom']),
                    'title' => 'osu!news Feed',
                ],
                'postsJson' => $postsJson,
            ]);
        }
    }

    /**
     * Get News Post
     *
     * Returns details of the specified news post.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns a [NewsPost](#newspost) with `content` and `navigation` included. Querying by ID will return a redirect to query by slug.
     *
     * @urlParam news string News post slug or ID. Example: 2021-04-28-new-featured-artist-emilles-moonlight-serenade
     * @queryParam key string Unset to query by slug, or `id` to query by ID. No-example
     * @response {
     *   "id": 943,
     *   "author": "pishifat",
     *   "edit_url": "https://github.com/ppy/osu-wiki/tree/master/news/2021-04-27-results-a-labour-of-love.md",
     *   "first_image": "https://i.ppy.sh/65c9c2eb2f8d9bc6008b95aba7d0ef45e1414c1e/68747470733a2f2f6f73752e7070792e73682f77696b692f696d616765732f7368617265642f6e6577732f323032302d31312d33302d612d6c61626f75722d6f662d6c6f76652f616c6f6c5f636f7665722e6a7067",
     *   "published_at": "2021-04-27T20:00:00+00:00",
     *   "updated_at": "2021-04-27T20:25:57+00:00",
     *   "slug": "2021-04-27-results-a-labour-of-love",
     *   "title": "Results - A Labour of Love",
     *   "content": "<div class='osu-md osu-md--news'>...</div>",
     *   "navigation": {
     *     "newer": {
     *       "id": 944,
     *       "author": "pishifat",
     *       "edit_url": "https://github.com/ppy/osu-wiki/tree/master/news/2021-04-28-new-featured-artist-emilles-moonlight-serenade.md",
     *       "first_image": "https://i.ppy.sh/7e22cc5f4755c21574d999d8ce3a2f40a3268e84/68747470733a2f2f6173736574732e7070792e73682f617274697374732f3136302f6865616465722e6a7067",
     *       "published_at": "2021-04-28T08:00:00+00:00",
     *       "updated_at": "2021-04-28T09:51:28+00:00",
     *       "slug": "2021-04-28-new-featured-artist-emilles-moonlight-serenade",
     *       "title": "New Featured Artist: Emille's Moonlight Serenade"
     *     },
     *     "older": {
     *       "id": 942,
     *       "author": "pishifat",
     *       "edit_url": "https://github.com/ppy/osu-wiki/tree/master/news/2021-04-24-new-featured-artist-grynpyret.md",
     *       "first_image": "https://i.ppy.sh/acdce813b71371b95e8240f9249c916285fdc5a0/68747470733a2f2f6173736574732e7070792e73682f617274697374732f3135392f6865616465722e6a7067",
     *       "published_at": "2021-04-24T08:00:00+00:00",
     *       "updated_at": "2021-04-24T10:23:59+00:00",
     *       "slug": "2021-04-24-new-featured-artist-grynpyret",
     *       "title": "New Featured Artist: Grynpyret"
     *     }
     *   }
     * }
     */
    public function show($slug)
    {
        if (request('key') === 'id') {
            $post = NewsPost::findOrFail($slug);

            $routeName = (is_api_request() ? 'api.' : '').'news.show';

            return ujs_redirect(route($routeName, $post->slug));
        }

        $post = NewsPost::lookup($slug)->sync();

        if (!$post->isVisible()) {
            abort(404);
        }

        $postJson = json_item($post, 'NewsPost', ['content', 'navigation']);

        if (is_json_request()) {
            return $postJson;
        }

        return ext_view('news.show', [
            'commentBundle' => CommentBundle::forEmbed($post),
            'post' => $post,
            'postJson' => $postJson,
            'sidebarMeta' => $this->sidebarMeta($post),
        ]);
    }

    public function store()
    {
        priv_check('NewsIndexUpdate')->ensureCan();

        NewsPost::syncAll();

        return ['message' => trans('news.store.ok')];
    }

    public function update($id)
    {
        priv_check('NewsPostUpdate')->ensureCan();

        NewsPost::findOrFail($id)->sync(true);

        return ['message' => trans('news.update.ok')];
    }

    private function sidebarMeta($post)
    {
        if ($post !== null && $post->published_at !== null) {
            $currentYear = $post->published_at->year;
        }

        $currentYear = $currentYear ?? date('Y');
        $latestPost = NewsPost::select('updated_at')->default()->first();
        $lastUpdate = $latestPost === null ? 0 : $latestPost->updated_at->timestamp;

        return cache_remember_with_fallback(
            "news_sidebar_meta_{$currentYear}_{$lastUpdate}",
            3600,
            function () use ($currentYear) {
                $years = NewsPost::selectRaw('DISTINCT YEAR(published_at) year')
                    ->whereNotNull('published_at')
                    ->orderBy('year', 'DESC')
                    ->pluck('year')
                    ->toArray();

                $posts = NewsPost::default()->year($currentYear)->get();

                return [
                    'current_year' => $currentYear,
                    'news_posts' => json_collection($posts, 'NewsPost'),
                    'years' => $years,
                ];
            }
        );
    }
}
