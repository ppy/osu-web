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

    private static function keyFor(array $route)
    {
        return RouteScopesHelper::keyForMethods($route).'@'.$route['uri'];
    }

    private function __construct()
    {
        $routeScopesHelper = new RouteScopesHelper();
        $routeScopesHelper->loadRoutes();

        foreach ($routeScopesHelper->toArray() as $route) {
            // apidoc doesn't contain HEAD.
            if (in_array('HEAD', $route['methods'], true)) {
                $route['methods'] = array_filter($route['methods'], function ($method) {
                    return $method !== 'HEAD';
                });
            }

            $route['scopes'] = array_filter($route['scopes'], function ($scope) {
                return $scope !== 'any';
            });

            $this->routeScopes[static::keyFor($route)] = $route;
        }
    }

    public function getScopes(array $route)
    {
        return $this->routeScopes[static::keyFor($route)]['scopes'];
    }

    public function requiresAuthentication(array $route)
    {
        if (
            in_array('GET', $route['methods'], true)
            && starts_with("{$route['uri']}/", RequireScopes::NO_TOKEN_REQUIRED)
        ) {
            return false;
        }

        return in_array('require-scopes', $this->routeScopes[static::keyFor($route)]['middlewares'], true);
    }
}
