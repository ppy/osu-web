<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Http\Middleware\ThrottleRequests;
use App\Mail\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PasswordResetControllerTest extends TestCase
{
    private static function randomPassword(): string
    {
        return md5(rand());
    }

    public function testCreate()
    {
        $user = User::factory()->create();

        Mail::fake();
        $this->post($this->path(), ['username' => $user->username])->assertSuccessful();
        Mail::assertQueued(PasswordReset::class);
    }

    public function testCreateWithEmail()
    {
        $user = User::factory()->create();

        Mail::fake();
        $this->post($this->path(), ['username' => $user->user_email])->assertSuccessful();
        Mail::assertQueued(PasswordReset::class);
    }

    public function testCreateInvalidUser()
    {
        Mail::fake();
        $this->post($this->path(), ['username' => '_invaliduser'])->assertStatus(422);
        Mail::assertNothingOutgoing();
    }

    public function testDestroy()
    {
        $user = User::factory()->create();

        $this->post($this->path(), ['username' => $user->user_email]);

        // assert reset password initiated
        $this->get($this->path())->assertSuccessful()->assertViewHas('isStarted', true);

        $this->delete($this->path())->assertRedirect($this->path());

        // assert reset password not initiated
        $this->get($this->path())->assertSuccessful()->assertViewHas('isStarted', false);
    }

    public function testDestroyEmpty()
    {
        $this->delete($this->path())->assertRedirect($this->path());
    }

    public function testIndex()
    {
        $this->get($this->path())->assertSuccessful();
    }

    public function testIndexAfterCreate()
    {
        $user = User::factory()->create();

        $this->get($this->path())->assertSuccessful()->assertViewHas('isStarted', false);
        $this->post($this->path(), ['username' => $user->username])->assertSuccessful();
        $this->get($this->path())->assertSuccessful()->assertViewHas('isStarted', true);
    }

    public function testUpdate()
    {
        $user = User::factory()->create();

        $key = $this->generateKey($user);

        $newPassword = static::randomPassword();

        $this->put($this->path(), [
            'key' => $key,
            'user' => [
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
            ],
        ])->assertSuccessful();

        $this->assertTrue($user->fresh()->checkPassword($newPassword));
    }

    public function testUpdateChangedEmailExternally()
    {
        $password = static::randomPassword();
        $user = User::factory()->create(['password' => $password, 'password_confirmation' => $password]);

        $key = $this->generateKey($user);

        $user->update(['user_email' => "new+{$user->user_email}"]);

        $tryNewPassword = static::randomPassword();

        $this->put($this->path(), [
            'key' => $key,
            'user' => [
                'password' => $tryNewPassword,
                'password_confirmation' => $tryNewPassword,
            ],
        ])->assertJson(fn (AssertableJson $json) => $json->where('message', osu_trans('password_reset.error.expired')));

        $this->assertTrue($user->fresh()->checkPassword($password));
    }

    public function testUpdateChangedPasswordExternally()
    {
        $user = User::factory()->create();

        $key = $this->generateKey($user);

        $newPassword = static::randomPassword();

        $user->update([
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        $tryNewPassword = static::randomPassword();

        $this->put($this->path(), [
            'key' => $key,
            'user' => [
                'password' => $tryNewPassword,
                'password_confirmation' => $tryNewPassword,
            ],
        ])->assertJson(fn (AssertableJson $json) => $json->where('message', osu_trans('password_reset.error.expired')));

        $this->assertTrue($user->fresh()->checkPassword($newPassword));
    }

    public function testUpdateInvalidConfirmation()
    {
        $user = User::factory()->create();

        $key = $this->generateKey($user);

        $newPassword = static::randomPassword();

        $this->put($this->path(), [
            'key' => $key,
            'user' => [
                'password' => $newPassword,
                'password_confirmation' => "{$newPassword}!",
            ],
        ])->assertStatus(422);

        $this->assertFalse($user->fresh()->checkPassword($newPassword));
    }

    public function testUpdateInvalidKey()
    {
        $user = User::factory()->create();

        $this->post($this->path(), ['username' => $user->username]);

        $newPassword = static::randomPassword();

        $this->put($this->path(), [
            'key' => '_invalidkey',
            'user' => [
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
            ],
        ])->assertStatus(422);

        $this->assertFalse($user->fresh()->checkPassword($newPassword));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(ThrottleRequests::class);
    }

    private function generateKey(User $user): string
    {
        Mail::fake();
        $this->post($this->path(), ['username' => $user->username]);

        $key = null;
        Mail::assertQueued(function (PasswordReset $mail) use (&$key) {
            $key = $mail->key;

            return true;
        });

        return $key;
    }

    private function path(): string
    {
        static $path;

        return $path ??= route('password-reset');
    }
}
