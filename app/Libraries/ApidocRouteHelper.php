<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

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

    private function __construct()
    {
        $routeScopesHelper = new RouteScopesHelper();
        $routeScopesHelper->loadRoutes();

        foreach ($routeScopesHelper->toArray() as $route) {
            $key = $this->keyFor($route['uri'], $route['method']);
            $this->routeScopes[$key] = $route;
        }
    }

    public function getScopes(string $uri, string $method)
    {
        return $this->routeScopes[$this->keyFor($uri, $method)]['scopes'];
    }

    public function hasScopes(string $uri, string $method)
    {
        return !empty($this->routeScopes[$this->keyFor($uri, $method)]['scopes']);
    }

    public static function keyFor(string $uri, string $method)
    {
        return "{$method}@{$uri}";
    }

    public function requiresAuthentication(string $uri, string $method)
    {
        return in_array('require-scopes', $this->routeScopes[$this->keyFor($uri, $method)]['middlewares'], true);
    }
}
