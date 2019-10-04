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

use App\Exceptions\ValidationException;
use App\Libraries\UserRegistration;
use App\Models\User;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    public function testBasicFunctionality()
    {
        $attrs = $this->basicAttributes();

        $origCount = User::count();
        $reg = new UserRegistration($attrs);
        $thrown = $this->runSubject($reg);

        $this->assertFalse($thrown);
        $this->assertSame($origCount + 1, User::count());
    }

    public function testRequiresUsername()
    {
        $attrs = $this->basicAttributes();
        unset($attrs['username']);

        $origCount = User::count();
        $reg = new UserRegistration($attrs);
        $thrown = $this->runSubject($reg);

        $this->assertTrue($thrown);
        $this->assertArraySubset(
            $reg->user()->validationErrors()->all(),
            [
                'username' => [trans('model_validation.required', [
                    'attribute' => trans('model_validation.user.attributes.username'),
                ])],
            ]
        );
        $this->assertSame($origCount, User::count());
    }

    public function testStoreRequiresEmail()
    {
        $attrs = $this->basicAttributes();
        unset($attrs['user_email']);

        $origCount = User::count();
        $reg = new UserRegistration($attrs);
        $thrown = $this->runSubject($reg);

        $this->assertTrue($thrown);
        $this->assertArraySubset(
            $reg->user()->validationErrors()->all(),
            [
                'user_email' => [trans('model_validation.required', [
                    'attribute' => trans('model_validation.user.attributes.user_email'),
                ])],
            ]
        );
        $this->assertSame($origCount, User::count());
    }

    public function testStoreRequiresPassword()
    {
        $attrs = $this->basicAttributes();
        unset($attrs['password']);

        $origCount = User::count();
        $reg = new UserRegistration($attrs);
        $thrown = $this->runSubject($reg);

        $this->assertTrue($thrown);
        $this->assertArraySubset(
            $reg->user()->validationErrors()->all(),
            [
                'password' => [trans('model_validation.required', [
                    'attribute' => trans('model_validation.user.attributes.password'),
                ])],
            ]
        );
        $this->assertSame($origCount, User::count());
    }

    // wrapper to catch the exception
    // so that the contents of validationErrors can be examined.
    private function runSubject($subject)
    {
        try {
            $subject->save();
        } catch (ValidationException $e) {
            return true;
        }

        return false;
    }

    private function basicAttributes()
    {
        return [
            'username' => 'user1',
            'password' => 'hunter22',
            'user_email' => 'user1@example.com',
        ];
    }
}
