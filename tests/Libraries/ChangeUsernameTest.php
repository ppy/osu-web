<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Exceptions\ChangeUsernameException;
use App\Libraries\ChangeUsername;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

// FIXME: need more tests
class ChangeUsernameTest extends TestCase
{
    public function testUserCannotBeRenamed()
    {
        $user = $this->createUser(['user_id' => 1]);

        $errors = $user->validateChangeUsername('newusername')->all();
        $this->assertArrayHasKey('user_id', $errors);
    }

    public function testUserIsRestricted()
    {
        $user = $this->createUser(['user_warnings' => 1]);

        $errors = $user->validateChangeUsername('newusername')->all();
        $expected = [osu_trans('model_validation.user.change_username.restricted')];

        $this->assertArrayHasKey('username', $errors);
        $this->assertArraySubset($expected, $errors['username'], true);
    }

    public function testSupportCanChangeEvenIfUserIsRestricted()
    {
        $user = $this->createUser(['user_warnings' => 1]);

        $errors = $user->validateChangeUsername('newusername', 'support')->all();

        $this->assertEmpty($errors);
    }

    public function testUserHasNeverSupported()
    {
        $user = $this->createUser(['osu_subscriptionexpiry' => null]);

        $errors = $user->validateChangeUsername('newusername')->all();
        $expected = [ChangeUsername::requireSupportedMessage()];

        $this->assertArrayHasKey('username', $errors);
        $this->assertArraySubset($expected, $errors['username'], true);
    }

    public function testSupportCanChangeEvenIfUserHasNeverSupported()
    {
        $user = $this->createUser(['osu_subscriptionexpiry' => null]);

        $errors = $user->validateChangeUsername('newusername', 'support')->all();

        $this->assertEmpty($errors);
    }

    public function testUsernameIsSame()
    {
        $user = $this->createUser();

        $errors = $user->validateChangeUsername('iamuser')->all();
        $expected = [osu_trans('model_validation.user.change_username.username_is_same')];

        $this->assertArrayHasKey('username', $errors);
        $this->assertArraySubset($expected, $errors['username'], true);
    }

    public function testUsernameWithDifferentCasingIsSame()
    {
        $user = $this->createUser();

        $errors = $user->validateChangeUsername('iAmUser')->all();
        $expected = [osu_trans('model_validation.user.change_username.username_is_same')];

        $this->assertArrayHasKey('username', $errors);
        $this->assertArraySubset($expected, $errors['username'], true);
    }

    public function testUserHasSupportedButExpired()
    {
        $user = $this->createUser(['osu_subscriptionexpiry' => Carbon::now()->subMonth()]);

        $errors = $user->validateChangeUsername('newusername');

        $this->assertTrue($errors->isEmpty());
    }

    public function testUsernameTakenButInactive()
    {
        $user = $this->createUser();
        $existing = $this->createUser([
            'username' => 'newusername',
            'username_clean' => 'newusername',
            'osu_subscriptionexpiry' => null,
            'user_lastvisit' => Carbon::now()->subYear(),
        ]);

        $user->changeUsername('newusername', 'paid');

        $user->refresh();
        $existing->refresh();
        $historyExists = $existing->usernameChangeHistory()
            ->where('username_last', 'newusername')
            ->where('type', 'inactive')
            ->exists();

        $this->assertSame('newusername', $user->username);
        $this->assertSame('newusername_old', $existing->username);
        $this->assertTrue($historyExists);
    }

    public function testUsernameTakenButInactiveAndNeedsMoreRenames()
    {
        $user = $this->createUser();
        $existing = $this->createUser([
            'username' => 'newusername',
            'username_clean' => 'newusername',
            'osu_subscriptionexpiry' => null,
            'user_lastvisit' => Carbon::now()->subYear(),
        ]);
        $this->createUser([
            'username' => 'newusername_old',
            'username_clean' => 'newusername_old',
            'osu_subscriptionexpiry' => null,
            'user_lastvisit' => Carbon::now()->subYear(),
        ]);

        $user->changeUsername('newusername', 'paid');

        $user->refresh();
        $existing->refresh();
        $historyExists = $existing->usernameChangeHistory()
            ->where('username_last', 'newusername')
            ->where('type', 'inactive')
            ->exists();

        $this->assertSame('newusername', $user->username);
        $this->assertSame('newusername_old_1', $existing->username);
        $this->assertTrue($historyExists);
    }

    public function testPreviousUserHasBadge()
    {
        $newUsername = 'newusername';

        $user = $this->createUser();
        $existing = $this->createUser([
            'username' => 'existing_now',
            'username_clean' => 'existing_now',
            'osu_subscriptionexpiry' => null,
        ]);

        $existing->usernameChangeHistory()->create([
            'username' => 'existing_now',
            'username_last' => $newUsername,
            'timestamp' => Carbon::now()->subYear(),
            'type' => 'paid',
        ]);

        $existing->badges()->create(['image' => 'test', 'description' => 'test', 'awarded' => now()]);

        $this->expectException(ChangeUsernameException::class);
        $user->changeUsername($newUsername, 'paid');
    }

    public function testPreviousUserHasNoBadge()
    {
        $newUsername = 'newusername';

        $user = $this->createUser();
        $existing = $this->createUser([
            'username' => 'existing_now',
            'username_clean' => 'existing_now',
            'osu_subscriptionexpiry' => null,
        ]);

        $existing->usernameChangeHistory()->create([
            'username' => 'existing_now',
            'username_last' => $newUsername,
            'timestamp' => Carbon::now()->subYear(),
            'type' => 'paid',
        ]);

        $user->changeUsername($newUsername, 'paid');
        $user->refresh();

        $this->assertSame($newUsername, $user->username);
    }

    public function testInactiveUserHasBadge()
    {
        $newUsername = 'newusername';

        $user = $this->createUser();
        $existing = $this->createUser([
            'username' => 'newusername',
            'username_clean' => 'newusername',
            'osu_subscriptionexpiry' => null,
            'user_lastvisit' => Carbon::now()->subYear(),
        ]);

        $existing->badges()->create(['image' => 'test', 'description' => 'test', 'awarded' => now()]);

        $this->expectException(ChangeUsernameException::class);
        $user->changeUsername($newUsername, 'paid');
    }

    private function createUser(array $attribs = []): User
    {
        return User::factory()->create(array_merge([
            'username' => 'iamuser',
            'username_clean' => 'iamuser',
            'user_lastvisit' => Carbon::now(),
            'osu_subscriptionexpiry' => Carbon::now()->addMonth(),
        ], $attribs));
    }
}
