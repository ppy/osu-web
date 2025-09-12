<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\User;
use Database\Factories\UserFactory;
use OTPHP\Factory;
use Tests\TestCase;

class UserTotpControllerTest extends TestCase
{
    public function testStore(): void
    {
        $user = User::factory()->create();
        $session = \Session::instance();

        $this->actingAsVerified($user);
        $this
            ->withPersistentSession($session)
            ->post(route('authenticator-app.issue-uri'), ['password' => UserFactory::DEFAULT_PASSWORD])
            ->assertStatus(302);

        $totpUri = \Cache::get("user_totp:create:{$session->getKey()}");

        $this->assertNotNull($totpUri);

        $key = Factory::loadFromProvisioningUri($totpUri)->now();

        $this
            ->withPersistentSession($session)
            ->post(route('authenticator-app.store'), ['key' => $key])
            ->assertStatus(302);

        $this->assertSame($totpUri, $user->fresh()->userTotpKey->uri);
    }

    public function testStoreInvalidKey(): void
    {
        $user = User::factory()->create();
        $session = \Session::instance();

        $this->actingAsVerified($user);
        $this
            ->withPersistentSession($session)
            ->post(route('authenticator-app.issue-uri'), ['password' => UserFactory::DEFAULT_PASSWORD]);

        $this
            ->withPersistentSession($session)
            ->post(route('authenticator-app.store'), ['key' => '000000'])
            ->assertStatus(422);

        $this->assertNull($user->fresh()->userTotpKey);
    }

    public function testStoreWithoutUri(): void
    {
        $user = User::factory()->create();
        $session = \Session::instance();

        $this->actingAsVerified($user);
        $this
            ->withPersistentSession($session)
            ->post(route('authenticator-app.store'), ['key' => '000000'])
            ->assertRedirect(route('authenticator-app.create'));
    }
}
