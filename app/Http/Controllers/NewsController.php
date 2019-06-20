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

namespace App\Http\Controllers;

use App\Libraries\CommentBundle;
use App\Models\NewsPost;

class NewsController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'news-';

    public function index()
    {
        $isAtom = request('format') === 'atom';
        $limit = $isAtom ? 20 : 12;

        $search = NewsPost::search(array_merge(['limit' => $limit], request()->all()));

        $posts = $search['query']->get();

        if ($isAtom) {
            return response()
                ->view('news.index-atom', compact('posts'))
                ->header('Content-Type', 'application/atom+xml');
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

            return view('news.index', compact('postsJson', 'atom'));
        }
    }

    public function show($slug)
    {
        if (request('key') === 'id') {
            $post = NewsPost::findOrFail($slug);

            return ujs_redirect(route('news.show', $post->slug));
        }

        $post = NewsPost::lookupAndSync($slug);

        if ($post === null) {
            abort(404);
        }

        return view('news.show', [
            'post' => $post,
            'postJson' => [
                'post' => json_item($post, 'NewsPost', ['content', 'navigation']),
                'comment_bundle' => CommentBundle::forEmbed($post)->toArray(),
            ],
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
