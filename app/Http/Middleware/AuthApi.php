<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;

class AuthApi
{
    // TODO: this should be definable per-controller or action.
    public static function skipAuth($request)
    {
        $path = "{$request->decodedPath()}/";

        return starts_with($path, 'api/v2/changelog/')
            || (starts_with($path, 'api/v2/comments/') && $request->isMethod('GET'));
    }

    public function handle(Request $request, Closure $next)
    {
        if (static::skipAuth($request)) {
            return $next($request);
        }

        return app(Authenticate::class)->handle($request, $next, 'api');
    }
}
