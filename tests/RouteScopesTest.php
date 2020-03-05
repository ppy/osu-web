<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Libraries\RouteScopesHelper;
use PHPUnit\Framework\ExpectationFailedException;

class RouteScopesTest extends TestCase
{
    private $expectations;

    public function testApiRouteScopes()
    {
        $failures = [];
        $this->importExpectations();

        $routes = (new RouteScopesHelper)->toArray();
        foreach ($routes as $route) {
            try {
                $this->runSingleTest($route);
            } catch (ExpectationFailedException $e) {
                $failures[] = $e;
            }
        }

        $this->assertEmpty(
            $failures,
            // print errors after tests finish
            print_r(
                array_map(
                    function ($failure) {
                        return [
                            'message' => $failure->getMessage(),
                            'diff' => $failure->getComparisonFailure()->toString()
                        ];
                    },
                    $failures
                ),
                true
            )
        );
    }

    private function runSingleTest(array $route)
    {
        $key = "{$route['method']}@{$route['controller']}";

        $this->assertSame($this->expectations[$key], $route, $key);
    }

    private function importExpectations()
    {
        $this->expectations = [];
        $routes = RouteScopesHelper::importCsv('expected.csv')->routes;
        foreach ($routes as $route) {
            $key = "{$route['method']}@{$route['controller']}";
            $this->expectations[$key] = $route;
        }
    }
}
