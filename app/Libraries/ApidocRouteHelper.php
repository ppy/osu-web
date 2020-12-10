<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

class ApidocRouteHelper
{
    private $routeScopes;

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

        $this->routeScopes = collect($routeScopesHelper->toArray())->keyBy('uri');
    }

    public function getScopes($uri)
    {
        return $this->routeScopes[$uri]['scopes'];
    }

    public function hasScopes($uri)
    {
        return !empty($this->routeScopes[$uri]['scopes']);
    }

    public function requiresAuthentication($uri)
    {
        return in_array('require-scopes', $this->routeScopes[$uri]['middlewares'], true);
    }
}
