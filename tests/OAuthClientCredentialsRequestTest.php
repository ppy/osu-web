<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Models\OAuth\Client;
use App\Models\User;

class OAuthClientCredentialsRequestTest extends TestCase
{
    /**
     * @dataProvider botRequestingScopeDataProvider
     */
    public function testBotRequestingScope($scope, $status)
    {
        $owner = factory(User::class)->states('bot')->create();
        $client = factory(Client::class)->create([
            'redirect' => 'https://localhost',
            'user_id' => $owner->getKey(),
        ]);

        $params = [
            'client_id' => $client->getKey(),
            'client_secret' => $client->secret,
            'grant_type' => 'client_credentials',
            'scope' => $scope,
        ];

        $this->post(route('oauth.passport.token'), $params)
            ->assertStatus($status);
    }

    /**
     * @dataProvider nonBotRequestingScopeDataProvider
     */
    public function testNonBotRequestingScope($scope, $status)
    {
        $owner = factory(User::class)->create();
        $client = factory(Client::class)->create([
            'redirect' => 'https://localhost',
            'user_id' => $owner->getKey(),
        ]);

        $params = [
            'client_id' => $client->getKey(),
            'client_secret' => $client->secret,
            'grant_type' => 'client_credentials',
            'scope' => $scope,
        ];

        $this->post(route('oauth.passport.token'), $params)
            ->assertStatus($status);
    }

    public function botRequestingScopeDataProvider()
    {
        return [
            'chat.write cannot be requested by itself' => ['chat.write', 400],
            'bot scope allows chat.write' => ['bot chat.write', 200],
            'bot can delegate' => ['bot', 200],
            'bot can use public scope' => ['public', 200],
        ];
    }

    public function nonBotRequestingScopeDataProvider()
    {
        return [
            'chat.write is not allowed' => ['chat.write', 400],
            'bot is not allowed' => ['bot', 400],
            'public is allowed' => ['public', 200],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        // otherwise exceptions won't render the actual view.
        config()->set('app.debug', false);
    }
}
