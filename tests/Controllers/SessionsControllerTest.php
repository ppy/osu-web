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

namespace Tests\Controllers;

use App\Models\User;
use Tests\TestCase;

class SessionsControllerTest extends TestCase
{
    public function testLogin()
    {
        $password = 'password1';
        $user = factory(User::class)->create(compact('password'));

        $this->post(route('login'), [
            'username' => $user->username,
            'password' => $password,
        ])->assertSuccessful();

        $this->assertAuthenticated();
    }

    public function testLoginInactiveUser()
    {
        $password = 'password1';
        $user = factory(User::class)->create(compact('password'));
        $user->update(['user_lastvisit' => now()->subDays(config('osu.user.inactive_days_verification') + 1)]);

        $this->post(route('login'), [
            'username' => $user->username,
            'password' => $password,
        ])->assertSuccessful();

        $this->assertAuthenticated();

        $this->get(route('home'))->assertStatus(401);
    }

    public function testLoginInactiveUserDifferentCountry()
    {
        $password = 'password1';
        $user = factory(User::class)->create(compact('password'));
        $user->update(['user_lastvisit' => now()->subDays(config('osu.user.inactive_days_verification') + 1)]);

        $this->assertNotSame('', $user->fresh()->user_password);

        $this->post(route('login'), [
            'username' => $user->username,
            'password' => $password,
        ], [
            'CF_IPCOUNTRY' => '__',
        ])->assertStatus(302);

        $this->assertGuest();
        $this->assertSame('', $user->fresh()->user_password);
    }
}
