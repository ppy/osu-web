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
        $beatmapset = factory(Beatmapset::class)->create();
        $beatmap = factory(Beatmap::class)->create(['beatmapset_id' => $beatmapset->getKey()]);

        $roomsCountInitial = Room::count();
        $playlistItemsCountInitial = PlaylistItem::count();

        $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), [
                'ends_at' => now()->addHour(),
                'name' => 'test room',
                'playlist' => [
                    [
                        'beatmap_id' => $beatmap->getKey(),
                        'ruleset_id' => $beatmap->playmode,
                    ],
                ],
            ])->assertSuccessful();

        $this->assertSame($roomsCountInitial + 1, Room::count());
        $this->assertSame($playlistItemsCountInitial + 1, PlaylistItem::count());
    }

    public function testStoreWithPassword()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);
        $beatmapset = factory(Beatmapset::class)->create();
        $beatmap = factory(Beatmap::class)->create(['beatmapset_id' => $beatmapset->getKey()]);

        $response = $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), [
                'ends_at' => now()->addHour(),
                'name' => 'test room',
                'password' => 'hunter2',
                'playlist' => [
                    [
                        'beatmap_id' => $beatmap->getKey(),
                        'ruleset_id' => $beatmap->playmode,
                    ],
                ],
            ])->assertSuccessful();

        $responseJson = json_decode($response->getContent(), true);
        $this->assertNull(Room::find($responseJson['id'])->password);
    }

    public function testStoreRealtime()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);
        $beatmapset = factory(Beatmapset::class)->create();
        $beatmap = factory(Beatmap::class)->create(['beatmapset_id' => $beatmapset->getKey()]);
        $type = array_rand_val(Room::REALTIME_TYPES);

        $roomsCountInitial = Room::count();
        $playlistItemsCountInitial = PlaylistItem::count();

        $response = $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), [
                'category' => 'realtime',
                'type' => $type,
                'name' => 'test room',
                'playlist' => [
                    [
                        'beatmap_id' => $beatmap->getKey(),
                        'ruleset_id' => $beatmap->playmode,
                    ],
                ],
            ])->assertSuccessful();

        $this->assertSame($roomsCountInitial + 1, Room::count());
        $this->assertSame($playlistItemsCountInitial + 1, PlaylistItem::count());

        $responseJson = json_decode($response->getContent(), true);
        $room = Room::find($responseJson['id']);
        $this->assertNotNull($room);
        $this->assertTrue($room->isRealtime());
        $this->assertSame($type, $room->type);
    }

    public function testStoreRealtimeWithPassword()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);
        $beatmapset = factory(Beatmapset::class)->create();
        $beatmap = factory(Beatmap::class)->create(['beatmapset_id' => $beatmapset->getKey()]);
        $password = 'hunter2';

        $response = $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), [
                'category' => 'realtime',
                'name' => 'test room',
                'password' => $password,
                'playlist' => [
                    [
                        'beatmap_id' => $beatmap->getKey(),
                        'ruleset_id' => $beatmap->playmode,
                    ],
                ],
            ])->assertSuccessful();

        $responseJson = json_decode($response->getContent(), true);
        $this->assertSame($password, Room::find($responseJson['id'])->password);
    }

    public function testStoreRealtimeFailWithTwoPlaylistItems()
    {
        $token = factory(Token::class)->create(['scopes' => ['*']]);
        $beatmapset = factory(Beatmapset::class)->create();
        $beatmap1 = factory(Beatmap::class)->create(['beatmapset_id' => $beatmapset->getKey()]);
        $beatmap2 = factory(Beatmap::class)->create(['beatmapset_id' => $beatmapset->getKey()]);

        $roomsCountInitial = Room::count();
        $playlistItemsCountInitial = PlaylistItem::count();

        $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), [
                'category' => 'realtime',
                'name' => 'test room',
                'playlist' => [
                    [
                        'beatmap_id' => $beatmap1->getKey(),
                        'ruleset_id' => $beatmap1->playmode,
                    ],
                    [
                        'beatmap_id' => $beatmap2->getKey(),
                        'ruleset_id' => $beatmap2->playmode,
                    ],
                ],
            ])->assertStatus(422);

        $this->assertSame($roomsCountInitial, Room::count());
        $this->assertSame($playlistItemsCountInitial, PlaylistItem::count());
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
}
