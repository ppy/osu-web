<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        $this->assertTrue($reg->user()->userGroups->every(function ($userGroup) {
            return $userGroup->user_pending === false;
        }));
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
                'username' => [osu_trans('model_validation.required', [
                    'attribute' => osu_trans('model_validation.user.attributes.username'),
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
                'user_email' => [osu_trans('model_validation.required', [
                    'attribute' => osu_trans('model_validation.user.attributes.user_email'),
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
                'password' => [osu_trans('model_validation.required', [
                    'attribute' => osu_trans('model_validation.user.attributes.password'),
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
