<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers;

class RedirectController extends Controller
{
    public function __invoke()
    {
        // Redirect routes should be named 'redirect:<target>'
        return ujs_redirect(route(explode('redirect:', \Route::currentRouteName(), 2)[1], func_get_args()));
    }
}
