<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
use App\Libraries\ChangeUsername;
use App\Models\User;
use Carbon\Carbon;

class ChangeUsernameTest extends TestCase
{
    public function testUserHasNeverSupported()
    {
        $user = $this->createUser(['osu_subscriptionexpiry' => null]);

        $errors = $user->validateChangeUsername('newusername', 'paid')->all();
        $expected = [ChangeUsername::requireSupportedMessage()];

        $this->assertArrayHasKey('username', $errors);
        $this->assertArraySubset($expected, $errors['username'], true);
    }

    public function testUsernameIsSame()
    {
        $user = $this->createUser();

        $errors = $user->validateChangeUsername('iamuser', 'paid')->all();
        $expected = [trans('model_validation.user.change_username.username_is_same')];

        $this->assertArrayHasKey('username', $errors);
        $this->assertArraySubset($expected, $errors['username'], true);
    }

    public function testUserHasSupportedButExpired()
    {
        $user = $this->createUser(['osu_subscriptionexpiry' => Carbon::now()->subMonth()]);

        $errors = $user->validateChangeUsername('newusername', 'paid');

        $this->assertTrue($errors->isEmpty());
    }

    private function createUser(array $attribs = []) : User
    {
        return factory(User::class)->create(array_merge([
            'username' => 'iamuser',
            'username_clean' => 'iamuser',
            'osu_subscriptionexpiry' => Carbon::now()->addMonth(),
        ], $attribs));
    }
}
