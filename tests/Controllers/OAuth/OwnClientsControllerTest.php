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
namespace Tests\OAuth;

use App\Models\OAuth\Client;
use App\Models\User;
use Laravel\Passport\ClientRepository;
use TestCase;

class OwnClientsControllerTest extends TestCase
{
    protected $repository;

    private $client;
    private $owner;

    public function setUp()
    {
        parent::setUp();

        $this->owner = factory(User::class)->create();
        $this->repository = new ClientRepository();
        $this->client = $this->createClient($this->owner);
    }

    public function testGuestCannotDeleteClient()
    {
        $this
            ->json('DELETE', route('oauth.own-clients.destroy', ['own_client' => $this->client->getKey()]))
            ->assertStatus(401);

        $this->assertFalse(Client::find($this->client->getKey())->revoked);
    }

    public function testCanDeleteOwnClient()
    {
        $this
            ->actingAs($this->owner)
            ->withSession(['verified' => true])
            ->json('DELETE', route('oauth.own-clients.destroy', ['own_client' => $this->client->getKey()]))
            ->assertSuccessful();

        $this->assertTrue(Client::find($this->client->getKey())->revoked);
    }

    public function testCannotDeleteOtherUserClient()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->withSession(['verified' => true])
            ->json('DELETE', route('oauth.own-clients.destroy', ['own_client' => $this->client->getKey()]))
            ->assertStatus(404);

        $this->assertFalse(Client::find($this->client->getKey())->revoked);
    }

    public function testOnlyRedirectIsUpdated()
    {
        $id = $this->client->getKey();

        $data = [
            'id' => $id + 1,
            'name' => 'new name',
            'redirect' => 'https://nowhere.local',
        ];

        $this
            ->actingAs($this->owner)
            ->withSession(['verified' => true])
            ->json('PUT', route('oauth.own-clients.update', ['own_client' => $id]), $data)
            ->assertSuccessful();

        $this->client->refresh();
        // FIXME: assert other values didn't change
        $this->assertSame($id, $this->client->id);
        $this->assertSame('test', $this->client->name);
        $this->assertSame('https://nowhere.local', $this->client->redirect);
    }

    private function createClient(User $owner) : Client
    {
        $passportClient = $this->repository->create($owner->getKey(), 'test', url('/auth/callback'));

        return Client::findOrFail($passportClient->getKey());
    }
}
