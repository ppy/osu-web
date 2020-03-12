<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\CommentBundle;
use App\Models\NewsPost;

class NewsController extends Controller
{
    public function index()
    {
        $format = request('format');
        $isFeed = $format === 'atom' || $format === 'rss';
        $limit = $isFeed ? 20 : 12;

        $search = NewsPost::search(array_merge(['limit' => $limit], request()->all()));

        $posts = $search['query']->get();

        if ($isFeed) {
            return ext_view("news.index-{$format}", compact('posts'), $format);
        }

        $postsJson = [
            'news_posts' => json_collection($posts, 'NewsPost', ['preview']),
            'search' => $search['params'],
        ];

        if (is_json_request()) {
            return $postsJson;
        } else {
            $atom = [
                'url' => route('news.index', ['format' => 'atom']),
                'title' => 'osu!news Feed',
            ];

            return ext_view('news.index', compact('postsJson', 'atom'));
        }
    }

    public function show($slug)
    {
        if (request('key') === 'id') {
            $post = NewsPost::findOrFail($slug);

            return ujs_redirect(route('news.show', $post->slug));
        }

        $post = NewsPost::lookup($slug)->sync();

        if (!$post->isVisible()) {
            abort(404);
        }

        return ext_view('news.show', [
            'commentBundle' => CommentBundle::forEmbed($post),
            'post' => $post,
            'postJson' => json_item($post, 'NewsPost', ['content', 'navigation']),
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
}
