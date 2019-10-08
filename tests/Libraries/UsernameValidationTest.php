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

namespace Tests\Libraries;

use App\Libraries\UsernameValidation;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

// FIXME: need more tests
class UsernameValidationTest extends TestCase
{
    public function testusersOfUsernameIncludesCurrentUsernameOwner()
    {
        $existing = factory(User::class)->create([
            'username' => 'user1',
            'username_clean' => 'user1',
            'user_lastvisit' => Carbon::now()->subYear(),
        ]);

        $users = UsernameValidation::usersOfUsername('user1');
        $this->assertCount(1, $users);
        $this->assertTrue($existing->is($users->first()));
    }
}
