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

namespace App\Http\Controllers;

use App\Models\News;
use Request;

class NewsController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'news-';

    public function index()
    {
        $page = get_int(Request::input('page'));
        $limit = get_int(Request::input('limit'));

        return view('news.index', [
            'posts' => News\Index::all($page, $limit),
        ]);
    }

    public function show($id)
    {
        $post = (new News\Post($id));

        if ($post->page() === null) {
            abort(404);
        }

        return view('news.show', compact('post'));
    }

    public function store()
    {
        priv_check('NewsIndexUpdate')->ensureCan();

        News\Index::cacheClear();

        return ['message' => trans('news.store.ok')];
    }

    public function update($id)
    {
        priv_check('NewsPostUpdate')->ensureCan();

        (new News\Post($id))->cacheClear();

        return ['message' => trans('news.update.ok')];
    }
}
