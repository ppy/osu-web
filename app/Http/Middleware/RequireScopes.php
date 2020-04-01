<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use App\Exceptions\AuthorizationException;
use Closure;
use Illuminate\Http\Request;
use Laravel\Passport\Exceptions\MissingScopeException;

class RequireScopes
{
    /** @var bool|null */
    private $requestHasScopedMiddleware;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string[] ...$scopes
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$scopes)
    {
        if (!AuthApi::skipAuth($request)) {
            $token = optional($request->user())->token();
            if ($token === null) {
                throw new AuthorizationException();
            }

            if (empty($token->scopes)) {
                throw new MissingScopeException([], 'Tokens without scopes are not valid.');
            }

            if (!$this->requestHasScopedMiddleware($request)) {
                // use a non-existent scope; only '*' should pass.
                if (!$token->can('invalid')) {
                    throw new MissingScopeException();
                }
            } else {
                foreach ($scopes as $scope) {
                    if (!$token->can($scope)) {
                        throw new MissingScopeException([$scope], 'A required scope is missing.');
                    }
                }
            }
        }

        return $next($request);
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
        if ($this->requestHasScopedMiddleware === null) {
            $this->requestHasScopedMiddleware = $this->containsScoped($request);
        }

        return $this->requestHasScopedMiddleware;
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
