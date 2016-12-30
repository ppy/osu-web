<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use App;
use App\Exceptions\GitHubNotFoundException;
use App\Models\WikiPage;
use Request;
use View;

class WikiController extends Controller
{
    protected $section = 'help';
    protected $actionPrefix = 'wiki-';

    public function show($path)
    {
        if (in_array(pathinfo($path, PATHINFO_EXTENSION), ['gif', 'jpeg', 'jpg', 'png'], true)) {
            try {
                return response(WikiPage::fetchImage($path, Request::url(), Request::header('referer')), 200)
                    ->header('Content-Type', 'image');
            } catch (GitHubNotFoundException $e) {
                abort(404);
            }
        }

        $pageLocale = Request::input('locale', App::getLocale());
        $page = new WikiPage($path, $pageLocale);
        $pageLocales = $page->locales();
        $titles = explode('/', str_replace('_', ' ', trim($path, '/')), 2);
        $title = array_pop($titles);
        $subtitle = array_pop($titles);

        try {
            $pageMd = $page->markdown();
        } catch (GitHubNotFoundException $e) {
            $pageMd = null;
            $status = 404;
        }

        return response()
            ->view('wiki.show', compact(
                'page',
                'pageLocale',
                'pageLocales',
                'pageMd',
                'path',
                'subtitle',
                'title'
            ), $status ?? 200);
    }

    public function update($path)
    {
        priv_check('WikiPageRefresh')->ensureCan();

        (new WikiPage($path))->refresh();

        return ujs_redirect(route('wiki.show', ['page' => $path]));
    }
}
