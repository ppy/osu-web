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

namespace Tests\Controllers\Passport;

use App\Http\Controllers\Passport\AuthorizationController;
use Mockery;
use Tests\TestCase;
use Zend\Diactoros\ServerRequest;

class AuthorizationControllerTest extends TestCase
{
    private $controller;

    public function testAuthorizeNormalizes()
    {
        $request = new ServerRequest(
            /* $serverParams */ [],
            /* $uploadedFiles */ [],
            /* $uri */ config('app.url').'/oauth/authorize',
            /* $method */ 'GET',
            /* $body */ 'php://input',
            /* $headers */  [],
            /* $cookies */  [],
            /* $queryParams */ ['scope' => 'one two three'],
            /* $parsedBody */ null,
            /* $protocol*/ '1.1'
        );

        $actual = $this->invokeMethod($this->controller, 'normalizeRequestScopes', [$request])->getQueryParams()['scope'];

        $this->assertSame($actual, 'identify one three two');
    }

    public function testNormalizeEmptyScopes()
    {
        $scopes = [];
        $actual = $this->invokeMethod($this->controller, 'normalizeScopes', [$scopes]);

        $this->assertSame($actual, ['identify']);
    }

    public function testNormalizeIdentifyScope()
    {
        $scopes = ['identify'];
        $actual = $this->invokeMethod($this->controller, 'normalizeScopes', [$scopes]);

        $this->assertSame($actual, ['identify']);
    }

    public function testNormalizeMultipleScopes()
    {
        $scopes = ['read', 'identify'];
        $actual = $this->invokeMethod($this->controller, 'normalizeScopes', [$scopes]);

        $this->assertSame($actual, ['identify', 'read']);
    }

    public function testNormalizeIdentifyNotRequested()
    {
        $scopes = ['read'];
        $actual = $this->invokeMethod($this->controller, 'normalizeScopes', [$scopes]);

        $this->assertSame($actual, ['identify', 'read']);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = new AuthorizationController(
            Mockery::mock('\League\OAuth2\Server\AuthorizationServer'),
            Mockery::mock('\Illuminate\Contracts\Routing\ResponseFactory')
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        Mockery::close();
    }
}
