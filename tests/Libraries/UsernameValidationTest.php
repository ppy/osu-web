<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        $existing = User::factory()->create([
            'username' => 'user1',
            'username_clean' => 'user1',
            'user_lastvisit' => Carbon::now()->subYear(),
        ]);

        $users = UsernameValidation::usersOfUsername('user1');
        $this->assertCount(1, $users);
        $this->assertTrue($existing->is($users->first()));
    }
}
