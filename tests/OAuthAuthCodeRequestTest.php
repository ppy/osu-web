<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Models\OAuth\Client;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;

class OAuthAuthCodeRequestTest extends TestCase
{
    public static function dataProviderForTestBotClient()
    {
        return [
            'cannot request delegation with auth_code' => ['delegate', false],
            'can request chat.read scope' => ['chat.read', true],
            'can request chat.write scope' => ['chat.write', true],
            'can request chat.write_manage scope' => ['chat.write_manage', true],
        ];
    }

    public static function dataProviderForTestNonBotClientCannotRequestChatScopes()
    {
        return static::ownClientOrBotScopes()->map(fn ($scope) => [$scope]);
    }

    #[DataProvider('dataProviderForTestBotClient')]
    public function testBotClient($scope, $success)
    {
        $client = Client::factory()->create([
            'user_id' => User::factory()->withGroup('bot'),
        ]);

        $params = [
            'client_id' => $client->getKey(),
            'redirect_uri' => $client->redirect,
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

    #[DataProvider('dataProviderForTestNonBotClientCannotRequestChatScopes')]
    public function testNonBotClientCannotRequestChatScopes(string $scope)
    {
        $client = Client::factory()->create();

        $params = [
            'client_id' => $client->getKey(),
            'redirect_uri' => $client->redirect,
            'response_type' => 'code',
            'scope' => $scope,
        ];

        $this->get(route('oauth.authorizations.authorize', $params))
            ->assertViewIs('layout.error')
            ->assertStatus(400);
    }

    protected function setUp(): void
    {
        parent::setUp();

        // otherwise exceptions won't render the actual view.
        config_set('app.debug', false);

        $user = User::factory()->create();
        $this->actAsUser($user, true);
    }
}
