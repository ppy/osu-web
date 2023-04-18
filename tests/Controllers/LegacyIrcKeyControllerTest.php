<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\LegacyIrcKey;
use App\Models\User;
use Tests\TestCase;

class LegacyIrcKeyControllerTest extends TestCase
{
    public function testDestroy(): void
    {
        $key = LegacyIrcKey::factory()->create();
        $user = $key->user;

        $this->expectCountChange(fn () => $user->legacyIrcKey()->count(), -1);

        $this
            ->actingAsVerified($user)
            ->delete(route('legacy-irc-key.destroy'))
            ->assertSuccessful();
    }

    public function testDestroyWithoutExisting(): void
    {
        $user = User::factory()->create();

        $this->expectCountChange(fn () => $user->legacyIrcKey()->count(), 0);

        $this
            ->actingAsVerified($user)
            ->delete(route('legacy-irc-key.destroy'))
            ->assertSuccessful();
    }

    public function testDestroyGuest(): void
    {
        $this->delete(route('legacy-irc-key.destroy'))->assertStatus(401);
    }

    public function testStore(): void
    {
        $user = User::factory()->withPlays(100)->create();

        $this->expectCountChange(fn () => $user->legacyIrcKey()->count(), 1);

        $this
            ->actingAsVerified($user)
            ->post(route('legacy-irc-key.store'))
            ->assertSuccessful();
    }

    public function testStoreNotEnoughPlaycount(): void
    {
        $user = User::factory()->withPlays(10)->create();

        $this->expectCountChange(fn () => $user->legacyIrcKey()->count(), 0);

        $this
            ->actingAsVerified($user)
            ->post(route('legacy-irc-key.store'))
            ->assertStatus(403);
    }

    public function testStoreWithExisting(): void
    {
        $user = User::factory()->withPlays(100)->create();
        $key = LegacyIrcKey::factory()->create(['user_id' => $user]);

        $this->expectCountChange(fn () => $user->legacyIrcKey()->count(), 0);

        $this
            ->actingAsVerified($user)
            ->post(route('legacy-irc-key.store'))
            ->assertSuccessful();
    }

    public function testStoreGuest(): void
    {
        $this->post(route('legacy-irc-key.store'))->assertStatus(401);
    }
}
