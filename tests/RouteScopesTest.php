<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Http\Middleware\RequireScopes;
use App\Libraries\RouteScopesHelper;
use App\Models\Build;
use App\Models\Changelog;
use App\Models\Comment;
use App\Models\UpdateStream;
use Route;

class RouteScopesTest extends TestCase
{
    private static $expectations;

    /**
     * @dataProvider routeScopesDataProvider
     */
    public function testApiRouteScopes($route)
    {
        $this->importExpectations();

        $key = RouteScopesHelper::keyForMethods($route['methods']).'@'.$route['controller'];

        $this->assertSame(static::$expectations[$key], $route, $key);
    }

    /**
     * @dataProvider routesDataProvider
     */
    public function testUnscopedRequestsRequireAuthentication(string $url, string $method, array $middlewares)
    {
        // factory some objects so unauthed endpoints don't 404.
        // FIXME: only create objects as necessary instead of every run;
        // This can't be simply setup in setUpBeforeClass() because then we'd need to initialize the app container there,
        // but the container is overriden on each test and also destroyed before the teardown
        // making rolling back or cleaning up problematic.
        $stream = factory(UpdateStream::class)->create([
            'name' => '1',
            'stream_id' => 1, // Changelog stream_id is tinyint, autoincrement makes test fail too soon.
        ]);

        factory(Changelog::class)->create([
            'stream_id' => $stream->getKey(),
            'user_id' => 1, // user doesn't need to exist and not having to create a user makes the test much faster
        ]);

        $build = Build::factory()->create([
            'version' => '1',
            'stream_id' => $stream->getKey(),
        ]);

        Comment::factory()->create([
            'commentable_id' => $build->getKey(),
            'commentable_type' => 'build',
            'id' => 1,
        ]);

        $status = $this->call($method, $url)->getStatusCode();

        if ($method === 'GET' && starts_with(ltrim($url, '/').'/', RequireScopes::NO_TOKEN_REQUIRED)) {
            $this->assertTrue(in_array($status, [200, 302, 404], true));
        } elseif (in_array('require-scopes', $middlewares, true)) {
            $this->assertSame(401, $status);
        } else {
            $this->assertNotSame(401, $status);
        }
    }

    public function routesDataProvider()
    {
        // note that $this->app does not carry over to the tests.
        $this->refreshApplication();

        $data = [];

        foreach (Route::getRoutes() as $route) {
            if (!starts_with($route->uri, 'api/')) {
                continue;
            }

            foreach ($route->methods() as $method) {
                // Only need the url to be valid so they can be routed.
                $parameters = [];
                foreach ($route->parameterNames() as $parameterName) {
                    $parameters[$parameterName] = '1';
                }

                $url = app('url')->toRoute($route, $parameters, false);
                $action = $route->getAction('controller');
                $middlewares = $route->gatherMiddleware();

                $key = "{$method}@{$action}"; // give data set a name.
                $data[$key] = [$url, $method, $middlewares];
            }
        }

        return $data;
    }

    public function routeScopesDataProvider()
    {
        // note that $this->app does not carry over to the tests.
        $this->refreshApplication();

        return array_map(function ($route) {
            return [$route];
        }, (new RouteScopesHelper())->toArray());
    }

    private function importExpectations()
    {
        if (static::$expectations !== null) {
            return;
        }

        static::$expectations = [];

        $helper = new RouteScopesHelper();
        $helper->fromJson('tests/api_routes.json');
        $routes = $helper->routes;
        foreach ($routes as $route) {
            $key = RouteScopesHelper::keyForMethods($route['methods']).'@'.$route['controller'];
            static::$expectations[$key] = $route;
        }
    }
}
