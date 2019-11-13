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

namespace Tests\Controllers\OAuth;

use App\Models\OAuth\Client;
use App\Models\User;
use Tests\TestCase;

class ClientsControllerTest extends TestCase
{
    protected $repository;

    private $client;
    private $owner;

    public function testGuestCannotDeleteClient()
    {
        $this
            ->json('DELETE', route('oauth.clients.destroy', ['client' => $this->client->getKey()]))
            ->assertStatus(401);

        $this->assertFalse(Client::find($this->client->getKey())->revoked);
    }

    public function testCanDeleteOwnClient()
    {
        $this
            ->actingAsVerified($this->owner)
            ->json('DELETE', route('oauth.clients.destroy', ['client' => $this->client->getKey()]))
            ->assertSuccessful();

        $this->assertTrue(Client::find($this->client->getKey())->revoked);
    }

    public function testCannotDeleteOtherUserClient()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAsVerified($user)
            ->json('DELETE', route('oauth.clients.destroy', ['client' => $this->client->getKey()]))
            ->assertStatus(404);

        $this->assertFalse(Client::find($this->client->getKey())->revoked);
    }

    public function testCreateNewClient()
    {
        $data = [
            'name' => 'best client',
            'redirect' => 'https://nowhere.local',
        ];

        $count = Client::count();

        $response = $this
            ->actingAsVerified($this->owner)
            ->json('POST', route('oauth.clients.store'), $data)
            ->assertSuccessful()
            ->getOriginalContent();

        // because user needs to see this after it's generated.
        $this->assertArrayHasKey('secret', $response);

        $client = Client::find($response['id']);
        $this->assertNotNull($client);
        $this->assertNotEmpty($client->secret);
        $this->assertSame($this->owner->getKey(), $client->user_id);
        $this->assertSame('best client', $client->name);
        $this->assertSame('https://nowhere.local', $client->redirect);
        $this->assertFalse($client->personal_access_client);
        $this->assertFalse($client->password_client);
        $this->assertFalse($client->revoked);
        $this->assertSame($count + 1, Client::count());
    }

    /**
     * @dataProvider emptyStringsTestDataProvider
     *
     * @return void
     */
    public function testCannotCreateClientWithEmptyStrings($name, $redirect)
    {
        $data = [
            'name' => $name,
            'redirect' => $redirect,
        ];

        $count = Client::count();

        $this
            ->actingAsVerified($this->owner)
            ->json('POST', route('oauth.clients.store'), $data)
            ->assertStatus(422);

        $this->assertSame($count, Client::count());
    }

    public function testOnlyRedirectIsUpdated()
    {
        $id = $this->client->getKey();
        $name = $this->client->name;

        $data = [
            'id' => $id + 1,
            'name' => 'new name',
            'redirect' => 'https://nowhere.local',
        ];

        $this
            ->actingAsVerified($this->owner)
            ->json('PUT', route('oauth.clients.update', ['client' => $id]), $data)
            ->assertSuccessful();

        $this->client->refresh();
        // FIXME: assert other values didn't change
        $this->assertSame($id, $this->client->id);
        $this->assertSame($name, $this->client->name);
        $this->assertSame('https://nowhere.local', $this->client->redirect);
    }

    public function emptyStringsTestDataProvider()
    {
        return [
            ['name', null],
            ['name', ''],
            ['name', ' '],
            [null, 'https://nowhere.local'],
            ['', 'https://nowhere.local'],
            [' ', 'https://nowhere.local'],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->owner = factory(User::class)->create();
        $this->client = factory(Client::class)->create(['user_id' => $this->owner->getKey()]);
    }
}
