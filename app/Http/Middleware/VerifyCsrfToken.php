<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends BaseVerifier
{
    protected $except = [
        'oauth/authorize',
        'oauth/access_token',
    ];

    protected $abort = [
        'session',
    ];

    public function handle($request, Closure $next)
    {
        try {
            return parent::handle($request, $next);
        } catch (TokenMismatchException $_e) {
            if (starts_with($request->decodedPath(), $this->abort)) {
                $request->attributes->set('status_code_extra', 'invalid_csrf');

                abort(403, 'Reload page and try again');
            } else {
                $request->session()->flush();
                Auth::logout();
                $request->attributes->set('skip_session', true);

                return $next($request);
            }
        }
    }
}
