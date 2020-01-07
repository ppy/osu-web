<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
