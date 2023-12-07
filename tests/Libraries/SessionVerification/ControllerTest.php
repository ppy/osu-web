<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\SessionVerification;

use App\Libraries\Session\Store as SessionStore;
use App\Libraries\SessionVerification;
use App\Models\LoginAttempt;
use App\Models\User;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    public function testIssue()
    {
        $user = User::factory()->create();

        $this
            ->be($user)
            ->get(route('account.edit'))
            ->assertStatus(401)
            ->assertViewIs('users.verify');

        $record = LoginAttempt::find('127.0.0.1');

        $this->assertTrue($record->containsUser($user, 'verify'));
        $this->assertFalse(\Session::isVerified());
    }

    public function testVerify()
    {
        $user = User::factory()->create();
        $session = \Session::instance();

        $this
            ->be($user)
            ->withPersistentSession($session)
            ->get(route('account.edit'))
            ->assertStatus(401)
            ->assertViewIs('users.verify');

        $key = SessionVerification\State::fromSession($session)->key;

        $this
            ->withPersistentSession($session)
            ->post(route('account.verify'), ['verification_key' => $key])
            ->assertSuccessful();

        $record = LoginAttempt::find('127.0.0.1');

        $this->assertFalse($record->containsUser($user, 'verify-mismatch:'));
        $this->assertTrue($session->isVerified());
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

        $linkKey = SessionVerification\State::fromSession($session)->linkKey;

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

    public function testVerifyMismatch()
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
}
