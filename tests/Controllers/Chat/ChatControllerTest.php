<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Chat;

use App\Models\Chat;
use App\Models\OAuth\Client;
use App\Models\User;
use App\Models\UserRelation;
use Faker;
use Tests\TestCase;

class ChatControllerTest extends TestCase
{
    // Need to disable transactions for these tests otherwise the cross-database queries being used fail.
    protected $connectionsToTransact = [];

    protected static $faker;

    public static function setUpBeforeClass(): void
    {
        self::$faker = Faker\Factory::create();
    }

    //region POST /chat/new - Create New PM

    /**
     * @dataProvider createPmWithAuthorizedGrantDataProvider
     */
    public function testCreatePmWithAuthorizedGrant($scopes, $expectedStatus)
    {
        $this->actAsScopedUser($this->user, $scopes);
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus($expectedStatus);
    }

    /**
     * @dataProvider createPmWithClientCredentialsDataProvider
     */
    public function testCreatePmWithClientCredentials($scopes, $expectedStatus)
    {
        $client = factory(Client::class)->create(['user_id' => $this->user->getKey()]);
        $this->actAsScopedUser(null, $scopes, $client);
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus($expectedStatus);
    }

    /**
     * @dataProvider createPmWithClientCredentialsBotGroupDataProvider
     */
    public function testCreatePmWithClientCredentialsBotGroup($scopes, $expectedStatus)
    {
        $client = factory(Client::class)->create(['user_id' => $this->user->getKey()]);
        $this->user->update(['group_id' => app('groups')->byIdentifier('bot')->getKey()]);
        $this->actAsScopedUser(null, $scopes, $client);
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus($expectedStatus);
    }

    public function testCreatePMWhenAlreadyExists() // success
    {
        $this->actAsScopedUser($this->user, ['*']);
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(200);

        // should return existing conversation and not error
        app('OsuAuthorize')->cacheReset();
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(200);
    }

    public function testCreatePMWhenLeftChannel() // success
    {
        $this->actAsScopedUser($this->user, ['*']);
        $request = $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        );

        $channelId = $request->json('new_channel_id');
        $request->assertSuccessful();

        app('OsuAuthorize')->cacheReset();
        $this->json(
            'DELETE',
            route('api.chat.channels.part', [
                'channel' => $channelId,
                'user' => $this->user->user_id,
            ])
        )->assertSuccessful();

