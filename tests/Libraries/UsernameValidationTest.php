<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Libraries\UsernameValidation;
use App\Models\RankHighest;
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
            'user_lastvisit' => Carbon::now()->subYears(),
        ]);

        $users = UsernameValidation::usersOfUsername('user1');
        $this->assertCount(1, $users);
        $this->assertTrue($existing->is($users->first()));
    }

    public function testValidateUsersOfUsernameInactive()
    {
        $existing = User::factory()->create([
            'username' => 'user1',
            'username_clean' => 'user1',
            'user_lastvisit' => Carbon::now()->subYears(20),
        ]);

        $this->assertFalse(UsernameValidation::validateUsersOfUsername('user1')->isAny());
    }

    public function testValidateUsersOfUsernameInactiveFormerTopRank()
    {
        $existing = User::factory()->create([
            'username' => 'user1',
            'username_clean' => 'user1',
            'user_lastvisit' => Carbon::now()->subYears(20),
        ]);
        RankHighest::factory()->create([
            'user_id' => $existing,
            'rank' => 100,
        ]);

        $this->assertTrue(UsernameValidation::validateUsersOfUsername('user1')->isAny());
    }

    public function testValidateUsersOfUsernameRenamedTopRank()
    {
        $existing = User::factory()->create([
            'username' => 'user2',
            'username_clean' => 'user2',
            'user_lastvisit' => Carbon::now(),
        ]);
        $existing->usernameChangeHistory()->make([
            'timestamp' => Carbon::now()->subYears(20),
            'username' => 'user2',
            'username_last' => 'user1',
        ])->saveOrExplode();
        RankHighest::factory()->create([
            'user_id' => $existing,
            'rank' => 100,
        ]);

        $this->assertTrue(UsernameValidation::validateUsersOfUsername('user1')->isAny());
    }
}
