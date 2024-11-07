<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Multiplayer;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Chat\UserChannel;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\PlaylistItemUserHighScore;
use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\ScoreLink;
use App\Models\Multiplayer\UserScoreAggregate;
use App\Models\OAuth\Token;
use App\Models\User;
use Illuminate\Support\Arr;
use Tests\TestCase;

class RoomsControllerTest extends TestCase
{
    public function testIndex()
    {
        $room = Room::factory()->create();
        $user = User::factory()->create();

        $this->actAsScopedUser($user, ['*']);

        $this->json('GET', route('api.rooms.index'))->assertSuccessful();
    }

    public function testShow()
    {
        $room = Room::factory()->create();
        $user = User::factory()->create();
        $playlistItem = PlaylistItem::factory()->create(['room_id' => $room]);
        $scoreLink = ScoreLink
            ::factory()
            ->state([
                'playlist_item_id' => $playlistItem,
                'user_id' => $user,
            ])->completed([], ['passed' => true, 'total_score' => 20])
            ->create();
        PlaylistItemUserHighScore::new($scoreLink->user_id, $scoreLink->playlist_item_id)->update(['attempts' => 1]);
        UserScoreAggregate::lookupOrDefault($scoreLink->user, $scoreLink->playlistItem->room)->recalculate();

        $this->actAsScopedUser($user, ['*']);

        $this
            ->json('GET', route('api.rooms.show', $room))
            ->assertSuccessful()
            ->assertJsonPath('current_user_score.playlist_item_attempts.0.attempts', 1)
            ->assertJsonPath('current_user_score.playlist_item_attempts.0.id', $playlistItem->getKey());
    }

