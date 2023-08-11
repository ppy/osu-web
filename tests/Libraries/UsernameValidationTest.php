<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries;

use App\Libraries\UsernameValidation;
use App\Models\Beatmapset;
use App\Models\RankHighest;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class UsernameValidationTest extends TestCase
{
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

    /**
     * @dataProvider usersOfUsernameDataProvider
     */
    public function testValidateUsersOfUsername(): void
    {
        [, $username] = $this->createUsersOfUsernameDataProviderModels(...func_get_args());

        $this->assertTrue(UsernameValidation::validateUsersOfUsername($username)->isEmpty());
    }

    /**
     * @dataProvider usersOfUsernameDataProvider
     */
    public function testValidateUsersOfUsernameFormerlyAlmostTopRanked(): void
    {
        [$user, $username] = $this->createUsersOfUsernameDataProviderModels(...func_get_args());

        RankHighest::factory()->create([
            'rank' => 101,
            'user_id' => $user,
        ]);

        $this->assertTrue(UsernameValidation::validateUsersOfUsername($username)->isEmpty());
    }

    /**
     * @dataProvider usersOfUsernameDataProvider
     */
    public function testValidateUsersOfUsernameFormerlyTopRanked(): void
    {
        [$user, $username, $expectLookupSuccess]
            = $this->createUsersOfUsernameDataProviderModels(...func_get_args());

        RankHighest::factory()->create([
            'rank' => 100,
            'user_id' => $user,
        ]);

        $this->assertNotSame(
            $expectLookupSuccess,
            UsernameValidation::validateUsersOfUsername($username)->isEmpty(),
        );
    }

    /**
     * @dataProvider usersOfUsernameDataProvider
     */
    public function testValidateUsersOfUsernameHasBadges(): void
    {
        [$user, $username, $expectLookupSuccess]
            = $this->createUsersOfUsernameDataProviderModels(...func_get_args());

        $user->badges()->create([
            'description' => '',
            'image' => '',
        ]);

        $this->assertNotSame(
            $expectLookupSuccess,
            UsernameValidation::validateUsersOfUsername($username)->isEmpty(),
        );
    }

    /**
     * @dataProvider usersOfUsernameDataProvider
     */
    public function testValidateUsersOfUsernameHasRankedBeatmapsets(): void
    {
        [$user, $username, $expectLookupSuccess]
            = $this->createUsersOfUsernameDataProviderModels(...func_get_args());

        Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['ranked'],
            'user_id' => $user,
        ]);

        $this->assertNotSame(
            $expectLookupSuccess,
            UsernameValidation::validateUsersOfUsername($username)->isEmpty(),
        );
    }

    /**
     * Data in order:
     * - Username
     * - Whether the username should be valid
     */
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

    /**
     * Data in order:
     * - Whether the user lookup should be done through username change history
     * - Whether the user lookup should have its underscores replaced with spaces
     * - Whether the user lookup should return the user
     */
    public function usersOfUsernameDataProvider(): array
    {
        return [
            [true,  true,  false],
            [true,  false, true],
            [false, true,  true],
            [false, false, true],
        ];
    }

    /**
     * Create a user and username for lookup based on input from
     * `usersOfUsernameDataProvider()`.
     */
    private function createUsersOfUsernameDataProviderModels(
        bool $throughUsernameHistory,
        bool $underscoresReplaced,
        bool $lookupShouldSucceed,
    ): array {
        $username = 'username_1';
        $user = User::factory()->create([
            'username' => $username,
            'username_clean' => $username,
        ]);

        if ($throughUsernameHistory) {
            $username = "Old_{$username}";
            $user->usernameChangeHistory()->create([
                'username' => $user->username,
                'username_last' => $username,
            ]);
        }

        if ($underscoresReplaced) {
            $username = str_replace('_', ' ', $username);
        }

        return [$user, $username, $lookupShouldSucceed];
    }
}
