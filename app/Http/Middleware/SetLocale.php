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
namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale =
            presence($request->input('locale')) ??
            presence($request->cookie('locale')) ??
            locale_accept_from_http($request->server('HTTP_ACCEPT_LANGUAGE'));

        if (!in_array($locale, config('app.available_locales'), true)) {
            $locale = array_first(
                config('app.available_locales'),
                function ($_key, $value) use ($locale) {
                    return starts_with($locale, $value);
                },
                config('app.fallback_locale')
            );
        }

        App::setLocale($locale);

        return $next($request)->withCookie(cookie()->forever('locale', $locale));
    }
}
