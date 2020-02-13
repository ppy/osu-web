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

        return ujs_redirect(route(explode('redirect:', \Route::currentRouteName(), 2)[1], $args));
    }
}
