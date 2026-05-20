<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Http\Middleware\ThrottleRequests;
use App\Libraries\User\PasswordResetData;
use App\Mail\PasswordReset;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PasswordResetControllerTest extends TestCase
{
    private string $origCacheDefault;

    private static function randomPassword(): string
    {
        return str_random(10);
    }

    public function testCreate()
    {
        $user = User::factory()->create();

        Mail::fake();
        $this
            ->post($this->path(), ['username' => $user->username])
            ->assertRedirect(route('password-reset.reset', ['username' => $user->username]));
        Mail::assertQueued(PasswordReset::class);
    }

    public function testCreateWithEmail()
    {
        $user = User::factory()->create();

        Mail::fake();
        $this
            ->post($this->path(), ['username' => $user->user_email])
            ->assertRedirect(route('password-reset.reset', ['username' => $user->user_email]));
        Mail::assertQueued(PasswordReset::class);
    }

    public function testCreateInvalidUser()
    {
        Mail::fake();
        $this->post($this->path(), ['username' => '_invaliduser'])->assertStatus(422);
        Mail::assertNothingOutgoing();
    }

    public function testCreateSendMailOnce()
    {
        $user = User::factory()->create();

        Mail::fake();
        $this->post($this->path(), ['username' => $user->username])->assertRedirect();
        $this->post($this->path(), ['username' => $user->username])->assertRedirect();
        Mail::assertQueuedCount(1);
    }

    public function testCreateSendMailByUsernameParameter()
    {
        $user = User::factory()->create();

        Mail::fake();
        $this->post($this->path(), ['username' => $user->username])->assertRedirect();
        $this->post($this->path(), ['username' => $user->user_email])->assertRedirect();
        Mail::assertQueuedCount(2);
    }

    public function testIndex()
    {
        $this->get($this->path())->assertSuccessful();
    }

    public function testResendMail()
    {
        $user = User::factory()->create();

        Mail::fake();
        $this->generateKey($user);
        $data = PasswordResetData::find($user, $user->username);
        $data->attrs['canResendMailAfter'] = 0;
        $data->save();

        $this->post(route('password-reset.resend-mail', ['username' => $user->username]))->assertSuccessful();
        Mail::assertQueuedCount(2);
    }

    public function testResendMailDuplicate()
    {
        $user = User::factory()->create();

        Mail::fake();
        $this->generateKey($user);

        $this->post(route('password-reset.resend-mail', ['username' => $user->username]))->assertStatus(422);
        Mail::assertQueuedCount(1);
    }

    public function testResendMailNonexistent()
    {
        $user = User::factory()->create();

        Mail::fake();
        $this->post(route('password-reset.resend-mail', ['username' => $user->username]))->assertRedirect($this->path());
        Mail::assertQueuedCount(0);
    }

    public function testReset()
    {
        $this
            ->get(route('password-reset.reset', ['username' => 'test']))
            ->assertSuccessful();
    }

    public function testResetMissingUsername()
    {
        $this
            ->get(route('password-reset.reset'))
            ->assertStatus(422);
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
            'username' => $user->username,
        ])->assertRedirect(route('home'));

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
            'username' => $user->username,
        ])->assertRedirect($this->path())
        ->assertSessionHas('popup', osu_trans('password_reset.error.expired'));

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
        ])->assertRedirect()
        ->assertSessionHas('popup', osu_trans('password_reset.error.invalid'));

        $this->assertTrue($user->fresh()->checkPassword($newPassword));
    }

    public function testUpdateFromInactive(): void
    {
        $changeTime = CarbonImmutable::now()->subMinutes(1);
        $user = User::factory()->create(['user_lastvisit' => $changeTime->subYears(10)]);

        $key = $this->generateKey($user);

        $newPassword = static::randomPassword();

        $this->put($this->path(), [
            'key' => $key,
            'user' => [
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
            ],
            'username' => $user->username,
        ])->assertRedirect(route('home'));

        $user = $user->fresh();
        $this->assertTrue($user->checkPassword($newPassword));
        $this->assertTrue($user->user_lastvisit->greaterThan($changeTime));
    }

    public function testUpdateInvalidUsername()
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
            'username' => "x{$user->username}",
        ])->assertRedirect($this->path())
        ->assertSessionHas('popup', osu_trans('password_reset.error.invalid'));

        $this->assertFalse($user->fresh()->checkPassword($newPassword));
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
            'username' => $user->username,
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
            'username' => $user->username,
        ])->assertStatus(422);

        $this->assertFalse($user->fresh()->checkPassword($newPassword));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(ThrottleRequests::class);
        // There's no easy way to clear data cache in redis otherwise
        $this->origCacheDefault = $GLOBALS['cfg']['cache']['default'];
        config_set('cache.default', 'array');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        config_set('cache.default', $this->origCacheDefault);
    }

    private function generateKey(User $user): string
    {
        $username = $user->username;
        PasswordResetData::find($user, $username)?->delete();
        PasswordResetData::create($user, $username);

        return PasswordResetData::find($user, $username)->attrs['key'];
    }

    private function path(): string
    {
        static $path;

        return $path ??= route('password-reset');
    }
}
