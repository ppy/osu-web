<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;

class AuthApi
{
    const SKIP_GET = [
        'api/v2/changelog/',
        'api/v2/comments/',
        'api/v2/seasonal-backgrounds/',
        'api/v2/wiki/',
    ];

    // TODO: this should be definable per-controller or action.
    public static function skipAuth($request)
    {
        $path = "{$request->decodedPath()}/";

        return $request->isMethod('GET') && starts_with($path, static::SKIP_GET);
    }

    public function handle(Request $request, Closure $next)
    {
        auth()->shouldUse('api');
        optional(auth()->user())->markSessionVerified();

        if (static::skipAuth($request)) {
            return $next($request);
        }

        return app(Authenticate::class)->handle($request, $next, 'api');
    }
}
