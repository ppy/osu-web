<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL;

use App\Exceptions\AuthorizationException as BaseAuthorizationException;
use App\GraphQL\Exceptions\AuthenticationException;
use App\GraphQL\Exceptions\AuthorizationException;
use App\GraphQL\Exceptions\MissingScopeException;
use App\GraphQL\Exceptions\ThrottleRequestsException;
use App\GraphQL\Exceptions\WrappedException;
use Closure;
use GraphQL\Error\Error;
use Illuminate\Auth\AuthenticationException as BaseAuthenticationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException as BaseThrottleRequestsException;
use Laravel\Passport\Exceptions\MissingScopeException as BaseMissingScopeException;
use Nuwave\Lighthouse\Execution\ErrorHandler as BaseErrorHandler;

/**
 * Wraps various exceptions into GraphQL exceptions
 */
class ErrorHandler implements BaseErrorHandler
{
    public function __invoke(?Error $error, Closure $next): ?array
    {
        if ($error === null) {
            return $next(null);
        }

        $wrapped = null;

        $e = $error->getPrevious();
        if ($error->getPrevious() instanceof WrappedException) {
            return $next($error);
        }

        if ($e instanceof BaseAuthorizationException) {
            $wrapped = AuthorizationException::wrap($e);
        } elseif ($e instanceof BaseAuthenticationException) {
            $wrapped = AuthenticationException::wrap($e);
        } elseif ($e instanceof BaseMissingScopeException) {
            $wrapped = MissingScopeException::wrap($e);
        } elseif ($e instanceof BaseThrottleRequestsException) {
            $wrapped = ThrottleRequestsException::wrap($e);
        }

        if ($wrapped !== null) {
            return $next(new Error(
                $wrapped->getMessage(),
                $error->getNodes(),
                $error->getSource(),
                $error->getPositions(),
                $error->getPath(),
                $wrapped
            ));
        }

        return $next($error);
    }
}
