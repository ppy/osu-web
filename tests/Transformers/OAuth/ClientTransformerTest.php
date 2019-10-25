<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