    public function testStore()
    {
        $token = Token::factory()->create(['scopes' => ['*']]);

        $roomsCountInitial = Room::count();
        $playlistItemsCountInitial = PlaylistItem::count();

        $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                ['ends_at' => now()->addHours()],
            ))->assertSuccessful();

        $this->assertSame($roomsCountInitial + 1, Room::count());
        $this->assertSame($playlistItemsCountInitial + 1, PlaylistItem::count());
    }

    /**
     * @dataProvider dataProviderForTestStoreWithInvalidPlayableMods
     */
    public function testStoreWithInvalidPlayableMods(string $type, string $modType): void
    {
        $token = Token::factory()->create(['scopes' => ['*']]);

        $this->expectCountChange(fn () => Room::count(), 0);
        $this->expectCountChange(fn () => PlaylistItem::count(), 0);

        $params = array_merge($this->createBasicStoreParams(), [
            'ends_at' => now()->addHours(),
            'type' => $type,
        ]);

        $params['playlist'][0]['allowed_mods'] = [];
        $params['playlist'][0]['required_mods'] = [];
        $params['playlist'][0]["{$modType}_mods"][] = ['acronym' => 'AT', 'settings' => []];

        $response = $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), $params)
            ->assertStatus(422);

        $responseJson = json_decode($response->getContent(), true);
        $this->assertSame("mod cannot be set as {$modType}: AT", $responseJson['error']);
    }

    /**
     * @dataProvider dataProviderForTestStoreWithInvalidRealtimeAllowedMods
     */
    public function testStoreWithInvalidRealtimeAllowedMods(string $type, bool $ok): void
    {
        $token = Token::factory()->create(['scopes' => ['*']]);

        $this->expectCountChange(fn () => Room::count(), $ok ? 1 : 0);
        $this->expectCountChange(fn () => PlaylistItem::count(), $ok ? 1 : 0);

        $params = array_merge($this->createBasicStoreParams(), [
            'ends_at' => now()->addHours(),
            'type' => $type,
        ]);
        $params['playlist'][0]['required_mods'] = [];
        $params['playlist'][0]['allowed_mods'] = [['acronym' => 'DT', 'settings' => []]];

        $response = $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), $params)
            ->assertStatus($ok ? 200 : 422);

        if (!$ok) {
            $response->assertJson(['error' => 'mod cannot be set as allowed: DT']);
        }
    }

    /**
     * @dataProvider dataProviderForTestStoreWithInvalidRealtimeMods
     */
    public function testStoreWithInvalidRealtimeMods(string $type, bool $ok): void
    {
        $token = Token::factory()->create(['scopes' => ['*']]);

        $this->expectCountChange(fn () => Room::count(), $ok ? 1 : 0);
        $this->expectCountChange(fn () => PlaylistItem::count(), $ok ? 1 : 0);

        // explicit ruleset required because AS isn't available for all modes
        $params = array_merge($this->createBasicStoreParams('osu'), [
            'ends_at' => now()->addHours(),
            'type' => $type,
        ]);
        $params['playlist'][0]['allowed_mods'] = [];
        $params['playlist'][0]['required_mods'] = [['acronym' => 'AS', 'settings' => []]];

        $response = $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), $params)
            ->assertStatus($ok ? 200 : 422);

        if (!$ok) {
            $response->assertJson(['error' => 'mod cannot be set as required: AS']);
        }
    }

    public function testStoreWithPassword()
    {
        $token = Token::factory()->create(['scopes' => ['*']]);

        $response = $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                [
                    'ends_at' => now()->addHours(),
                    'password' => 'hunter2',
                ],
            ))->assertSuccessful();

        $responseJson = json_decode($response->getContent(), true);
        $this->assertNull(Room::find($responseJson['id'])->password);
    }

    public function testStoreRealtime()
    {
        $token = Token::factory()->create(['scopes' => ['*']]);
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
        $this->assertSame($token->user->getKey(), $room->playlist()->first()->owner_id);
    }

    public function testStoreRealtimeByType()
    {
        $token = Token::factory()->create(['scopes' => ['*']]);
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

    public function testStoreRealtimeByQueueMode()
    {
        $token = Token::factory()->create(['scopes' => ['*']]);
        $queueMode = array_rand_val(Room::REALTIME_QUEUE_MODES);

        $response = $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                [
                    'type' => Room::REALTIME_DEFAULT_TYPE,
                    'queue_mode' => $queueMode,
                ],
            ))->assertSuccessful();

        $responseJson = json_decode($response->getContent(), true);
        $room = Room::find($responseJson['id']);
        $this->assertNotNull($room);
        $this->assertTrue($room->isRealtime());
        $this->assertSame($queueMode, $room->queue_mode);
    }

    // TODO: remove once client sends type instead of category
    public function testStoreRealtimeByCategory()
    {
        $token = Token::factory()->create(['scopes' => ['*']]);

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
        $token = Token::factory()->create(['scopes' => ['*']]);
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
        $token = Token::factory()->create(['scopes' => ['*']]);
        $beatmapset = Beatmapset::factory()->create();
        $beatmap = Beatmap::factory()->create(['beatmapset_id' => $beatmapset]);

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
        $token = Token::factory()->create(['scopes' => ['*']]);
        $user = $token->user;

        for ($i = 0; $i < $user->maxMultiplayerRooms(); $i++) {
            Room::factory()->create(['user_id' => $user]);
        }

        $roomsCountInitial = Room::count();
        $playlistItemsCountInitial = PlaylistItem::count();

        $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                ['ends_at' => now()->addHours()],
            ))->assertStatus(422);

        $this->assertSame($roomsCountInitial, Room::count());
        $this->assertSame($playlistItemsCountInitial, PlaylistItem::count());
    }

    public function testStorePlaylistsAllowanceSeparateFromRealtime()
    {
        $token = Token::factory()->create(['scopes' => ['*']]);
        $user = $token->user;
        Room::factory()->create(['user_id' => $user, 'type' => Room::REALTIME_DEFAULT_TYPE]);

        $roomsCountInitial = Room::count();
        $playlistItemsCountInitial = PlaylistItem::count();

        $this
            ->actingWithToken($token)
            ->post(route('api.rooms.store'), array_merge(
                $this->createBasicStoreParams(),
                ['ends_at' => now()->addHours()],
            ))->assertSuccessful();

        $this->assertSame($roomsCountInitial + 1, Room::count());
        $this->assertSame($playlistItemsCountInitial + 1, PlaylistItem::count());
    }

    public function testStoreRealtimeAllowance()
    {
        $token = Token::factory()->create(['scopes' => ['*']]);

        $user = $token->user;

        Room::factory()->create(['user_id' => $user, 'type' => Room::REALTIME_DEFAULT_TYPE]);

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
        $token = Token::factory()->create(['scopes' => ['*']]);

        $user = $token->user;

        for ($i = 0; $i < $user->maxMultiplayerRooms(); $i++) {
            Room::factory()->create(['user_id' => $user]);
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
        $token = Token::factory()->create(['scopes' => ['*']]);
        $password = 'hunter2';
        $room = Room::factory()->create(compact('password'));

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

    public function testDestroy()
    {
        $token = Token::factory()->create(['scopes' => ['*']]);
        $start = now();
        $end = $start->addMinutes(60);
        $room = Room::factory()->create([
            'user_id' => $token->user,
            'starts_at' => $start,
            'ends_at' => $end,
            'type' => Room::PLAYLIST_TYPE,
        ]);
        $end = $room->ends_at; // creation truncates fractional second part, so refetch here
        $url = route('api.rooms.destroy', ['room' => $room]);

        $this
            ->actingWithToken($token)
            ->delete($url)
            ->assertSuccessful();

        $room->refresh();
        $this->assertLessThan($end, $room->ends_at);
    }

    public function testDestroyCannotBeCalledOnRealtimeRoom()
    {
        $token = Token::factory()->create(['scopes' => ['*']]);
        $start = now();
        $end = $start->addMinutes(60);
        $room = Room::factory()->create([
            'user_id' => $token->user,
            'starts_at' => $start,
            'ends_at' => $end,
            'type' => Room::REALTIME_DEFAULT_TYPE,
        ]);
        $end = $room->ends_at; // creation truncates fractional second part, so refetch here
        $url = route('api.rooms.destroy', ['room' => $room]);

        $this
            ->actingWithToken($token)
            ->delete($url)
            ->assertStatus(422);

        $room->refresh();
        $this->assertEquals($end, $room->ends_at);
    }

    public function testDestroyCannotBeCalledByAnotherUser()
    {
        $owner = User::factory()->create();
        $token = Token::factory()->create(['scopes' => ['*']]);
        $start = now();
        $end = $start->addMinutes(60);
        $room = Room::factory()->create([
            'user_id' => $owner->getKey(),
            'starts_at' => $start,
            'ends_at' => $end,
            'type' => Room::PLAYLIST_TYPE,
        ]);
        $url = route('api.rooms.destroy', ['room' => $room]);
        $end = $room->ends_at; // creation truncates fractional second part, so refetch here

        $this
            ->actingWithToken($token)
            ->delete($url)
            ->assertStatus(403);

        $room->refresh();
        $this->assertEquals($end, $room->ends_at);
    }

    public function testDestroyCannotBeCalledAfterGracePeriod()
    {
        $token = Token::factory()->create(['scopes' => ['*']]);
        $start = now();
        $end = $start->addMinutes(60);
        $room = Room::factory()->create([
            'user_id' => $token->user,
            'starts_at' => $start,
            'ends_at' => $end,
            'type' => Room::PLAYLIST_TYPE,
        ]);
        $url = route('api.rooms.destroy', ['room' => $room]);
        $end = $room->ends_at; // creation truncates fractional second part, so refetch here

        $this->travelTo($start->addMinutes(6));
        $this
            ->actingWithToken($token)
            ->delete($url)
            ->assertStatus(422);

        $room->refresh();
        $this->assertEquals($end, $room->ends_at);
    }

    public static function dataProviderForTestStoreWithInvalidPlayableMods(): array
    {
        $ret = [];
        foreach ([Arr::random(Room::REALTIME_TYPES), Room::PLAYLIST_TYPE] as $type) {
            foreach (['allowed', 'required'] as $modType) {
                $ret[] = [$type, $modType];
            }
        }

        return $ret;
    }

    public static function dataProviderForTestStoreWithInvalidRealtimeAllowedMods(): array
    {
        return [
            [Arr::random(Room::REALTIME_TYPES), false],
            [Room::PLAYLIST_TYPE, true],
        ];
    }

    public static function dataProviderForTestStoreWithInvalidRealtimeMods(): array
    {
        return [
            [Arr::random(Room::REALTIME_TYPES), false],
            [Room::PLAYLIST_TYPE, true],
        ];
    }

    /**
     * If making playlist, add `ends_at`.
     * If making realtime, add `type`.
     */
    private function createBasicStoreParams($ruleset = null)
    {
        $beatmapset = Beatmapset::factory()->create();
        $beatmapParams = ['beatmapset_id' => $beatmapset];
        if ($ruleset !== null) {
            $beatmapParams['playmode'] = Beatmap::MODES[$ruleset];
        }
        $beatmap = Beatmap::factory()->create($beatmapParams);

        return [
            'name' => 'test room '.rand(),
            'playlist' => [
                [
                    'allowed_mods' => [
                        [
                            'acronym' => 'PF',
                            'settings' => [],
                        ],
                    ],
                    'beatmap_id' => $beatmap->getKey(),
                    'required_mods' => [
                        [
                            'acronym' => 'DT',
                            'settings' => [],
                        ],
                    ],
                    'ruleset_id' => $beatmap->playmode,
                ],
            ],
        ];
    }
}
