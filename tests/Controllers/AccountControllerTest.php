<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\User;
use App\Models\UserProfileCustomization;
use App\Models\WeakPassword;
use Hash;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    private $user;

    /**
     * Checks whether an OK status is returned when the
     * profile order update request is valid.
     */
    public function testValidProfileOrderChangeRequest()
    {
        $newOrder = UserProfileCustomization::SECTIONS;
        seeded_shuffle($newOrder);

        $this->actingAsVerified($this->user())
            ->json('PUT', route('account.options'), [
                'order' => $newOrder,
            ])
            ->assertJsonFragment(['profile_order' => $newOrder]);
    }

    public function testDuplicatesInProfileOrder()
    {
        $newOrder = UserProfileCustomization::SECTIONS;

        $newOrderWithDuplicate = $newOrder;
        $newOrderWithDuplicate[] = $newOrder[0];

        $this->actingAsVerified($this->user())
            ->json('PUT', route('account.options'), [
                'order' => $newOrderWithDuplicate,
            ])
            ->assertJsonFragment(['profile_order' => $newOrder]);
    }

    public function testInvalidIdsInProfileOrder()
    {
        $newOrder = UserProfileCustomization::SECTIONS;

        $newOrderWithInvalid = $newOrder;
        $newOrderWithInvalid[] = 'test';

        $this->actingAsVerified($this->user())
            ->json('PUT', route('account.options'), [
                'order' => $newOrderWithInvalid,
            ])
            ->assertJsonFragment(['profile_order' => $newOrder]);
    }

    public function testUpdateEmail()
    {
        $newEmail = 'new-'.$this->user->user_email;

        $this->actingAsVerified($this->user())
            ->json('PUT', route('account.email'), [
                'user' => [
                    'current_password' => 'password',
                    'user_email' => $newEmail,
                    'user_email_confirmation' => $newEmail,
                ],
            ])
            ->assertSuccessful();

        $this->assertSame($newEmail, $this->user->fresh()->user_email);

        // FIXME: add test to check there's mail sent
    }

    public function testUpdateEmailInvalidPassword()
    {
        $newEmail = 'new-'.$this->user->user_email;

        $this->actingAsVerified($this->user())
            ->json('PUT', route('account.email'), [
                'user' => [
                    'current_password' => 'password1',
                    'user_email' => $newEmail,
                    'user_email_confirmation' => $newEmail,
                ],
            ])
            ->assertStatus(422);
    }

    public function testUpdatePassword()
    {
        $newPassword = 'newpassword';

        $this->actingAsVerified($this->user())
            ->json('PUT', route('account.password'), [
                'user' => [
                    'current_password' => 'password',
                    'password' => $newPassword,
                    'password_confirmation' => $newPassword,
                ],
            ])
            ->assertSuccessful();

        $this->assertTrue(Hash::check($newPassword, $this->user->fresh()->user_password));
    }

    public function testUpdatePasswordInvalidCurrentPassword()
    {
        $this->actingAsVerified($this->user())
            ->json('PUT', route('account.password'), [
                'user' => [
                    'current_password' => 'notpassword',
                    'password' => 'newpassword',
                    'password_confirmation' => 'newpassword',
                ],
            ])
            ->assertStatus(422);
    }

    public function testUpdatePasswordInvalidPasswordConfirmation()
    {
        $this->actingAsVerified($this->user())
            ->json('PUT', route('account.password'), [
                'user' => [
                    'current_password' => 'password',
                    'password' => 'newpassword',
                    'password_confirmation' => 'oldpassword',
                ],
            ])
            ->assertStatus(422);
    }

    public function testUpdatePasswordUsernameAsPassword()
    {
        $this->actingAsVerified($this->user())
            ->json('PUT', route('account.password'), [
                'user' => [
                    'current_password' => 'password',
                    'password' => $this->user->username,
                    'password_confirmation' => $this->user->username,
                ],
            ])
            ->assertStatus(422);
    }

    public function testUpdatePasswordShortPassword()
    {
        $this->actingAsVerified($this->user())
            ->json('PUT', route('account.password'), [
                'user' => [
                    'current_password' => 'password',
                    'password' => '1234567',
                    'password_confirmation' => '1234567',
                ],
            ])
            ->assertStatus(422);
    }

    public function testUpdatePasswordWeakPassword()
    {
        $weakPassword = 'weakpassword';

        WeakPassword::add($weakPassword);

        $this->actingAsVerified($this->user())
            ->json('PUT', route('account.password'), [
                'user' => [
                    'current_password' => 'password',
                    'password' => $weakPassword,
                    'password_confirmation' => $weakPassword,
                ],
            ])
            ->assertStatus(422);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    private function user()
    {
        // To reset all the verify toggles.
        return $this->user->fresh();
    }
}
