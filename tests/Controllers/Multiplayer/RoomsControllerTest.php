<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Multiplayer;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Chat\UserChannel;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\OAuth\Token;
use App\Models\User;
use Tests\TestCase;

class RoomsControllerTest extends TestCase
{
    public function testIndex()
    {
        $room = factory(Room::class)->create();
        $user = factory(User::class)->create();

        $this->actAsScopedUser($user, ['*']);

        $this->json('GET', route('api.rooms.index'))->assertSuccessful();
    }

    public function testStore()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);

        $roomsCountInitial = Room::count();
        $playlistItemsCountInitial = PlaylistItem::count();

        $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                ['ends_at' => now()->addHour()],
            ))->assertSuccessful();

        $this->assertSame($roomsCountInitial + 1, Room::count());
        $this->assertSame($playlistItemsCountInitial + 1, PlaylistItem::count());
    }

    public function testStoreWithPassword()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);

        $response = $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                [
                    'ends_at' => now()->addHour(),
                    'password' => 'hunter2',
                ],
            ))->assertSuccessful();

        $responseJson = json_decode($response->getContent(), true);
        $this->assertNull(Room::find($responseJson['id'])->password);
    }

    public function testStoreRealtime()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);
        $type = array_rand_val(Room::REALTIME_TYPES);

        $roomsCountInitial = Room::count();
        $playlistItemsCountInitial = PlaylistItem::count();

        $response = $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                [
                    'category' => 'realtime',
                    'type' => $type,
                ],
            ))->assertSuccessful();

        $this->assertSame($roomsCountInitial + 1, Room::count());
        $this->assertSame($playlistItemsCountInitial + 1, PlaylistItem::count());

        $responseJson = json_decode($response->getContent(), true);
        $room = Room::find($responseJson['id']);
        $this->assertNotNull($room);
        $this->assertTrue($room->isRealtime());
        $this->assertSame($type, $room->type);
    }

    public function testStoreRealtimeByType()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);
        $type = array_rand_val(Room::REALTIME_TYPES);

        $response = $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                ['type' => $type],
            ))->assertSuccessful();

        $responseJson = json_decode($response->getContent(), true);
        $room = Room::find($responseJson['id']);
        $this->assertNotNull($room);
        $this->assertTrue($room->isRealtime());
        $this->assertSame($type, $room->type);
    }

    // TODO: remove once client sends type instead of category
    public function testStoreRealtimeByCategory()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);

        $response = $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                ['category' => 'realtime'],
            ))->assertSuccessful();

        $responseJson = json_decode($response->getContent(), true);
        $room = Room::find($responseJson['id']);
        $this->assertNotNull($room);
        $this->assertTrue($room->isRealtime());
        $this->assertSame(Room::REALTIME_DEFAULT_TYPE, $room->type);
    }

    public function testStoreRealtimeWithPassword()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);
        $password = 'hunter2';

        $response = $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                [
                    'password' => $password,
                    'type' => array_rand_val(Room::REALTIME_TYPES),
                ],
            ))->assertSuccessful();

        $responseJson = json_decode($response->getContent(), true);
        $this->assertSame($password, Room::find($responseJson['id'])->password);
    }

    public function testStoreRealtimeFailWithTwoPlaylistItems()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);
        $beatmapset = factory(Beatmapset::class)->create();
        $beatmap = Beatmap::factory()->create(['beatmapset_id' => $beatmapset->getKey()]);

        $roomsCountInitial = Room::count();
        $playlistItemsCountInitial = PlaylistItem::count();

        $params = $this->createBasicStoreParams();
        $params['playlist'][] = [
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
        ];
        $params['type'] = array_rand_val(Room::REALTIME_TYPES);

        $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), $params)
            ->assertStatus(422);

        $this->assertSame($roomsCountInitial, Room::count());
        $this->assertSame($playlistItemsCountInitial, PlaylistItem::count());
    }

    public function testStorePlaylistsAllowance()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);
        $user = $token->user;

        for ($i = 0; $i < $user->maxMultiplayerRooms(); $i++) {
            factory(Room::class)->create(['user_id' => $user]);
        }

        $roomsCountInitial = Room::count();
        $playlistItemsCountInitial = PlaylistItem::count();

        $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                ['ends_at' => now()->addHour()],
            ))->assertStatus(422);

        $this->assertSame($roomsCountInitial, Room::count());
        $this->assertSame($playlistItemsCountInitial, PlaylistItem::count());
    }

    public function testStorePlaylistsAllowanceSeparateFromRealtime()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);
        $user = $token->user;
        factory(Room::class)->create(['user_id' => $user, 'type' => Room::REALTIME_DEFAULT_TYPE]);

        $roomsCountInitial = Room::count();
        $playlistItemsCountInitial = PlaylistItem::count();

        $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                ['ends_at' => now()->addHour()],
            ))->assertSuccessful();

        $this->assertSame($roomsCountInitial + 1, Room::count());
        $this->assertSame($playlistItemsCountInitial + 1, PlaylistItem::count());
    }

    public function testStoreRealtimeAllowance()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);

        $user = $token->user;

        factory(Room::class)->create(['user_id' => $user, 'type' => Room::REALTIME_DEFAULT_TYPE]);

        $roomsCountInitial = Room::count();
        $playlistItemsCountInitial = PlaylistItem::count();

        $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                ['type' => array_rand_val(Room::REALTIME_TYPES)],
            ))->assertStatus(422);

        $this->assertSame($roomsCountInitial, Room::count());
        $this->assertSame($playlistItemsCountInitial, PlaylistItem::count());
    }

    public function testStoreRealtimeAllowanceSeparateFromPlaylists()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);

        $user = $token->user;

        for ($i = 0; $i < $user->maxMultiplayerRooms(); $i++) {
            factory(Room::class)->create(['user_id' => $user]);
        }

        $roomsCountInitial = Room::count();
        $playlistItemsCountInitial = PlaylistItem::count();

        $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                ['type' => array_rand_val(Room::REALTIME_TYPES)],
            ))->assertSuccessful();

        $this->assertSame($roomsCountInitial + 1, Room::count());
        $this->assertSame($playlistItemsCountInitial + 1, PlaylistItem::count());
    }

    public function testJoinWithPassword()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);
        $password = 'hunter2';
        $room = factory(Room::class)->create(compact('password'));

        $initialUserChannelCount = UserChannel::count();
        $url = route('api.rooms.join', ['room' => $room, 'user' => $token->user]);

        // no password
        $this
            ->actingWithToken($token)
            ->put($url)
            ->assertStatus(403);

        $this->assertSame($initialUserChannelCount, UserChannel::count());

        // wrong password
        $this
            ->actingWithToken($token)
            ->put($url, ['password' => "x{$password}"])
            ->assertStatus(403);

        $this->assertSame($initialUserChannelCount, UserChannel::count());

        // correct password
        $this
            ->actingWithToken($token)
            ->put($url, compact('password'))
            ->assertSuccessful();

        $this->assertSame($initialUserChannelCount + 1, UserChannel::count());
    }

    /**
     * If making playlist, add `ends_at`.
     * If making realtime, add `type`.
     */
    private function createBasicStoreParams()
    {
        $beatmapset = factory(Beatmapset::class)->create();
        $beatmap = Beatmap::factory()->create(['beatmapset_id' => $beatmapset->getKey()]);

        return [
            'name' => 'test room '.rand(),
            'playlist' => [
                [
                    'beatmap_id' => $beatmap->getKey(),
                    'ruleset_id' => $beatmap->playmode,
                ],
            ],
        ];
    }
}
