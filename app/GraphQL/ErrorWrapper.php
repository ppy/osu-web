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
class ErrorWrapper implements BaseErrorHandler
{
    public function __invoke(?Error $error, Closure $next): ?array
    {
        if ($error === null) {
            return $next(null);
        }

        $wrapped = static::wrap($error->getPrevious());

        if ($wrapped === null) {
            return $next($error);
        }

        return $next(new Error(
            $wrapped->getMessage(),
            $error->getNodes(),
            $error->getSource(),
            $error->getPositions(),
            $error->getPath(),
            $wrapped
        ));
    }

    public static function wrap(?\Throwable $throwable): ?\Throwable
    {
        if ($throwable instanceof WrappedException) {
            return null;
        }

        if ($throwable instanceof BaseAuthorizationException) {
            return AuthorizationException::wrap($throwable);
        } elseif ($throwable instanceof BaseAuthenticationException) {
            return AuthenticationException::wrap($throwable);
        } elseif ($throwable instanceof BaseMissingScopeException) {
            return MissingScopeException::wrap($throwable);
        } elseif ($throwable instanceof BaseThrottleRequestsException) {
            return ThrottleRequestsException::wrap($throwable);
        }

        return null;
    }
}
