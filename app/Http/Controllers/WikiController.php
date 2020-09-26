<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\OsuWiki;
use App\Libraries\Search\WikiSuggestions;
use App\Libraries\Search\WikiSuggestionsRequestParams;
use App\Libraries\Wiki\WikiSitemap;
use App\Libraries\WikiRedirect;
use App\Models\Wiki;
use Request;

/**
 * @group Wiki
 */
class WikiController extends Controller
{
    /**
     * Get Wiki Page
     *
     * The wiki article or image data.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [WikiPage](#wikipage) if the content is a wiki page; a binary blob, otherwise.
     *
     * @urlParam page The path name of the wiki page.
     */
    public function show($path = null)
    {
        if ($path === null) {
            return ujs_redirect(wiki_url());
        }

        if (OsuWiki::isImage($path)) {
            return $this->showImage($path);
        }

        $page = Wiki\Page::lookupForController($path, $this->locale());

        if (!$page->isVisible()) {
            $redirectTarget = (new WikiRedirect())->sync()->resolve($path);
            if ($redirectTarget !== null && $redirectTarget !== $path) {
                return ujs_redirect(wiki_url('').'/'.ltrim($redirectTarget, '/'));
            }

            $correctPath = Wiki\Page::searchPath($path, $this->locale());
            if ($correctPath !== null && $correctPath !== $path) {
                return ujs_redirect(wiki_url($correctPath));
            }

            $status = 404;
        }

        if (is_json_request()) {
            if (!$page->isVisible()) {
                return response(null, 404);
            }

            return json_item($page, 'WikiPage');
        }

        return ext_view($page->template(), compact('page'), null, $status ?? null);
    }

    public function sitemap()
    {
        return ext_view('wiki.sitemap', WikiSitemap::get());
    }

    public function suggestions()
    {
        $search = new WikiSuggestions(new WikiSuggestionsRequestParams(request()->all()));

        $response = [];
        foreach ($search->response() as $hit) {
            $response[] = [
                'highlight' => $hit->highlights('title.autocomplete')[0],
                'path' => $hit->source('path'),
                'title' => $hit->source('title'),
            ];
        }

        return $response;
    }

    public function update($path)
    {
        priv_check('WikiPageRefresh')->ensureCan();

        if (strtolower($path) === 'sitemap') {
            WikiSitemap::expire();
        } else {
            (new Wiki\Page($path, $this->locale()))->sync(true);
        }

        return ujs_redirect(Request::getUri());
    }

    private function showImage($path)
    {
        $image = Wiki\Image::lookupForController($path, Request::url(), Request::header('referer'));

        request()->attributes->set('strip_cookies', true);

        if (!$image->isVisible()) {
            return response('Not found', 404);
        }

        return response($image->get()['content'], 200)
            ->header('Content-Type', $image->get()['type'])
            // 10 years max-age
            ->header('Cache-Control', 'max-age=315360000, public');
    }
}
