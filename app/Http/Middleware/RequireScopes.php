<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use App\Models\OAuth\Token;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Laravel\Passport\Exceptions\MissingScopeException;

class RequireScopes
{
    const NO_TOKEN_REQUIRED = [
        'api/v2/changelog/',
        'api/v2/comments/',
        'api/v2/news/',
        'api/v2/seasonal-backgrounds/',
        'api/v2/wiki/',
    ];

    // TODO: this should be definable per-controller or action.
    public static function noTokenRequired($request)
    {
        $path = "{$request->decodedPath()}/";

        return $request->isMethod('GET') && starts_with($path, static::NO_TOKEN_REQUIRED);
    }

    public function handle($request, Closure $next, ...$scopes)
    {
        if (!is_api_request() || static::noTokenRequired($request)) {
            return $next($request);
        }

        $this->validateScopes(oauth_token(), $scopes);

        return $next($request);
    }

    protected function validateScopes(?Token $token, $scopes)
    {
        if ($token === null) {
            throw new AuthenticationException();
        }

        if (!$this->requestHasScopedMiddleware(request())) {
            // use a non-existent scope; only '*' should pass.
            if (!$token->can('invalid')) {
                throw new MissingScopeException();
            }
        } else {
            foreach ($scopes as $scope) {
                if ($scope !== 'any' && !$token->can($scope)) {
                    throw new MissingScopeException([$scope], 'A required scope is missing.');
                }
            }
        }
    }

    /**
     * Returns if the request contains this middleware with scope parameter checks.
     *
     * @param Request $request
     *
     * @return bool
     */
    private function requestHasScopedMiddleware(Request $request): bool
    {
        $value = $request->attributes->get('requestHasScopedMiddleware');
        if ($value === null) {
            $value = $this->containsScoped($request);
            $request->attributes->set('requestHasScopedMiddleware', $value);
        }

        return $value;
    }

    private function containsScoped(Request $request)
    {
        foreach ($request->route()->gatherMiddleware() as $middleware) {
            if (is_string($middleware) && starts_with($middleware, 'require-scopes:')) {
                return true;
            }
        }

        return false;
    }
}
