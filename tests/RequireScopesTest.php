<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Exceptions\AuthorizationException;
use App\Http\Middleware\RequireScopes;
use App\Models\User;
use Illuminate\Routing\Route;
use Laravel\Passport\Exceptions\MissingScopeException;
use Request;

class RequireScopesTest extends TestCase
{
    protected $next;
    protected $request;

    public function testSingleton()
    {
        $this->assertSame(app(RequireScopes::class), app(RequireScopes::class));
    }

    public function testNullUser()
    {
        $this->setUser(null);
        $this->setRequest();

        $this->expectException(AuthorizationException::class);
        app(RequireScopes::class)->handle($this->request, $this->next);
    }

    public function testNoScopes()
    {
        $userScopes = [];

        $this->setUser($userScopes);
        $this->setRequest();

        $this->expectException(MissingScopeException::class);
        app(RequireScopes::class)->handle($this->request, $this->next);
    }

    public function testAllScopes()
    {
        $userScopes = ['*'];

        $this->setUser($userScopes);
        $this->setRequest();

        app(RequireScopes::class)->handle($this->request, $this->next);
        $this->assertTrue(true);
    }

    public function testHasTheRequiredScope()
    {
        $userScopes = ['identify'];
        $requireScopes = ['identify'];

        $this->setUser($userScopes);
        $this->setRequest($requireScopes);

        app(RequireScopes::class)->handle($this->request, $this->next, ...$requireScopes);
        $this->assertTrue(true);
    }

    public function testDoesNotHaveTheRequiredScope()
    {
        $userScopes = ['somethingelse'];
        $requireScopes = ['identify'];

        $this->setUser($userScopes);
        $this->setRequest($requireScopes);

        $this->expectException(MissingScopeException::class);
        app(RequireScopes::class)->handle($this->request, $this->next, ...$requireScopes);
    }

    public function testRequiresSpecificScopeAndAllScopeGiven()
    {
        $userScopes = ['*'];
        $requireScopes = ['identify'];

        $this->setUser($userScopes);
        $this->setRequest($requireScopes);

        app(RequireScopes::class)->handle($this->request, $this->next, ...$requireScopes);
        $this->assertTrue(true);
    }

    public function testRequiresSpecificScopeAndNoScopeGiven()
    {
        $userScopes = [];
        $requireScopes = ['identify'];

        $this->setUser($userScopes);
        $this->setRequest($requireScopes);

        $this->expectException(MissingScopeException::class);
        app(RequireScopes::class)->handle($this->request, $this->next, ...$requireScopes);
    }

    public function testRequiresSpecificScopeAndMultipleNonMatchingScopesGiven()
    {
        $userScopes = ['somethingelse', 'alsonotright', 'nope'];
        $requireScopes = ['identify'];

        $this->setUser($userScopes);
        $this->setRequest($requireScopes);

        $this->expectException(MissingScopeException::class);
        app(RequireScopes::class)->handle($this->request, $this->next, ...$requireScopes);
    }

    public function testRequiresSpecificScopeAndMultipleScopesGiven()
    {
        $userScopes = ['somethingelse', 'identify', 'nope'];
        $requireScopes = ['identify'];

        $this->setUser($userScopes);
        $this->setRequest($requireScopes);

        app(RequireScopes::class)->handle($this->request, $this->next, ...$requireScopes);
        $this->assertTrue(true);
    }

    public function testBlankRequireShouldDenyRegularScopes()
    {
        $userScopes = ['identify'];

        $this->setUser($userScopes);
        $this->setRequest();

        $this->expectException(MissingScopeException::class);
        app(RequireScopes::class)->handle($this->request, $this->next);
    }

    public function testRequireScopesLayered()
    {
        $userScopes = ['identify'];
        $requireScopes = ['identify'];

        $this->setUser($userScopes);
        $this->setRequest($requireScopes);

        app(RequireScopes::class)->handle($this->request, function () use ($requireScopes) {
            app(RequireScopes::class)->handle($this->request, $this->next, ...$requireScopes);
        });

        $this->assertTrue(true);
    }

    public function testRequireScopesLayeredNoPermission()
    {
        $userScopes = ['somethingelse'];
        $requireScopes = ['identify'];

        $this->setUser($userScopes);
        $this->setRequest($requireScopes);

        $this->expectException(MissingScopeException::class);
        app(RequireScopes::class)->handle($this->request, function () use ($requireScopes) {
            app(RequireScopes::class)->handle($this->request, $this->next, ...$requireScopes);
        });
    }

    public function testRequireScopesSkipped()
    {
        $userScopes = ['somethingelse'];
        $requireScopes = ['identify'];

        $this->request = Request::create('/api/v2/changelog', 'GET');
        $this->setUser($userScopes);
        $this->setRequest($requireScopes);

        app(RequireScopes::class)->handle($this->request, $this->next, ...$requireScopes);
        $this->assertTrue(true);
    }

    protected function setRequest(?array $scopes = null)
    {
        // set a fake route resolver
        $this->request->setRouteResolver(function () use ($scopes) {
            $route = new Route(['GET'], '/', null);
            $route->middleware('require-scopes');

            if ($scopes !== null) {
                $route->middleware('require-scopes:'.implode(',', $scopes));
            }

            return $route;
        });
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = Request::create('/', 'GET');
        $this->next = static function () {
            // just an empty closure.
        };
    }

    protected function setUser(?array $scopes = null)
    {
        $user = $scopes !== null ? factory(User::class)->create() : null;

        $this->request->setUserResolver(function () use ($user) {
            return $user;
        });

        if ($user !== null) {
            $this->actAsScopedUser($user, $scopes);
        }
    }
}
