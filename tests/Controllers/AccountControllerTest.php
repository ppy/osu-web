<?php

use App\Libraries\UserVerification;
use App\Models\User;
use App\Models\UserProfileCustomization;
use App\Models\WeakPassword;

class AccountControllerTest extends TestCase
{
    public static function tearDownAfterClass()
    {
        gc_collect_cycles();
    }

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * Checks whether an OK status is returned when the
     * profile order update request is valid.
     */
    public function testValidProfileOrderChangeRequest()
    {
        $newOrder = UserProfileCustomization::SECTIONS;
        seeded_shuffle($newOrder);

        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.update'), [
                'order' => $newOrder,
            ])
            ->assertJsonFragment(['profileOrder' => $newOrder]);
    }

    public function testDuplicatesInProfileOrder()
    {
        $newOrder = UserProfileCustomization::SECTIONS;

        $newOrderWithDuplicate = $newOrder;
        $newOrderWithDuplicate[] = $newOrder[0];

        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.update'), [
                'order' => $newOrderWithDuplicate,
            ])
            ->assertJsonFragment(['profileOrder' => $newOrder]);
    }

    public function testInvalidIdsInProfileOrder()
    {
        $newOrder = UserProfileCustomization::SECTIONS;

        $newOrderWithInvalid = $newOrder;
        $newOrderWithInvalid[] = 'test';

        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.update'), [
                'order' => $newOrderWithInvalid,
            ])
            ->assertJsonFragment(['profileOrder' => $newOrder]);
    }

    public function testUpdateEmail()
    {
        $newEmail = 'new-'.$this->user->user_email;

        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.email'), [
                'user_email' => [
                    'current_password' => 'password',
                    'email' => $newEmail,
                    'email_confirmation' => $newEmail,
                ],
            ])
            ->assertStatus(200);

        $this->assertSame($newEmail, $this->user->fresh()->user_email);

        // FIXME: add test to check there's mail sent
    }

    public function testUpdateEmailInvalidPassword()
    {
        $newEmail = 'new-'.$this->user->user_email;

        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.email'), [
                'user_email' => [
                    'current_password' => 'password1',
                    'email' => $newEmail,
                    'email_confirmation' => $newEmail,
                ],
            ])
            ->assertStatus(422);
    }

    public function testUpdatePassword()
    {
        $newPassword = 'newpassword';

        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.password'), [
                'user_password' => [
                    'current_password' => 'password',
                    'password' => $newPassword,
                    'password_confirmation' => $newPassword,
                ],
            ])
            ->assertStatus(200);

        $this->assertTrue(Hash::check($newPassword, $this->user->fresh()->user_password));
    }

    public function testUpdatePasswordInvalidCurrentPassword()
    {
        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.password'), [
                'user_password' => [
                    'current_password' => 'notpassword',
                    'password' => 'newpassword',
                    'password_confirmation' => 'newpassword',
                ],
            ])
            ->assertStatus(422);
    }

    public function testUpdatePasswordInvalidPasswordConfirmation()
    {
        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.password'), [
                'user_password' => [
                    'current_password' => 'password',
                    'password' => 'newpassword',
                    'password_confirmation' => 'oldpassword',
                ],
            ])
            ->assertStatus(422);
    }

    public function testUpdatePasswordUsernameAsPassword()
    {
        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.password'), [
                'user_password' => [
                    'current_password' => 'password',
                    'password' => $this->user->username,
                    'password_confirmation' => $this->user->username,
                ],
            ])
            ->assertStatus(422);
    }

    public function testUpdatePasswordShortPassword()
    {
        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.password'), [
                'user_password' => [
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

        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.password'), [
                'user_password' => [
                    'current_password' => 'password',
                    'password' => $weakPassword,
                    'password_confirmation' => $weakPassword,
                ],
            ])
            ->assertStatus(422);
    }
}
