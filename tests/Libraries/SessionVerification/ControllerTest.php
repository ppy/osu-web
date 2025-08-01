<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\SessionVerification;

use App\Libraries\Session\Store as SessionStore;
use App\Libraries\SessionVerification;
use App\Mail\UserVerification as UserVerificationMail;
use App\Models\LoginAttempt;
use App\Models\OAuth\Client;
use App\Models\OAuth\Token;
use App\Models\User;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    public function testIssue(): void
    {
        \Mail::fake();
        $user = User::factory()->create();

        $this
            ->be($user)
            ->get(route('account.edit'))
            ->assertStatus(401)
            ->assertViewIs('users.verify');

        $record = LoginAttempt::find('127.0.0.1');

        \Mail::assertQueued(UserVerificationMail::class, 1);
        $this->assertTrue($record->containsUser($user, 'verify'));
        $this->assertFalse(\Session::isVerified());
    }

    public function testReissue(): void
    {
        \Mail::fake();
        $user = User::factory()->create();
        $session = \Session::instance();

        $this
            ->be($user)
            ->withPersistentSession($session)
            ->get(route('account.edit'));

        $state = SessionVerification\MailState::fromSession($session);

        $this
            ->withPersistentSession($session)
            ->post(route('account.reissue-code'))
            ->assertSuccessful();

        \Mail::assertQueued(UserVerificationMail::class, 2);
        $this->assertNotSame($state->key, SessionVerification\MailState::fromSession($session)->key);
    }

    public function testReissueOAuthVerified(): void
    {
        \Mail::fake();
        $token = Token::factory()->create(['verified' => true]);

        $this
            ->actingWithToken($token)
            ->post(route('api.verify.reissue'))
            ->assertStatus(422);

        \Mail::assertNotQueued(UserVerificationMail::class);
        $this->assertNull(SessionVerification\MailState::fromSession($token));
    }

    public function testReissueVerified(): void
    {
        \Mail::fake();
        $user = User::factory()->create();
        $session = \Session::instance();
        $session->markVerified();

        $this
            ->be($user)
            ->withPersistentSession($session)
            ->post(route('account.reissue-code'))
            ->assertStatus(422);

        \Mail::assertNotQueued(UserVerificationMail::class);
        $this->assertNull(SessionVerification\MailState::fromSession($session));
    }

    public function testVerify(): void
    {
        $user = User::factory()->create();
        $session = \Session::instance();

        $this
            ->be($user)
            ->withPersistentSession($session)
            ->get(route('account.edit'))
            ->assertStatus(401)
            ->assertViewIs('users.verify');

        $key = SessionVerification\MailState::fromSession($session)->key;

        $this
            ->withPersistentSession($session)
            ->post(route('account.verify'), ['verification_key' => $key])
            ->assertSuccessful();

        $record = LoginAttempt::find('127.0.0.1');

        $this->assertFalse($record->containsUser($user, 'verify-mismatch:'));
        $this->assertTrue($session->isVerified());
        $this->assertNull(SessionVerification\MailState::fromSession($session));
    }

    public function testVerifyLink(): void
    {
        $user = User::factory()->create();
        $session = \Session::instance();
        $sessionId = $session->getId();

        $this
            ->be($user)
            ->withPersistentSession($session)
            ->get(route('account.edit'))
            ->assertStatus(401)
            ->assertViewIs('users.verify');

        $linkKey = SessionVerification\MailState::fromSession($session)->linkKey;

        $guestSession = SessionStore::findOrNew();
        $this
            ->withPersistentSession($guestSession)
            ->get(route('account.verify', ['key' => $linkKey]))
            ->assertSuccessful();

        $record = LoginAttempt::find('127.0.0.1');

        $this->assertFalse($record->containsUser($user, 'verify-mismatch:'));
        $this->assertTrue(SessionStore::findOrNew($sessionId)->isVerified());
    }

    public function testVerifyLinkMismatch(): void
    {
        $user = User::factory()->create();
        $session = \Session::instance();
        $sessionId = $session->getId();

        $this
            ->be($user)
            ->withPersistentSession($session)
            ->get(route('account.edit'))
            ->assertStatus(401)
            ->assertViewIs('users.verify');

        $guestSession = SessionStore::findOrNew();
        $this
            ->withPersistentSession($guestSession)
            ->get(route('account.verify', ['key' => 'invalid']))
            ->assertStatus(404);

        $this->assertFalse(SessionStore::findOrNew($sessionId)->isVerified());
    }

    public function testVerifyLinkOAuth(): void
    {
        $token = Token::factory()->create([
            'client_id' => Client::factory()->create(['password_client' => true]),
            'verified' => false,
        ]);

        $this
            ->actingWithToken($token)
            ->get(route('api.me'))
            ->assertSuccessful();

        $linkKey = SessionVerification\MailState::fromSession($token)->linkKey;

        \Auth::logout();
        $this
            ->withPersistentSession(SessionStore::findOrNew())
            ->get(route('account.verify', ['key' => $linkKey]))
            ->assertSuccessful();

        $record = LoginAttempt::find('127.0.0.1');

        $this->assertFalse($record->containsUser($token->user, 'verify-mismatch:'));
        $this->assertTrue($token->fresh()->isVerified());
    }

    public function testVerifyMismatch(): void
    {
        $user = User::factory()->create();
        $session = \Session::instance();

        $this
            ->be($user)
            ->withPersistentSession($session)
            ->get(route('account.edit'))
            ->assertStatus(401)
            ->assertViewIs('users.verify');

        $record = LoginAttempt::find('127.0.0.1');
        $this->assertFalse($record->containsUser($user, 'verify-mismatch:'));

        $this
            ->withPersistentSession($session)
            ->post(route('account.verify'), ['verification_key' => 'invalid'])
            ->assertStatus(422);

        $record = LoginAttempt::find('127.0.0.1');

        $this->assertTrue($record->containsUser($user, 'verify-mismatch:'));
        $this->assertFalse($session->isVerified());
    }

    public function testVerifyOAuth(): void
    {
        $token = Token::factory()->create([
            'client_id' => Client::factory()->create(['password_client' => true]),
            'verified' => false,
        ]);

        $this
            ->actingWithToken($token)
            ->get(route('api.me'))
            ->assertSuccessful();

        $key = SessionVerification\MailState::fromSession($token)->key;

        $this
            ->actingWithToken($token)
            ->post(route('api.verify', ['verification_key' => $key]))
            ->assertSuccessful();

        $record = LoginAttempt::find('127.0.0.1');

        $this->assertFalse($record->containsUser($token->user, 'verify-mismatch:'));
        $this->assertTrue($token->fresh()->isVerified());
    }

    public function testVerifyOAuthVerified(): void
    {
        \Mail::fake();
        $token = Token::factory()->create(['verified' => true]);

        $this
            ->actingWithToken($token)
            ->post(route('api.verify', ['verification_key' => 'invalid']))
            ->assertSuccessful();

        $this->assertNull(SessionVerification\MailState::fromSession($token));
        \Mail::assertNotQueued(UserVerificationMail::class);
    }

    public function testVerifyVerified(): void
    {
        \Mail::fake();
        $user = User::factory()->create();
        $session = \Session::instance();
        $session->markVerified();

        $this
            ->be($user)
            ->withPersistentSession($session)
            ->post(route('account.verify'), ['verification_key' => 'invalid'])
            ->assertSuccessful();

        $this->assertNull(SessionVerification\MailState::fromSession($session));
        \Mail::assertNotQueued(UserVerificationMail::class);
    }
}
