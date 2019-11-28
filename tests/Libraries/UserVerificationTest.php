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

use App\Libraries\UserVerification;
use App\Models\LoginAttempt;
use App\Models\User;
use Tests\TestCase;

class UserVerificationTest extends TestCase
{
    public function testIssue()
    {
        $user = factory(User::class)->create();

        $this
            ->be($user)
            ->get(route('account.edit'))
            ->assertStatus(401)
            ->assertViewIs('users.verify');

        $record = LoginAttempt::find('127.0.0.1');

        $this->assertTrue($record->containsUser($user, 'verify'));
        $this->assertFalse(UserVerification::fromCurrentRequest()->isDone());
    }

    public function testVerify()
    {
        $user = factory(User::class)->create();

        $this
            ->be($user)
            ->get(route('account.edit'))
            ->assertStatus(401)
            ->assertViewIs('users.verify');

        $key = session()->get('verification_key');

        $this
            ->post(route('account.verify'), ['verification_key' => $key])
            ->assertSuccessful();

        $record = LoginAttempt::find('127.0.0.1');

        $this->assertFalse($record->containsUser($user, 'verify-mismatch:'));
        $this->assertTrue(UserVerification::fromCurrentRequest()->isDone());
    }

    public function testVerifyMismatch()
    {
        $user = factory(User::class)->create();

        $this
            ->be($user)
            ->get(route('account.edit'))
            ->assertStatus(401)
            ->assertViewIs('users.verify');

        $record = LoginAttempt::find('127.0.0.1');
        $this->assertFalse($record->containsUser($user, 'verify-mismatch:'));

        $this
            ->post(route('account.verify'), ['verification_key' => 'invalid'])
            ->assertStatus(422);

        $record = LoginAttempt::find('127.0.0.1');

        $this->assertTrue($record->containsUser($user, 'verify-mismatch:'));
        $this->assertFalse(UserVerification::fromCurrentRequest()->isDone());
    }
}
