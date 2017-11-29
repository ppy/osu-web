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

use App\Exceptions\GitHubNotFoundException;
use App\Exceptions\GitHubTooLargeException;
use App\Libraries\WikiRedirect;
use App\Models\Wiki;
use Request;

class WikiController extends Controller
{
    protected $section = 'help';
    protected $actionPrefix = 'wiki-';

    public function show($path = null)
    {
        if ($path === null) {
            return ujs_redirect(wiki_url());
        }

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $imageExtensions = ['gif', 'jpeg', 'jpg', 'png'];

        if (in_array($extension, $imageExtensions, true)) {
            return $this->showImage($path);
        }

        $page = new Wiki\Page($path, $this->locale());

        if ($page->page() === null) {
            $redirectTarget = (new WikiRedirect())->resolve($path);
            if ($redirectTarget !== null && $redirectTarget !== $path) {
                return ujs_redirect(wiki_url($redirectTarget));
            }

            $correctPath = Wiki\Page::searchPath($path, $this->locale());
            if ($correctPath !== null && $correctPath !== $path) {
                return ujs_redirect(wiki_url($correctPath));
            }

            $status = 404;
        }

        return response()->view('wiki.show', compact('page'), $status ?? 200);
    }

    public function update($path)
    {
        priv_check('WikiPageRefresh')->ensureCan();

        (new Wiki\Page($path, $this->locale()))->refresh();

        return ujs_redirect(Request::getUri());
    }

    private function showImage($path)
    {
        try {
            $image = (new Wiki\Image($path, Request::url(), Request::header('referer')))->data();
        } catch (GitHubNotFoundException $e) {
            abort(404);
        } catch (GitHubTooLargeException $e) {
            abort(403);
        }

        return response($image['data'], 200)
            ->header('Content-Type', $image['type']);
    }
}
