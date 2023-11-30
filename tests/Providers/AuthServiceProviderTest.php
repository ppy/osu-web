<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Providers;

use App\Http\Controllers\OAuth\AuthorizedClientsController;
use App\Http\Controllers\OAuth\ClientsController;
use App\Http\Controllers\Passport\AuthorizationController;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\ApproveAuthorizationController;
use Laravel\Passport\Http\Controllers\DenyAuthorizationController;
use Request;
use Route;
use Tests\TestCase;

class AuthServiceProviderTest extends TestCase
{
    /**
     * @dataProvider oauthRoutesRegisteredDataProvider
     */
    public function testOAuthRoutesRegistered($url, $method, $uses)
    {
        $route = Route::getRoutes()->match(Request::create($url, $method));
        $this->assertSame($uses, $route->action['uses']);
    }

    public function testPassportDefaultRoutesNotRegistered()
    {
        $routeNames = array_keys(Route::getRoutes()->getRoutesByName());

        foreach ($routeNames as $routeName) {
            $this->assertStringStartsNotWith('passport.', $routeName);
        }
    }

    public static function oauthRoutesRegisteredDataProvider()
    {
        return [
            ['oauth/authorize', 'GET', AuthorizationController::class.'@authorize'],
            ['oauth/authorize', 'POST', ApproveAuthorizationController::class.'@approve'],
            ['oauth/authorize', 'DELETE', DenyAuthorizationController::class.'@deny'],

            ['oauth/authorized-clients/1', 'DELETE', AuthorizedClientsController::class.'@destroy'],

            ['oauth/clients', 'GET', ClientsController::class.'@index'],
            ['oauth/clients', 'POST', ClientsController::class.'@store'],
            ['oauth/clients/1', 'PUT', ClientsController::class.'@update'],
            ['oauth/clients/1', 'DELETE', ClientsController::class.'@destroy'],
            ['oauth/clients/1/reset-secret', 'POST', ClientsController::class.'@resetSecret'],

            ['oauth/token', 'POST', AccessTokenController::class.'@issueToken'],
        ];
    }
}
