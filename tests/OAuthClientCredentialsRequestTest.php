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
        $client = Client::factory()->create([
            'user_id' => User::factory()->withGroup('bot'),
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
        $client = Client::factory()->create();

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
            '* cannot be requested' => ['*', 400],
            'cannot request empty scope' => ['', 400],
            'delegate scope allows chat.write' => ['chat.write delegate ', 200],
            'chat.write cannot be requested by itself' => ['chat.write', 400],
            'mixing scope delegation is not allowed' => ['chat.write delegate forum.write', 400],
            'public scope is allowed' => ['public', 200],
        ];
    }

    public function nonBotRequestingScopeDataProvider()
    {
        return [
            '* cannot be requested' => ['*', 400],
            'cannot request empty scope' => ['', 400],
            'cannot request delegation' => ['chat.write delegate ', 400],
            'public scope is allowed' => ['public', 200],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        // otherwise exceptions won't render the actual view.
        config()->set('app.debug', false);
    }
}
