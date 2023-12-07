<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers\Account;

use App\Libraries\Session\Store as SessionStore;
use App\Models\User;
use Tests\TestCase;

class SessionsControllerTest extends TestCase
{
    public function testDestroyOther(): void
    {
        $user = User::factory()->create();
        $oldSessionId = $this->createVerifiedSession($user)->getId();

        $session = $this->createVerifiedSession($user);

        $this
            ->withPersistentSession($session)
            ->delete(route('account.sessions.destroy', ['session' => $oldSessionId]))
            ->assertSuccessful();

        $sessionIds = SessionStore::ids($user->getKey());
        $this->assertContains($session->getId(), $sessionIds);
        $this->assertNotContains($oldSessionId, $sessionIds);
        $this->assertNull(SessionStore::findOrNew($oldSessionId)->userId());
    }

    public function testDestroyOtherUser(): void
    {
        $otherUser = User::factory()->create();
        $otherUserSessionId = $this->createVerifiedSession($otherUser)->getId();

        $user = User::factory()->create();
        $session = $this->createVerifiedSession($user);

        $this
            ->withPersistentSession($session)
            ->delete(route('account.sessions.destroy', ['session' => $otherUserSessionId]))
            ->assertStatus(404);

        $this->assertSame(
            $otherUser->getKey(),
            SessionStore::findOrNew($otherUserSessionId)->userId(),
        );
    }

    public function testDestroySelf(): void
    {
        $user = User::factory()->create();
        $session = $this->createVerifiedSession($user);
        $sessionId = $session->getId();

        $this
            ->withPersistentSession($session)
            ->delete(route('account.sessions.destroy', ['session' => $sessionId]))
            ->assertSuccessful();

        $this->assertNull(SessionStore::findOrNew($sessionId)->userId());
    }
}
