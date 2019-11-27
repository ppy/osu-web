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

namespace Tests\Models;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testEmailLoginDisabled()
    {
        config()->set('osu.user.allow_email_login', false);
        factory(User::class)->create([
            'username' => 'test',
            'user_email' => 'test@example.org',
        ]);

        $this->assertNull(User::findForLogin('test@example.org'));
    }

    public function testEmailLoginEnabled()
    {
        config()->set('osu.user.allow_email_login', true);
        $user = factory(User::class)->create([
            'username' => 'test',
            'user_email' => 'test@example.org',
        ]);

        $this->assertTrue($user->is(User::findForLogin('test@example.org')));
    }
}
