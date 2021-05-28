<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Passport;

use App\Http\Controllers\Passport\AuthorizationController;
use App\Models\OAuth\Client;
use Mockery;
use Tests\TestCase;
use Zend\Diactoros\ServerRequest;

class AuthorizationControllerTest extends TestCase
{
    private $controller;

    public function testAuthorizeNormalizes()
    {
        $client = factory(Client::class)->create();

        // phpcs:disable
        $request = new ServerRequest(
            /* $serverParams */ [],
            /* $uploadedFiles */ [],
            /* $uri */ config('app.url').'/oauth/authorize',
            /* $method */ 'GET',
            /* $body */ 'php://input',
            /* $headers */  [],
            /* $cookies */  [],
            /* $queryParams */ ['client_id' => $client->getKey(), 'scope' => 'one two three'],
            /* $parsedBody */ null,
            /* $protocol*/ '1.1'
        );
        // phpcs:enable

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
