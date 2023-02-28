<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\User;
use App\Models\UserClient;
use Tests\TestCase;

class ClientVerificationsControllerTest extends TestCase
{
    public function testCreate()
    {
        $user = User::factory()->create();

        $hash = implode(':', [md5('osu'), '', md5('mac'), md5('unique'), md5('disk')]);

        $url = route('client-verifications.create', ['ch' => $hash]);

        $this->get($url)
            ->assertStatus(401)
            ->assertViewIs('sessions.create');

        $this->be($user)
            ->get($url)
            ->assertStatus(401)
            ->assertViewIs('users.verify');

        $this->actingAsVerified($user)
            ->get($url)
            ->assertSuccessful()
            ->assertViewIs('client_verifications.create');

        UserClient::lookupOrNew($user->getKey(), $hash)->fill(['verified' => true])->save();

        $this->actingAsVerified($user)
            ->get($url)
            ->assertSuccessful()
            ->assertViewIs('client_verifications.completed');
    }

    public function testCreateWithInvalidHash()
    {
        $user = User::factory()->create();

        $this->actingAsVerified($user)
            ->get(route('client-verifications.create'))
            ->assertStatus(422);

        $this->actingAsVerified($user)
            ->get(route('client-verifications.create', ['ch' => 'aa::bb:cc']))
            ->assertStatus(422);
    }

    public function testStore()
    {
        $user = User::factory()->create();

        $hash = implode(':', [md5('osu'), '', md5('mac'), md5('unique'), md5('disk')]);

        $url = route('client-verifications.store', ['ch' => $hash]);

        $initialCount = UserClient::count();

        $this->post($url)
            ->assertStatus(401);

        $this->assertSame($initialCount, UserClient::count());
        $this->assertFalse(UserClient::lookupOrNew($user->getKey(), $hash)->exists);

        $this->be($user)
            ->post($url)
            ->assertStatus(401)
            ->assertViewIs('users.verify');

        $this->assertSame($initialCount, UserClient::count());
        $this->assertFalse(UserClient::lookupOrNew($user->getKey(), $hash)->exists);

        $returnUrl = route('client-verifications.create', ['ch' => $hash]);

        $this->actingAsVerified($user)
            ->post($url)
            ->assertRedirect($returnUrl);

        $this->actingAsVerified($user)
            ->get($returnUrl)
            ->assertViewIs('client_verifications.completed');

        $this->assertSame($initialCount + 1, UserClient::count());
        $this->assertTrue(UserClient::lookupOrNew($user->getKey(), $hash)->verified);

        $this->actingAsVerified($user)
            ->post($url)
            ->assertRedirect($returnUrl);

        $this->actingAsVerified($user)
            ->get($returnUrl)
            ->assertViewIs('client_verifications.completed');

        $this->assertSame($initialCount + 1, UserClient::count());
    }

    public function testStoreWithInvalidHash()
    {
        $user = User::factory()->create();

        $initialCount = UserClient::count();

        $this->actingAsVerified($user)
            ->post(route('client-verifications.store'))
            ->assertStatus(422);

        $this->assertSame($initialCount, UserClient::count());

        $this->actingAsVerified($user)
            ->post(route('client-verifications.store', ['ch' => 'aa::bb:cc']))
            ->assertStatus(422);

        $this->assertSame($initialCount, UserClient::count());
    }
}
