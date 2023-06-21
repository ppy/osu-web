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
        $this->setLocale(
            Auth::user()?->user_lang ?? presence($request->cookie('locale')),
            $request,
        );

        return $next($request);
    }

    protected function setLocale(?string $locale, Request $request): void
    {
        if ($locale !== null) {
            $locale = get_valid_locale($locale);
        }
        $locale ??= $this->localeFromHeader($request);

        App::setLocale($locale);
        // Carbon setLocale normalizes the locale
        Carbon::setLocale($locale === 'sr' ? 'sr_Cyrl' : $locale);
    }

    private function localeFromHeader(Request $request): string
    {
        return (new Parser())->languageRegionCompatibleFor($request->server('HTTP_ACCEPT_LANGUAGE'))
            ?? config('app.fallback_locale');
    }
}
