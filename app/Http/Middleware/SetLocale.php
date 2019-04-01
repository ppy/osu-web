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

namespace App\Http\Middleware;

use App;
use App\Libraries\AcceptHttpLanguage\Parser;
use Auth;
use Carbon\Carbon;
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
        if (Auth::check()) {
            $locale = Auth::user()->user_lang;
        } else {
            $locale = presence($request->cookie('locale'));
        }

        $locale = get_valid_locale($locale);

        if ($locale === null) {
            $accept = $request->server('HTTP_ACCEPT_LANGUAGE');
            $parser = new Parser($accept);
            $locale = $parser->languageRegionCompatibleFrom(config('app.available_locales')) ?? config('app.fallback_locale');
        }

        App::setLocale($locale);
        // Carbon setLocale normalizes the locale
        Carbon::setLocale($locale);

        return $next($request);
    }
}
