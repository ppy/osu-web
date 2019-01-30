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
use App\Exceptions\ChangeUsernameException;
use App\Libraries\ChangeUsername;
use App\Models\User;
use App\Models\UserStatistics;
use Carbon\Carbon;

// FIXME: need more tests
class ChangeUsernameTest extends TestCase
{
    public function testUserCannotBeRenamed()
    {
        $user = $this->createUser(['user_id' => 1]);

        $errors = $user->validateChangeUsername('newusername')->all();
        $this->assertArrayHasKey('user_id', $errors);
    }

    public function testUserHasNeverSupported()
    {
        $user = $this->createUser(['osu_subscriptionexpiry' => null]);

        $errors = $user->validateChangeUsername('newusername')->all();
        $expected = [ChangeUsername::requireSupportedMessage()];

        $this->assertArrayHasKey('username', $errors);
        $this->assertArraySubset($expected, $errors['username'], true);
    }

    public function testUsernameIsSame()
    {
        $user = $this->createUser();

        $errors = $user->validateChangeUsername('iamuser')->all();
        $expected = [trans('model_validation.user.change_username.username_is_same')];

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

    public function testPreviousUserIsRankedLocked()
    {
        config()->set('osu.user.username_lock_rank_limit', 10);
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

        $existing->statisticsOsu()->save(
            factory(UserStatistics\Osu::class)->make(['rank' => 10, 'rank_score_index' => 10, 'playcount' => 0])
        );

        $this->expectException(ChangeUsernameException::class);
        $user->changeUsername($newUsername, 'paid');
    }

    public function testPreviousUserIsNotRankedLocked()
    {
        config()->set('osu.user.username_lock_rank_limit', 9);
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

        $existing->statisticsOsu()->save(
            factory(UserStatistics\Osu::class)->make(['rank' => 10, 'rank_score_index' => 10, 'playcount' => 0])
        );

        $history = $user->changeUsername($newUsername, 'paid');
        $user->refresh();

        $this->assertSame($newUsername, $user->username);
    }

    public function testPreviousUserIsNotRanked()
    {
        config()->set('osu.user.username_lock_rank_limit', 10);
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

        $existing->statisticsOsu()->save(
            factory(UserStatistics\Osu::class)->make(['rank' => 0, 'rank_score_index' => 0, 'playcount' => 0])
        );

        $history = $user->changeUsername($newUsername, 'paid');
        $user->refresh();

        $this->assertSame($newUsername, $user->username);
    }

    public function testInactiveUserIsRankLocked()
    {
        config()->set('osu.user.username_lock_rank_limit', 10);
        $newUsername = 'newusername';

        $user = $this->createUser();
        $existing = $this->createUser([
            'username' => 'newusername',
            'username_clean' => 'newusername',
            'osu_subscriptionexpiry' => null,
            'user_lastvisit' => Carbon::now()->subYear(),
        ]);

        $existing->statisticsOsu()->save(
            factory(UserStatistics\Osu::class)->make(['rank' => 10, 'rank_score_index' => 10, 'playcount' => 0])
        );

        $this->expectException(ChangeUsernameException::class);
        $user->changeUsername($newUsername, 'paid');
    }

    private function createUser(array $attribs = []) : User
    {
        return factory(User::class)->create(array_merge([
            'username' => 'iamuser',
            'username_clean' => 'iamuser',
            'user_lastvisit' => Carbon::now(),
            'osu_subscriptionexpiry' => Carbon::now()->addMonth(),
        ], $attribs));
    }
}
