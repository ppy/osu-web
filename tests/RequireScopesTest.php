<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

use App\Exceptions\AuthorizationException;
use App\Http\Middleware\RequireScopes;
use App\Models\User;
use Laravel\Passport\Exceptions\MissingScopeException;

class RequireScopesTest extends TestCase
{
    protected $next;
    protected $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = Request::create('/', 'GET', [], [], [], ['HTTP_ACCEPT' => 'application/json']);
        $this->next = static function () {
            // just an empty closure.
        };
    }

    public function testNullUser()
    {
        $this->setUser(null);
        $middleware = new RequireScopes;

        $this->expectException(AuthorizationException::class);
        $middleware->handle($this->request, $this->next);
    }

    public function testNoScopes()
    {
        $this->setUser(factory(User::class)->create(), []);

        $middleware = new RequireScopes;

        $this->expectException(MissingScopeException::class);
        $middleware->handle($this->request, $this->next);
    }

    public function testAllScopes()
    {
        $this->setUser(factory(User::class)->create(), ['*']);

        $middleware = new RequireScopes;
        $middleware->handle($this->request, $this->next);
        $this->assertTrue(true);
    }

    protected function setUser(?User $user, array $scopes = null)
    {
        $this->request->setUserResolver(function () use ($user) {
            return $user;
        });

        if ($scopes !== null) {
            $this->actAsScopedUser($user, $scopes);
        }
    }
}