        app('OsuAuthorize')->cacheReset();
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertSuccessful();
    }

    public function testCreatePMWhenGuest() // fail
    {
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(401);
    }

    public function testCreatePMWhenBlocked() // fail
    {
        factory(UserRelation::class)->states('block')->create([
            'user_id' => $this->anotherUser->user_id,
            'zebra_id' => $this->user->user_id,
        ]);

        $this->actAsScopedUser($this->user, ['*']);
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(403);
    }

    public function testCreatePMWhenRestricted() // fail
    {
        $restrictedUser = factory(User::class)->states('restricted')->create();

        $this->actAsScopedUser($restrictedUser, ['*']);
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(403);
    }

    public function testCreatePMWhenSilenced() // fail
    {
        $silencedUser = factory(User::class)->states('silenced')->create();

        $this->actAsScopedUser($silencedUser, ['*']);
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(403);
    }

    public function testCreatePMWhenTargetRestricted() // fail
    {
        $restrictedUser = factory(User::class)->states('restricted')->create();

        $this->actAsScopedUser($this->user, ['*']);
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $restrictedUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(422);
    }

    public function testCreatePMWithSelf() // fail
    {
        $this->actAsScopedUser($this->user, ['*']);
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->user->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(422);
    }

    public function testCreatePMWhenFriendsOnlyAndNotFriended() // fail
    {
        $privateUser = factory(User::class)->create(['pm_friends_only' => true]);

        $this->actAsScopedUser($this->user, ['*']);
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $privateUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(403);
    }

    public function testCreatePMWhenFriendsOnlyAndFriended() // success
    {
        $privateUser = factory(User::class)->create(['pm_friends_only' => true]);
        factory(UserRelation::class)->states('friend')->create([
            'user_id' => $privateUser->user_id,
            'zebra_id' => $this->user->user_id,
        ]);

        $this->actAsScopedUser($this->user, ['*']);
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $privateUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(200);
    }

    //endregion

    //region GET /chat/presence - Get Presence
    public function testChatPresenceWhenGuest() // fail
    {
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(401);
    }

    public function testChatPresence() // success
    {
        $publicChannel = factory(Chat\Channel::class)->states('public')->create();

        // join the channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertSuccessful();

        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $publicChannel->channel_id]);
    }

    public function testChatPresenceHidesBlocked() // success
    {
        // start conversation with $this->anotherUser
        $this->actAsScopedUser($this->user, ['*']);
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(200);

        // block $this->anotherUser
        $block = factory(UserRelation::class)->states('block')->create([
            'user_id' => $this->user->user_id,
            'zebra_id' => $this->anotherUser->user_id,
        ]);

        // ensure conversation with $this->anotherUser isn't visible
        app('OsuAuthorize')->cacheReset();
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['users' => [
                $this->user->user_id,
                $this->anotherUser->user_id,
            ]]);

        // unblock $this->anotherUser
        $block->delete();

        // ensure conversation with $this->anotherUser is visible again
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['users' => [
                $this->user->user_id,
                $this->anotherUser->user_id,
            ]]);
    }

    public function testChatPresenceHidesRestricted() // success
    {
        // start conversation with $this->anotherUser
        $this->actAsScopedUser($this->user, ['*']);
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(200);

        // restrict $this->anotherUser
        $this->anotherUser->update(['user_warnings' => 1]);

        // ensure conversation with $this->anotherUser isn't visible
        app('OsuAuthorize')->cacheReset();
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['users' => [
                $this->user->user_id,
                $this->anotherUser->user_id,
            ]]);

        // unrestrict $this->anotherUser
        $this->anotherUser->update(['user_warnings' => 0]);

        // ensure conversation with $this->anotherUser is visible again
        app('OsuAuthorize')->cacheReset();
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['users' => [
                $this->user->user_id,
                $this->anotherUser->user_id,
            ]]);
    }

    public function testChatPresenceHidesHidden() // success
    {
        // start conversation with $this->anotherUser
        $this->actAsScopedUser($this->user, ['*']);
        $response = $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(200);

        $presenceData = $response->decodeResponseJson();
        $channelId = $presenceData['new_channel_id'];

        // leave PM with $this->anotherUser
        app('OsuAuthorize')->cacheReset();
        $this->json('DELETE', route('api.chat.channels.part', [
            'channel' => $channelId,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(204);

        // ensure conversation with $this->anotherUser isn't visible
        app('OsuAuthorize')->cacheReset();
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['users' => [
                $this->user->user_id,
                $this->anotherUser->user_id,
            ]]);

        // reopen PM with $this->anotherUser
        app('OsuAuthorize')->cacheReset();
        $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(200);

        // ensure conversation with $this->anotherUser is visible again
        app('OsuAuthorize')->cacheReset();
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['users' => [
                $this->user->user_id,
                $this->anotherUser->user_id,
            ]]);
    }

    //endregion

    //region GET /chat/updates?since=[message_id] - Get Updates
    public function testChatUpdatesWhenGuest() // fail
    {
        $this->json('GET', route('api.chat.updates'))
            ->assertStatus(401);
    }

    public function testChatUpdatesWithNoNewMessages() // success
    {
        $publicChannel = factory(Chat\Channel::class)->states('public')->create();
        $publicMessage = factory(Chat\Message::class)->create(['channel_id' => $publicChannel->channel_id]);

        // join the channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertSuccessful();

        app('OsuAuthorize')->cacheReset();
        $this->json('GET', route('api.chat.updates'), ['since' => $publicMessage->message_id])
            ->assertStatus(204);
    }

    public function testChatUpdates() // success
    {
        $publicChannel = factory(Chat\Channel::class)->states('public')->create();
        $publicMessage = factory(Chat\Message::class)->create(['channel_id' => $publicChannel->channel_id]);

        // join channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertSuccessful();

        app('OsuAuthorize')->cacheReset();
        $this->json('GET', route('api.chat.updates'), ['since' => 0])
            ->assertStatus(200)
            ->assertJsonFragment(['content' => $publicMessage->content]);
    }

    public function testChatUpdatesHidesRestrictedUserMessages() // success
    {
        // create PM
        $this->actAsScopedUser($this->user, ['*']);
        $response = $this->json(
            'POST',
            route('api.chat.new'),
            [
                'target_id' => $this->anotherUser->user_id,
                'message' => self::$faker->sentence(),
            ]
        )->assertStatus(200);

        $presenceData = $response->decodeResponseJson();
        $channelId = $presenceData['new_channel_id'];

        // create reply
        $publicMessage = factory(Chat\Message::class)->create([
            'user_id' => $this->anotherUser->user_id,
            'channel_id' => $channelId,
        ]);

        // ensure reply is visible
        app('OsuAuthorize')->cacheReset();
        $this->json('GET', route('api.chat.updates'), ['since' => 0])
            ->assertStatus(200)
            ->assertJsonFragment(['content' => $publicMessage->content]);

        // restrict $this->anotherUser
        $this->anotherUser->update(['user_warnings' => 1]);

        // ensure reply is no longer visible
        app('OsuAuthorize')->cacheReset();
        $this->json('GET', route('api.chat.updates'), ['since' => 0])
            ->assertStatus(204);
    }

    //endregion

    public function createPmWithAuthorizedGrantDataProvider()
    {
        return [
            [['*'], 200],
            // there's no test for bot because the test setup itself is expected to fail when setting the token.
            [['public'], 403],
        ];
    }

    public function createPmWithClientCredentialsDataProvider()
    {
        return [
            // TODO: need to add test that validates auth guard calls Token::validate
            [['public'], 403],
        ];
    }

    public function createPmWithClientCredentialsBotGroupDataProvider()
    {
        return [
            [['bot', 'chat.write'], 200],
            [['public'], 403],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $trx = [];
        $db = $this->app->make('db');
        foreach (array_keys(config('database.connections')) as $name) {
            $connection = $db->connection($name);

            // connections with different names but to the same database share the same pdo connection.
            $id = $connection->select('SELECT CONNECTION_ID() as connection_id')[0]->connection_id;
            // Avoid setting isolation level or starting transaction more than once on a pdo connection.
            if (!in_array($id, $trx, true)) {
                $trx[] = $id;

                // allow uncommitted changes be visible across connections.
                $connection->statement('SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED');
                $connection->beginTransaction();
            }
        }

        $this->user = factory(User::class)->create();
        $minPlays = config('osu.user.min_plays_for_posting');
        $this->user->statisticsOsu()->create(['playcount' => $minPlays]);

        $this->anotherUser = factory(User::class)->create();
    }
}
