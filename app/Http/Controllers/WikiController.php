<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers;

use App\Libraries\OsuWiki;
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

        if (OsuWiki::isImage($path)) {
            return $this->showImage($path);
        }

        $page = new Wiki\Page($path, $this->locale());

        if ($page->get() === null) {
            $redirectTarget = (new WikiRedirect())->resolve($path);
            if ($redirectTarget !== null && $redirectTarget !== $path) {
                return ujs_redirect(wiki_url('').'/'.ltrim($redirectTarget, '/'));
            }

            $correctPath = Wiki\Page::searchPath($path, $this->locale());
            if ($correctPath !== null && $correctPath !== $path) {
                return ujs_redirect(wiki_url($correctPath));
            }

            $status = 404;
        }

        return response()->view($page->template(), compact('page'), $status ?? 200);
    }

    public function update($path)
    {
        priv_check('WikiPageRefresh')->ensureCan();

        (new Wiki\Page($path, $this->locale()))->forget();

        return ujs_redirect(Request::getUri());
    }

    private function showImage($path)
    {
        $image = (new Wiki\Image($path, Request::url(), Request::header('referer')))->get();

        session(['_strip_cookies' => true]);

        if ($image === null) {
            return response('Not found', 404);
        }

        return response($image['data'], 200)
            ->header('Content-Type', $image['type'])
            // 10 years max-age
            ->header('Cache-Control', 'max-age=315360000, public');
    }
}
