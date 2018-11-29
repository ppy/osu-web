<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace Tests\Passport;

use App\Http\Controllers\Passport\AuthorizationController;
use Laravel\Passport\Http\Controllers\AuthorizationController as PassportAuthorizationController;
use Laravel\Passport\Bridge\Scope;
use Mockery;
use ReflectionClass;
use TestCase;

class AuthorizationControllerTest extends TestCase
{
    protected $request;
    protected $controller;

    private static function scopeIdentifiers(array $scopes) {
        return collect($scopes)->map(function ($scope) {
            return $scope->id;
        })->all();
    }

    public function setUp()
    {
        parent::setUp();

        $this->request = Mockery::mock('\League\OAuth2\Server\RequestTypes\AuthorizationRequest');

        $this->controller = new AuthorizationController(
            Mockery::mock('\League\OAuth2\Server\AuthorizationServer'),
            Mockery::mock('\Illuminate\Contracts\Routing\ResponseFactory')
        );
    }

    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }

    public function testBaseClassDoesNotNormalize()
    {
        $this->request->shouldReceive('getScopes')->andReturn([]);
        $this->controller = new PassportAuthorizationController(
            Mockery::mock('\League\OAuth2\Server\AuthorizationServer'),
            Mockery::mock('\Illuminate\Contracts\Routing\ResponseFactory')
        );

        $actual = $this->invokeMethod($this->controller, 'parseScopes', [$this->request]);

        $this->assertSame(static::scopeIdentifiers($actual), []);
    }

    public function testIdentifyScopeAdded()
    {
        $this->request->shouldReceive('getScopes')->andReturn([]);

        $actual = $this->invokeMethod($this->controller, 'parseScopes', [$this->request]);

        $this->assertSame(static::scopeIdentifiers($actual), ['identify']);
    }

    public function testOnlyIdentifyScopeRequested()
    {
        $this->request->shouldReceive('getScopes')->andReturn([new Scope('identify')]);

        $actual = $this->invokeMethod($this->controller, 'parseScopes', [$this->request]);

        $this->assertSame(static::scopeIdentifiers($actual), ['identify']);
    }

    public function testOnlyIdentifyScopeIncludedInRequest()
    {
        $this->request->shouldReceive('getScopes')->andReturn([new Scope('identify'), new Scope('read')]);

        $actual = $this->invokeMethod($this->controller, 'parseScopes', [$this->request]);

        $this->assertSame(static::scopeIdentifiers($actual), ['identify', 'read']);
    }
}
