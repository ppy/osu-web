<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\ApiKey;
use App\Models\User;
use Tests\TestCase;

class LegacyApiKeyControllerTest extends TestCase
{
    public function testDestroy(): void
    {
        $apiKey = ApiKey::factory()->create();
        $user = $apiKey->user;

        $this->expectCountChange(fn () => $user->apiKeys()->available()->count(), -1);

        $this
            ->actingAsVerified($user)
            ->delete(route('legacy-api-key.destroy'))
            ->assertSuccessful();
    }

    public function testDestroyWithoutExisting(): void
    {
        $user = User::factory()->create();

        $this->expectCountChange(fn () => $user->apiKeys()->available()->count(), 0);

        $this
            ->actingAsVerified($user)
            ->delete(route('legacy-api-key.destroy'))
            ->assertSuccessful();
    }

    public function testDestroyGuest(): void
    {
        $this->delete(route('legacy-api-key.destroy'))->assertStatus(401);
    }

    public function testStore(): void
    {
        $user = User::factory()->create();

        $this->expectCountChange(fn () => $user->apiKeys()->available()->count(), 1);

        $appName = 'test app';
        $appUrl = 'http://localhost';
        $this
            ->actingAsVerified($user)
            ->post(route('legacy-api-key.store'), ['legacy_api_key' => [
                'app_name' => 'test app',
                'app_url' => 'http://localhost',
            ]])->assertSuccessful()
            ->assertJsonFragment([
                'app_name' => $appName,
                'app_url' => $appUrl,
            ]);
    }

    /**
     * @dataProvider dataProviderForStoreWithInvalidParams
     */
    public function testStoreWithInvalidParams($params): void
    {
        $user = User::factory()->create();

        $this->expectCountChange(fn () => $user->apiKeys()->available()->count(), 0);

        $this
            ->actingAsVerified($user)
            ->post(route('legacy-api-key.store'), ['legacy_api_key' => $params])
            ->assertStatus(422);
    }

    public function testStoreWithExisting(): void
    {
        $apiKey = ApiKey::factory()->create();
        $user = $apiKey->user;

        $this->expectCountChange(fn () => $user->apiKeys()->available()->count(), 0);

        $this
            ->actingAsVerified($user)
            ->post(route('legacy-api-key.store'), ['legacy_api_key' => [
                'app_name' => 'test app 2',
                'app_url' => 'http://localhost/2',
            ]])->assertStatus(422);
    }

    public function testStoreGuest(): void
    {
        $this->post(route('legacy-api-key.store'))->assertStatus(401);
    }

    public function dataProviderForStoreWithInvalidParams(): array
    {
        return [
            [[
                'app_name' => 'app name',
                'app_url' => '',
            ]],
            [[
                'app_name' => 'app name',
            ]],
            [[
                'app_name' => '',
                'app_url' => 'http://localhost',
            ]],
            [[
                'app_url' => 'http://localhost',
            ]],
            [[
                'app_name' => 'app name',
                'app_url' => 'localhost',
            ]],
            [[
                'app_name' => '',
                'app_url' => '',
            ]],
            [[]],
        ];
    }
}
