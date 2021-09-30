<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Http\Middleware\RequireScopes;

class ApidocRouteHelper
{
    private $routeScopes = [];

    public static function scopeBadge($scope)
    {
        $scopeLower = strtolower($scope);

        return \Html::link("#scope-{$scopeLower}", $scope, ['class' => "badge badge-scope badge-scope-{$scopeLower}"]);
    }


    public static function instance()
    {
        static $instance;

        if ($instance === null) {
            $instance = new static();
        }

        return $instance;
    }

    private static function keyFor(array $methods, string $uri)
    {
        return RouteScopesHelper::keyForMethods($methods).'@'.$uri;
    }

    private static function requiresAuthentication(array $route)
    {
        return !(
            in_array('GET', $route['methods'], true)
            && starts_with("{$route['uri']}/", RequireScopes::NO_TOKEN_REQUIRED)
        );
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

            if (static::requiresAuthentication($route)) {
                if (empty($route['scopes'])) {
                    $route['scopes'][] = 'lazer'; // not osu!lazer to make the css handling simpler.
                }

                $route['scopes'] = array_filter($route['scopes'], function ($scope) {
                    return $scope !== 'any';
                });

                // anything that will list scopes will require OAuth.
                array_unshift($route['scopes'], 'OAuth');
            } else {
                $route['scopes'] = [];
            }

            $route['auth'] = in_array('auth', $route['middlewares'], true);

            $this->routeScopes[static::keyFor($route['methods'], $route['uri'])] = $route;
        }
    }

    public function getAuth(array $methods, string $uri)
    {
        return $this->routeScopes[static::keyFor($methods, $uri)]['auth'];
    }

    public function getScopeTags(array $methods, string $uri)
    {
        return $this->routeScopes[static::keyFor($methods, $uri)]['scopes'];
    }
}
