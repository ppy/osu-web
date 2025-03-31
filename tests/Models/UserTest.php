<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Libraries\Session\Store;
use App\Models\OAuth\Token;
use App\Models\User;
use App\Models\UsernameChangeHistory;
use Carbon\CarbonImmutable;
use Database\Factories\OAuth\RefreshTokenFactory;
use Tests\TestCase;

class UserTest extends TestCase
{
    public static function dataProviderForAttributeTwitter(): array
    {
        return [
            ['@hello', 'hello'],
            ['hello', 'hello'],
            ['@', null],
            ['', null],
            [null, null],
        ];
    }

    public static function dataProviderForUsernameChangeCost()
    {
        return [
            [0, 0],
            [1, 8],
            [2, 16],
            [3, 32],
            [4, 64],
            [5, 100],
            [6, 100],
            [10, 100],
        ];
    }

    public static function dataProviderForUsernameChangeCostType()
    {
        return [
            ['admin', 0],
            ['inactive', 0],
            ['paid', 8],
            ['revert', 0],
            ['support', 8],
        ];
    }

    public static function dataProviderForUsernameChangeCostWindow()
    {
        // years with no name changes, cost
        // test is setup with name change every 6 months.
        return [
            [0, 100],
            [1, 32],
            [2, 8],
            [3, 8],
            [4, 8],
        ];
    }

    public static function dataProviderValidDiscordUsername(): array
    {
        return [
            ['username', true],
            ['user_name', true],
            ['user.name', true],
            ['user2name', true],
            ['u_sernam.e1337', true],
            ['username#', false],
            ['u', false],
            ['morethan32characterinthisusername', false], // 33 characters

            // old format
            ['username#1337', true],
            ['ユーザー名#1337', true],
            ['username#1', false],
            ['username#13bb', false],
            ['username#abcd', false],
            ['user@name#1337', false],
            ['user#name#1337', false],
            ['user:name#1337', false],
        ];
    }

    /**
     * @dataProvider dataProviderForAttributeTwitter
     */
    public function testAttributeTwitter($setValue, $getValue)
    {
        $user = new User(['user_twitter' => $setValue]);

        $this->assertSame($getValue, $user->user_twitter);
    }

    public function testEmailLoginDisabled()
    {
        config_set('osu.user.allow_email_login', false);
        User::factory()->create([
            'username' => 'test',
            'user_email' => 'test@example.org',
        ]);

        $this->assertNull(User::findForLogin('test@example.org'));
    }

    public function testEmailLoginEnabled()
    {
        config_set('osu.user.allow_email_login', true);
        $user = User::factory()->create([
            'username' => 'test',
            'user_email' => 'test@example.org',
        ]);

        $this->assertTrue($user->is(User::findForLogin('test@example.org')));
    }

    public function testResetSessions(): void
    {
        $user = User::factory()->create();

        // create session
        $this->post(route('login'), ['username' => $user->username, 'password' => User::factory()::DEFAULT_PASSWORD]);
        // sanity check
        $this->assertNotEmpty(Store::ids($user->getKey()));

        // create token
        $token = Token::factory()->create(['user_id' => $user, 'revoked' => false]);
        $refreshToken = (new RefreshTokenFactory())->create(['access_token_id' => $token, 'revoked' => false]);

        $user->resetSessions();

        $this->assertEmpty(Store::ids($user->getKey()));
        $this->assertTrue($token->fresh()->revoked);
        $this->assertTrue($refreshToken->fresh()->revoked);
    }

    public function testUsernameAvailableAtForDefaultGroup()
    {
        config_set('osu.user.allowed_rename_groups', ['default']);
        $allowedAtUpTo = now()->addYearsNoOverflow(5);
        $user = User::factory()->withGroup('default')->create();

        $this->assertLessThanOrEqual($allowedAtUpTo, $user->getUsernameAvailableAt());
    }

