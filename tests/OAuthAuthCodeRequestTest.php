<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Models\OAuth\Client;
use App\Models\User;

class OAuthAuthCodeRequestTest extends TestCase
{
    protected $client;

    /**
     * @dataProvider botClientDataProvider
     */
    public function testBotClient($scope, $success)
    {
        $params = [
            'client_id' => $this->client->getKey(),
            'redirect_uri' => $this->client->redirect,
            'response_type' => 'code',
            'scope' => $scope,
        ];

        $request = $this->get(route('oauth.authorizations.authorize', $params));

        if ($success) {
            $request->assertStatus(200);
        } else {
            $request->assertViewIs('layout.error')->assertStatus(400);
        }
    }

    public function testNonBotClientCannotRequestChatWriteScope()
    {
        $client = Client::factory()->create();

        $params = [
            'client_id' => $client->getKey(),
            'redirect_uri' => $client->redirect,
            'response_type' => 'code',
            'scope' => 'chat.write',
        ];

        $this->get(route('oauth.authorizations.authorize', $params))
            ->assertViewIs('layout.error')
            ->assertStatus(400);
    }

    public function botClientDataProvider()
    {
        return [
            'cannot request delegation with auth_code' => ['delegate', false],
            'can request chat.write scope' => ['chat.write', true],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        // otherwise exceptions won't render the actual view.
        config()->set('app.debug', false);

        $this->client = Client::factory()->create([
            'user_id' => User::factory()->withGroup('bot'),
        ]);

        $user = User::factory()->create();
        $this->actAsUser($user, true);
    }
}
