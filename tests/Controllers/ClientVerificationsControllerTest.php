<?php

namespace Tests\Controllers;

use App\Models\User;
use App\Models\UserClient;
use Tests\TestCase;

class ClientVerificationsControllerTest extends TestCase
{
    public function testCreate()
    {
        $user = factory(User::class)->create();

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
        $user = factory(User::class)->create();

        $this->actingAsVerified($user)
            ->get(route('client-verifications.create'))
            ->assertStatus(422);

        $this->actingAsVerified($user)
            ->get(route('client-verifications.create', ['ch' => 'aa::bb:cc']))
            ->assertStatus(422);
    }

    public function testStore()
    {
        $user = factory(User::class)->create();

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

        $this->actingAsVerified($user)
            ->post($url)
            ->assertSuccessful()
            ->assertViewIs('client_verifications.completed');

        $this->assertSame($initialCount + 1, UserClient::count());
        $this->assertTrue(UserClient::lookupOrNew($user->getKey(), $hash)->verified);

        $this->actingAsVerified($user)
            ->post($url)
            ->assertSuccessful()
            ->assertViewIs('client_verifications.completed');

        $this->assertSame($initialCount + 1, UserClient::count());
    }

    public function testStoreWithInvalidHash()
    {
        $user = factory(User::class)->create();

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
