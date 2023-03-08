<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class SetLocaleApi extends SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $acceptLanguage = $request->server('HTTP_ACCEPT_LANGUAGE');
        if ($acceptLanguage === null || $acceptLanguage === '*') {
            $locale = Auth::user()?->user_lang;
        }

        $this->setLocale($locale ?? null, $request);

        return $next($request);
    }
}
