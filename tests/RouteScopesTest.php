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
