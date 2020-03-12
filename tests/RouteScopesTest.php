<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use Request;
use Route;

class RouteScopesTest extends TestCase
{
    public function testApiRoutesRequireScope()
    {
        $expected = [
            'api/v2/friends' => ['friends.read'],
            'api/v2/me/{mode?}' => ['identify'],
            'api/v2/users/{user}/kudosu' => ['users.read'],
            'api/v2/users/{user}/scores/{type}' => ['users.read'],
            'api/v2/users/{user}/beatmapsets/{type}' => ['users.read'],
            'api/v2/users/{user}/recent_activity' => ['users.read'],
            'api/v2/users/{user}/{mode?}' => ['users.read'],
        ];

        $loaded = [];

        foreach (Route::getRoutes() as $route) {
            if (!starts_with($route->uri, 'api/')) {
                continue;
            }

            // uri will still have the placeholders and wrong verbs, but we don't need them.
            $request = Request::create($route->uri, 'GET');
            $this->app->instance('request', $request); // set current request so is_api_request can work.

            $middlewares = $route->gatherMiddleware();

            foreach ($middlewares as $middleware) {
                if (!is_string($middleware)) {
                    continue;
                }

                // FIXME: need something that isn't string checking.
                if (starts_with($middleware, 'require-scopes:')) {
                    $scopes = explode(',', substr($middleware, strlen('require-scopes:')));
                    sort($scopes);
                    $loaded[$route->uri] = $scopes;
                }
            }

            // FIXME: separate this assertion.
            $this->assertTrue(in_array('require-scopes', $middlewares, true));
        }

        $this->assertSame($expected, $loaded);
    }
}