    public function testUsernameAvailableAtForNonDefaultGroup()
    {
        config_set('osu.user.allowed_rename_groups', ['default']);
        $allowedAt = now()->addYearsNoOverflow(10);
        $user = User::factory()->withGroup('gmt')->create(['group_id' => app('groups')->byIdentifier('default')]);

        $this->assertGreaterThanOrEqual($allowedAt, $user->getUsernameAvailableAt());
    }

    /**
     * @dataProvider dataProviderForUsernameChangeCost
     */
    public function testUsernameChangeCost(int $changes, int $cost)
    {
        $user = User::factory()
            ->has(UsernameChangeHistory::factory()->count($changes))
            ->create();

        $this->assertSame($cost, $user->usernameChangeCost());
    }

    public function testUsernameChangeCostMultiple()
    {
        $user = User::factory()->create();

        $this->assertSame(0, $user->usernameChangeCost());

        $user->usernameChangeHistory()->create([
            'timestamp' => CarbonImmutable::now(),
            'type' => 'paid',
            'username' => 'marty',
        ]);

        // 1 change in last 3 years
        $this->travelTo(CarbonImmutable::now()->addYearsNoOverflow(3));
        $this->assertSame(8, $user->usernameChangeCost());

        // 0 changes in last 3 years
        $this->travelTo(CarbonImmutable::now()->addYearsNoOverflow(1));
        $this->assertSame(8, $user->usernameChangeCost());

        $user->usernameChangeHistory()->create([
            'timestamp' => CarbonImmutable::now(),
            'type' => 'paid',
            'username' => 'mcfly',
        ]);

        // 1 change in last 3 years
        $this->assertSame(8, $user->usernameChangeCost());

        $user->usernameChangeHistory()->create([
            'timestamp' => CarbonImmutable::now(),
            'type' => 'paid',
            'username' => 'futuremarty',
        ]);

        // 2 changes in last 3 years
        $this->assertSame(16, $user->usernameChangeCost());

        // 1 changes in last 3 years
        $this->travelTo(CarbonImmutable::now()->addYearsNoOverflow(3));
        $this->assertSame(8, $user->usernameChangeCost());
        // 0 changes in last 3 years
        $this->travelTo(CarbonImmutable::now()->addYearsNoOverflow(1));
        $this->assertSame(8, $user->usernameChangeCost());
    }

    /**
     * @dataProvider dataProviderForUsernameChangeCostType
     */
    public function testUsernameChangeCostType(string $type, int $cost)
    {
        $user = User::factory()
            ->has(UsernameChangeHistory::factory()->state(['type' => $type]))
            ->create();

        $this->assertSame($cost, $user->usernameChangeCost());
    }

    /**
     * @dataProvider dataProviderForUsernameChangeCostWindow
     */
    public function testUsernameChangeCostWindow(int $years, int $cost)
    {
        $now = CarbonImmutable::now();
        $this->travelTo(CarbonImmutable::now()->subYearsNoOverflow(3));

        $user = User::factory()->create();
        // every 6 months for 3 years = 6
        // using isBefore to setup adds too many when run at month boundaries.
        for ($i = 0; $i < 6; $i++) {
            $user->usernameChangeHistory()->create([
                'timestamp' => CarbonImmutable::now(),
                'type' => 'paid',
                'username' => 'marty',
            ]);

            $this->travelTo(CarbonImmutable::now()->addMonthsNoOverflow(6));
        }

        $this->travelTo($now->addYearsNoOverflow($years));
        $this->assertSame($cost, $user->usernameChangeCost());
    }

    /**
     * @dataProvider dataProviderValidDiscordUsername
     */
    public function testValidDiscordUsername(string $username, bool $valid)
    {
        $user = User::factory()->make();
        $user->user_discord = $username;

        $this->assertSame($valid, $user->isValid());

        if (!$valid) {
            $this->assertArrayHasKey('user_discord', $user->validationErrors()->all());
        }
    }
}
