<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace Tests\Transformers\OAuth;

use App\Models\OAuth\Client;
use App\Models\User;
use Tests\TestCase;

class ClientTransformerTest extends TestCase
{
    protected $repository;

    private $client;
    private $owner;

    public function testRedirectAndSecretVisibleToOwner()
    {
        auth()->setUser($this->owner);
        $json = json_item($this->client, 'OAuth\Client', ['redirect', 'secret']);

        $this->assertSame($this->client->redirect, $json['redirect']);
        $this->assertSame($this->client->secret, $json['secret']);
    }

    public function testRedirectAndSecretNotVisibleToOtherUsers()
    {
        $user = factory(User::class)->create();
        auth()->setUser($user);
        $json = json_item($this->client, 'OAuth\Client', ['redirect', 'secret']);

        $this->assertArrayNotHasKey('redirect', $json);
        $this->assertArrayNotHasKey('secret', $json);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->owner = factory(User::class)->create();
        $this->client = factory(Client::class)->make(['user_id' => $this->owner->getKey()]);
    }
}
