<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

class RedirectController extends Controller
{
    public function __invoke()
    {
        // encode args like wiki_url helper.
        $args = array_map(function ($arg) {
            // FIXME: remove `rawurlencode` workaround when fixed upstream.
            // Reference: https://github.com/laravel/framework/issues/26715
            return str_replace('%2F', '/', rawurlencode($arg));
        }, func_get_args());

        $status = request()->isMethodCacheable() ? 302 : 307;

        return ujs_redirect(route(explode('redirect:', rtrim(\Route::currentRouteName(), ':'), 2)[1], $args), $status);
    }
}
