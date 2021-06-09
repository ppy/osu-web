<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\CommentBundle;
use App\Models\NewsPost;

class NewsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public');
    }

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
