<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\LocaleMeta;
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
     * Returns [WikiPage](#wikipage).
     *
     * @urlParam page The path name of the wiki page.
     */
    public function show($locale = null, $path = null)
    {
        // redirect to default page if missing all parameters
        if ($locale === null) {
            return ujs_redirect(wiki_url(null, $this->locale()));
        }

        $validLocale = LocaleMeta::isValid($locale);

        // if images slip through the markdown processing, redirect them to the correct place
        if (OsuWiki::isImage($path)) {
            $prependPath = $locale === 'images' || $validLocale ? null : $locale;

            return ujs_redirect(route('wiki.image', concat_path([$prependPath, $path])));
        }

        // if invalid locale, assume locale to be part of path and
        // actual locale to be either user locale or passed as parameter
        if (!$validLocale) {
            return ujs_redirect(wiki_url(concat_path([$locale, $path]), $this->locale()));
        }

        // in case locale is passed as query parameter (legacy url inside the page),
        // redirect to new path
        $queryLocale = $this->locale();
        if ($queryLocale !== $locale) {
            return ujs_redirect(wiki_url($path, $queryLocale));
        }

        // if path is missing, redirect to default page
        if ($path === null) {
            return ujs_redirect(wiki_url($path, $locale));
        }

        // normalize path by making sure no trailing slash
        if (substr(request()->getPathInfo(), -1) === '/') {
            return ujs_redirect(wiki_url(rtrim($path, '/'), $locale));
        }

        // legal pages should be displayed with their own style etc
        if (starts_with("{$path}/", "Legal/")) {
            return ujs_redirect(wiki_url($path, $locale));
        }

        $page = Wiki\Page::lookupForController($path, $this->locale());

        if (!$page->isVisible()) {
            $redirectTarget = (new WikiRedirect())->sync()->resolve($path);
            if ($redirectTarget !== null && $redirectTarget !== $path) {
                return ujs_redirect(wiki_url(ltrim($redirectTarget, '/')));
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

    public function image($path)
    {
        if (!OsuWiki::isImage($path)) {
            return response('Invalid file format', 422);
        }

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

    public function sitemap($locale)
    {
        if (!LocaleMeta::isValid($locale)) {
            return ujs_redirect(route('wiki.sitemap', ['locale' => app()->getLocale()]));
        }

        return ext_view('wiki.sitemap', [
            'locale' => $locale,
            'sitemap' => WikiSitemap::get(),
        ]);
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

    public function update($locale, $path)
    {
        priv_check('WikiPageRefresh')->ensureCan();

        if (strtolower($path) === 'sitemap') {
            WikiSitemap::expire();
        } else {
            (new Wiki\Page($path, $locale))->sync(true);
        }

        return ujs_redirect(Request::getUri());
    }
}
