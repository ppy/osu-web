<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Http\Middleware\RequireScopes;

class ApidocRouteHelper
{
    private $routeScopes = [];

    public static function instance()
    {
        static $instance;

        if ($instance === null) {
            $instance = new static();
        }

        return $instance;
    }

    public static function keyFor(array $route)
    {
        [$method, $uri] = static::destructure($route);

        return "{$method}@{$uri}";
    }

    private static function destructure(array $route)
    {
        $uri = $route['uri'];
        $method = $route['method'] ?? $route['methods'][0];

        return [$method, $uri];
    }

    private function __construct()
    {
        $routeScopesHelper = new RouteScopesHelper();
        $routeScopesHelper->loadRoutes();

        foreach ($routeScopesHelper->toArray() as $route) {
            $key = static::keyFor($route);
            $route['scopes'] = array_filter($route['scopes'], function ($scope) {
                return $scope !== 'any';
            });
            $this->routeScopes[$key] = $route;
        }
    }

    public function getScopes(array $route)
    {
        return $this->routeScopes[static::keyFor($route)]['scopes'];
    }

    public function requiresAuthentication(array $route)
    {
        [$method, $uri] = static::destructure($route);

        if ($method === 'GET' && starts_with("{$uri}/", RequireScopes::NO_TOKEN_REQUIRED)) {
            return false;
        }

        return in_array('require-scopes', $this->routeScopes[static::keyFor($route)]['middlewares'], true);
    }
}
