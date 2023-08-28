<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries;

use App\Libraries\UsernameValidation;
use App\Models\Beatmap;
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
     * @dataProvider usersOfUsernameLookupDataProvider
     */
    public function testValidateUsersOfUsername(
        bool $throughUsernameHistory,
        bool $underscoresReplaced,
        bool $expectLookupSuccess,
    ): void {
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

        // Make the user fail at least one of the checks
        RankHighest::factory()->create([
            'rank' => 100,
            'user_id' => $user,
        ]);

        // The validation should succeed only if the lookup does not
        $this->assertNotSame(
            $expectLookupSuccess,
            UsernameValidation::validateUsersOfUsername($username)->isEmpty(),
        );
    }

    public function testValidateUsersOfUsernameFormerlyAlmostTopRanked(): void
    {
        $user = User
            ::factory()
            ->has(RankHighest::factory()->state(['rank' => 101]))
            ->create();

        $this->assertTrue(UsernameValidation::validateUsersOfUsername($user->username)->isEmpty());
    }

    public function testValidateUsersOfUsernameFormerlyTopRanked(): void
    {
        $user = User
            ::factory()
            ->has(RankHighest::factory()->state(['rank' => 100]))
            ->create();

        $this->assertFalse(UsernameValidation::validateUsersOfUsername($user->username)->isEmpty());
    }

    public function testValidateUsersOfUsernameHasBadges(): void
    {
        $user = User::factory()->create();

        $user->badges()->create([
            'description' => '',
            'image' => '',
        ]);

        $this->assertFalse(UsernameValidation::validateUsersOfUsername($user->username)->isEmpty());
    }

    /**
     * @dataProvider usernameAvailabilityWithBeatmapStateDataProvider
     */
    public function testValidateUsersOfUsernameHasBeatmapsets(string $state, bool $expectValid): void
    {
        $user = User
            ::factory()
            ->has(Beatmapset::factory()->state(['approved' => Beatmapset::STATES[$state]]))
            ->create();

        $this->assertSame(
            $expectValid,
            UsernameValidation::validateUsersOfUsername($user->username)->isEmpty(),
        );
    }

    /**
     * @dataProvider usernameAvailabilityWithBeatmapStateDataProvider
     */
    public function testValidateUsersOfUsernameHasGuestBeatmaps(string $state, bool $expectValid): void
    {
        $user = User::factory()->create();

        Beatmapset
            ::factory()
            ->has(Beatmap::factory()->state([
                'approved' => Beatmapset::STATES[$state],
                'user_id' => $user,
            ]))
            ->create(['approved' => Beatmapset::STATES['ranked']]);

        $this->assertSame(
            $expectValid,
            UsernameValidation::validateUsersOfUsername($user->username)->isEmpty(),
        );
    }

    /**
     * Data in order:
     * - Beatmap or beatmapset state
     * - Whether the username should be available
     */
    public function usernameAvailabilityWithBeatmapStateDataProvider(): array
    {
        return [
            ['graveyard', true],
            ['wip',       true],
            ['pending',   true],
            ['ranked',    false],
            ['approved',  false],
            ['qualified', false],
            ['loved',     false],
        ];
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
    public function usersOfUsernameLookupDataProvider(): array
    {
        return [
            [true,  true,  false],
            [true,  false, true],
            [false, true,  true],
            [false, false, true],
        ];
    }
}
