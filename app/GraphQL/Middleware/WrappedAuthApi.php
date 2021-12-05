<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Middleware;

use App\GraphQL\ErrorCodes;
use App\GraphQL\Exceptions\AuthorisationException;
use App\Http\Middleware\AuthApi;
use Closure;
use Illuminate\Auth\AuthenticationException as LaravelAuthenticationException;

class WrappedAuthApi extends AuthApi
{
    public function handle($request, Closure $next)
    {
        try {
            return parent::handle($request, $next);
        } catch (LaravelAuthenticationException) {
            $error = new AuthorisationException(ErrorCodes::AUTH_INVALID_TOKEN, 'Authentication error', 401);
            return $error->throw();
        }
    }
}
