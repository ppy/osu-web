<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\LocaleMeta;
use App\Models\Wiki;

class LegalController extends Controller
{
    public function show($locale = null, $path = null)
    {
        if (!LocaleMeta::isValid($locale)) {
            $redirect = concat_path(['Legal', $locale, $path]);

            return ujs_redirect(wiki_url($redirect));
        }

        if (substr(request()->getPathInfo(), -1) === '/') {
            $path = rtrim($path, '/');
            return ujs_redirect(wiki_url("Legal/{$path}", $locale));
        }

        switch ($path) {
            case 'copyright':
                $redirect = 'Copyright';
                break;
            case 'privacy':
                $redirect = 'Privacy';
                break;
            case 'terms':
                $redirect = 'Terms';
                break;
        }

        if (isset($redirect)) {
            return ujs_redirect(wiki_url("Legal/{$redirect}"));
        }

        $page = Wiki\Page::lookupForController("Legal/{$path}", $locale);
        $legal = true;

        if (is_json_request()) {
            return json_item($page, 'WikiPage');
        }

        return ext_view('wiki.show', compact('legal', 'locale', 'page'));
    }

    public function update($locale, $path)
    {
        priv_check('WikiPageRefresh')->ensureCan();

        (new Wiki\Page("Legal/{$path}", $locale))->sync(true);

        return ext_view('layout.ujs-reload', [], 'js');
    }
}
