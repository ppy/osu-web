<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
