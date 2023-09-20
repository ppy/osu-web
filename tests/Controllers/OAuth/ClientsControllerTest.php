<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        $user = User::factory()->create();

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
            [null, 'https://nowhere.local'],
            ['', 'https://nowhere.local'],
            [' ', 'https://nowhere.local'],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->owner = User::factory()->create();
        $this->client = Client::factory()->create(['user_id' => $this->owner]);
    }
}
