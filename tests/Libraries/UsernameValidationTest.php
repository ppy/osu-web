<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries;

use App\Libraries\UsernameValidation;
use App\Models\RankHighest;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

// FIXME: need more tests
class UsernameValidationTest extends TestCase
{
    public function testUsersOfUsernameIncludesCurrentUsernameOwner(): void
    {
        $existing = User::factory()->create([
            'username' => 'user1',
            'username_clean' => 'user1',
        ]);

        $users = UsernameValidation::usersOfUsername('user1');
        $this->assertCount(1, $users);
        $this->assertTrue($existing->is($users->first()));
    }

    public function testValidateAvailabilityWhenNotInUse(): void
    {
        $this->assertTrue(UsernameValidation::validateAvailability('Free username')->isEmpty());
    }

    public function testValidateAvailabilityWithActiveUser(): void
    {
        $user = User::factory()->create(['user_lastvisit' => Carbon::now()]);

        $this->assertFalse(UsernameValidation::validateAvailability($user->username)->isEmpty());
    }

    public function testValidateAvailabilityWithInactiveUser(): void
    {
        $user = User::factory()->create(['user_lastvisit' => Carbon::now()->subDecade()]);

        $this->assertTrue(UsernameValidation::validateAvailability($user->username)->isEmpty());
    }

    public function testValidateAvailabilityWithRecentlyUsedUsername(): void
    {
        User
            ::factory()
            ->create([
                'user_lastvisit' => Carbon::now(),
                'username' => 'New username',
                'username_clean' => 'new username',
            ])
            ->usernameChangeHistory()
            ->create([
                'timestamp' => Carbon::now(),
                'username' => 'New username',
                'username_last' => 'Old username',
            ]);

        $this->assertFalse(UsernameValidation::validateAvailability('Old username')->isEmpty());
    }

    /**
     * @dataProvider usernameValidationDataProvider
     */
    public function testValidateUsername(string $username, bool $expectValid): void
    {
        $this->assertSame(
            $expectValid,
            UsernameValidation::validateUsername($username)->isEmpty(),
        );
    }

    public function testValidateUsersOfUsername(): void
    {
        $existing = User::factory()->create([
            'username' => 'user1',
            'username_clean' => 'user1',
        ]);

        $this->assertFalse(UsernameValidation::validateUsersOfUsername('user1')->isAny());
    }

    public function testValidateUsersOfUsernameFormerTopRank(): void
    {
        $existing = User::factory()->create([
            'username' => 'user1',
            'username_clean' => 'user1',
        ]);
        RankHighest::factory()->create([
            'user_id' => $existing,
            'rank' => 100,
        ]);

        $this->assertTrue(UsernameValidation::validateUsersOfUsername('user1')->isAny());
    }

    public function testValidateUsersOfUsernameRenamedTopRank(): void
    {
        $existing = User::factory()->create([
            'username' => 'user2',
            'username_clean' => 'user2',
        ]);
        $existing->usernameChangeHistory()->make([
            'username' => 'user2',
            'username_last' => 'user1',
        ])->saveOrExplode();
        RankHighest::factory()->create([
            'user_id' => $existing,
            'rank' => 100,
        ]);

        $this->assertTrue(UsernameValidation::validateUsersOfUsername('user1')->isAny());
    }

    public function usernameValidationDataProvider(): array
    {
        return [
            'alphabetic'                   => ['Username',         true],
            'alphanumeric'                 => ['Username1000',     true],
            'numeric'                      => ['1000',             true],
            'space at beginning'           => [' Username',        false],
            'space at end'                 => ['Username ',        false],
            'space in middle'              => ['Username 1000',    true],
            'too short'                    => ['aa',               false],
            'shortest'                     => ['aaa',              true],
            'too long'                     => ['aaaaaaaaaaaaaaaa', false],
            'longest'                      => ['aaaaaaaaaaaaaaa',  true],
            'two spaces in middle'         => ['Username  1000',   false],
            'invalid special characters'   => ['Usern@me',         false],
            'all valid special characters' => ['-[]_',             true],
            'mixed space and underscore'   => ['Username_1 2',     false],
        ];
    }
}
