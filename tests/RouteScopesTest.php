<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Http\Middleware\AuthApi;
use App\Libraries\RouteScopesHelper;
use App\Models\Build;
use App\Models\Changelog;
use App\Models\Comment;
use App\Models\UpdateStream;
use Illuminate\Contracts\Console\Kernel;
use PHPUnit\Framework\ExpectationFailedException;
use Route;


class RouteScopesTest extends TestCase
{
    private static $expectations;

    public static function setUpBeforeClass(): void
    {
        // TODO: fix with others
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();

        static::$expectations = static::importExpectations();
    }

    private static function importExpectations()
    {
        $expectations = [];

        $helper = new RouteScopesHelper;
        $helper->fromJson('tests/api_routes.json');
        $routes = $helper->routes;
        foreach ($routes as $route) {
            $key = "{$route['method']}@{$route['controller']}";
            $expectations[$key] = $route;
        }

        return $expectations;
    }

    public function routesDataProvider()
    {
        $this->refreshApplication();

        return array_map(function ($route) {
            return [$route];
        }, (new RouteScopesHelper)->toArray());
    }

    /**
     * @dataProvider routesDataProvider
     */
    public function testApiRouteScopes($route)
    {
        $key = "{$route['method']}@{$route['controller']}";

        $this->assertSame(static::$expectations[$key], $route, $key);
    }

    public function testUnscopedRequestsRequireAuthentication()
    {
        // factory some objects so unauthed endpoints don't 404.
        $stream = factory(UpdateStream::class)->create(['name' => '1']);

        factory(Changelog::class)->create(['stream_id' => $stream->getKey()]);

        $build = factory(Build::class)->create([
            'version' => '1',
            'stream_id' => $stream->getKey(),
        ]);

        factory(Comment::class)->create([
            'commentable_id' => $build->getKey(),
            'commentable_type' => 'build',
            'id' => 1,
        ]);

        $failures = [];
        foreach (Route::getRoutes() as $route) {
            /** @var \Illuminate\Routing\Route $route */
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
                $key = "{$method}@{$route->getAction('controller')}";

                $status = $this->call($method, $url)->getStatusCode();
                $middlewares = $route->gatherMiddleware();

                try {
                    if ($method === 'GET' && starts_with(ltrim($url, '/').'/', AuthApi::SKIP_GET)) {
                        $this->assertTrue(in_array($status, [200, 302, 404], true), $key);
                    } elseif (in_array('require-scopes', $middlewares, true)) {
                        $this->assertSame(401, $status, $key);
                    } else {
                        $this->assertNotSame(401, $status, $key);
                    }
                } catch (ExpectationFailedException $e) {
                    $failures[] = $e;
                }
            }
        }

        $this->printFailures($failures);
    }

    private function printFailures(array $failures)
    {
        $this->assertEmpty(
            $failures,
            // print errors after tests finish
            print_r(
                array_map(
                    function ($failure) {
                        return [
                            'message' => $failure->getMessage(),
                            'diff' => optional($failure->getComparisonFailure())->toString(),
                        ];
                    },
                    $failures
                ),
                true
            )
        );
    }
}
