<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers\Chat;

use App\Libraries\UserChannelList;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\Multiplayer\ScoreLink;
use App\Models\Multiplayer\UserScoreAggregate;
use App\Models\OAuth\Client;
use App\Models\User;
use Illuminate\Testing\AssertableJsonString;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ChannelsControllerTest extends TestCase
{
    private User $user;
    private User $anotherUser;
    private Channel $pmChannel;
    private Channel $privateChannel;
    private Channel $publicChannel;
    private Message $publicMessage;

    public static function dataProviderForTestChannelStoreAnnouncement()
    {
        return [
            [['*'], false, false, false],
            [['*'], true, true, false],
            [['chat.write_manage'], false, false, true],
            [['chat.write_manage'], true, true, false],
        ];
    }

    //region GET /chat/channels - Get Channel List
    public function testChannelIndexWhenGuest()
    {
        $this->json('GET', route('api.chat.channels.index'))
            ->assertStatus(401);
    }

    public function testChannelIndex()
    {
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.channels.index'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id])
            ->assertJsonMissing(['channel_id' => $this->privateChannel->channel_id])
            ->assertJsonMissing(['channel_id' => $this->pmChannel->channel_id]);
    }

    //endregion

    //region POST /chat/channels - Create and join channel
    #[DataProvider('dataProviderForTestChannelStoreAnnouncement')]
    public function testChannelStoreAnnouncement(array $scopes, bool $ownClient, bool $success, bool $expectException)
    {
        $sender = User::factory()->withGroup('announce')->create();
        $client = Client::factory()->create($ownClient ? ['user_id' => $sender] : []);
        $users = User::factory()->count(2)->create();

        if ($expectException) {
            $this->expectInvalidScopeException('bot_only');
        }

        $this->actAsScopedUser($sender, $scopes, $client);
        $response = $this
            ->json('POST', route('api.chat.channels.store'), [
                'channel' => [
                    'description' => 'really',
                    'name' => 'important stuff',
                ],
                'message' => 'announcements!!!',
                'target_ids' => $users->pluck('user_id')->toArray(),
                'type' => Channel::TYPES['announce'],
            ]);

        if ($success) {
            $response
                ->assertSuccessful()
                ->assertJson(fn (AssertableJson $json) => $json
                    ->where('type', Channel::TYPES['announce'])
                    ->etc());
        } else {
            $response->assertStatus(403);
        }
    }

    public function testChannelStoreInvalid()
    {
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('POST', route('api.chat.channels.store'), [
            'type' => Channel::TYPES['public'],
        ])->assertStatus(422);

        $this->json('POST', route('api.chat.channels.store'), [
            'type' => Channel::TYPES['pm'],
        ])->assertStatus(422);
    }

    public function testChannelStorePM()
    {
        $initialChannels = Channel::count();

        $this->actAsScopedUser($this->user, ['*']);
        $this->json('POST', route('api.chat.channels.store'), [
            'target_id' => $this->anotherUser->getKey(),
            'type' => Channel::TYPES['pm'],
        ])->assertSuccessful()
            ->assertJsonFragment([
                'channel_id' => null,
                'recent_messages' => [],
            ]);

        $this->assertSame($initialChannels, Channel::count());
    }

    public function testChannelStorePMUserLeft()
    {
        $channel = Channel::createPM($this->user, $this->anotherUser);
        $channel->removeUser($this->user);

        // sanity check
        $this->getAssertableChannelList($this->user)
            ->assertMissing(['channel_id' => $channel->getKey()]);

        $this->actAsScopedUser($this->user, ['*']);
        $this->json('POST', route('api.chat.channels.store'), [
            'target_id' => $this->anotherUser->getKey(),
            'type' => Channel::TYPES['pm'],
        ])->assertSuccessful()
            ->assertJsonFragment([
                'channel_id' => $channel->getKey(),
                'recent_messages' => [],
                'type' => Channel::TYPES['pm'],
            ]);

        $this->assertTrue($channel->hasUser($this->user));
    }

    //endregion

    /**
     * @dataProvider dataProvider
     */
    public function testChannelJoin($type, $success)
    {
        $channel = Channel::factory()->type($type)->create();
        $status = $success ? 200 : 403;

        $this->actAsScopedUser($this->user, ['*']);

        $this->getAssertableChannelList($this->user)
            ->assertMissing(['channel_id' => $channel->getKey()]);

        // join channel
        $request = $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $channel->getKey(),
            'user' => $this->user->getKey(),
        ]))->assertStatus($status);

        if ($success) {
            $request->assertJsonFragment(['channel_id' => $channel->getKey()]);

            // ensure now in channel
            $this->getAssertableChannelList($this->user)
                ->assertFragment(['channel_id' => $channel->getKey()]);
        }
    }

    //region PUT /chat/channels/[channel_id]/users/[user_id] - Join Channel (public)
    public function testChannelJoinPublicWhenGuest() // fail
    {
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $this->publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(401);
    }

    public function testChannelJoinPublicWhenDifferentUser() // fail
    {
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $this->publicChannel->channel_id,
            'user' => $this->anotherUser->user_id,
        ]))
            ->assertStatus(403);
    }

    public function testChannelJoinPM() // fail
    {
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $this->pmChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(403);
    }

    public function testChannelJoinMultiplayerWhenNotParticipated()
    {
        $scoreLink = ScoreLink::factory()->create();
        UserScoreAggregate::lookupOrDefault($scoreLink->user, $scoreLink->playlistItem->room)->recalculate();

        $this->actAsScopedUser($this->user, ['*']);
        $request = $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $scoreLink->playlistItem->room->channel_id,
            'user' => $this->user->getKey(),
        ]));

        $request->assertStatus(403);
    }

    public function testChannelJoinMultiplayerWhenParticipated()
    {
        $scoreLink = ScoreLink::factory()->create(['user_id' => $this->user]);
        UserScoreAggregate::lookupOrDefault($scoreLink->user, $scoreLink->playlistItem->room)->recalculate();

        $this->actAsScopedUser($this->user, ['*']);
        $request = $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $scoreLink->playlistItem->room->channel_id,
            'user' => $this->user->getKey(),
        ]));

        $request->assertStatus(403);
    }

    //endregion

    //region PUT /chat/channels/[channel_id]/mark-as-read/[message_id] - Mark Channel as Read
    public function testChannelMarkAsReadWhenGuest() // fail
    {
        $this->json(
            'PUT',
            route('api.chat.channels.mark-as-read', [
                'channel' => $this->publicChannel->channel_id,
                'message' => $this->publicMessage->message_id,
            ])
        )
            ->assertStatus(401);
    }

    public function testChannelMarkAsReadWhenUnjoined() // fail
    {
        $this->actAsScopedUser($this->user, ['*']);
        $this->json(
            'PUT',
            route('api.chat.channels.mark-as-read', [
                'channel' => $this->publicChannel->channel_id,
                'message' => $this->publicMessage->message_id,
            ])
        )
            ->assertStatus(404);
    }

    public function testChannelMarkAsReadWhenJoined() // success
    {
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $this->publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]));

        $this->actAsScopedUser($this->user, ['*']);
        $this->json(
            'PUT',
            route('api.chat.channels.mark-as-read', [
                'channel' => $this->publicChannel->channel_id,
                'message' => $this->publicMessage->message_id,
            ])
        )
            ->assertStatus(204);

        $this->getAssertableChannelList($this->user)
            ->assertPath('0.current_user_attributes.last_read_id', $this->publicMessage->message_id)
            ->assertFragment([
                'channel_id' => $this->publicChannel->channel_id,
                'last_read_id' => $this->publicMessage->message_id,
            ]);
    }

    public function testChannelMarkAsReadBackwards() // success (with no change)
    {
        $newerPublicMessage = Message::factory()->create(['channel_id' => $this->publicChannel]);

        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $this->publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]));

        // mark as read to $newerPublicMessage->message_id
        $this->actAsScopedUser($this->user, ['*']);
        $this->json(
            'PUT',
            route('api.chat.channels.mark-as-read', [
                'channel' => $this->publicChannel->channel_id,
                'message' => $newerPublicMessage->message_id,
            ])
        )
            ->assertStatus(204);

        $this->getAssertableChannelList($this->user)
            ->assertPath('0.current_user_attributes.last_read_id', $newerPublicMessage->message_id)
            ->assertFragment([
                'channel_id' => $this->publicChannel->channel_id,
                'last_read_id' => $newerPublicMessage->message_id,
            ]);

        // attempt to mark as read to the older $this->publicMessage->message_id
        $this->actAsScopedUser($this->user, ['*']);
        $this->json(
            'PUT',
            route('api.chat.channels.mark-as-read', [
                'channel' => $this->publicChannel->channel_id,
                'message' => $this->publicMessage->message_id,
            ])
        )
            ->assertStatus(204);

        $this->getAssertableChannelList($this->user)
            ->assertPath('0.current_user_attributes.last_read_id', $newerPublicMessage->message_id)
            ->assertFragment([
                'channel_id' => $this->publicChannel->channel_id,
                'last_read_id' => $newerPublicMessage->message_id,
            ]);
    }

    //endregion

    //region DELETE /chat/channels/[channel_id]/users/[user_id] - Leave Channel
    /**
     * @dataProvider dataProvider
     */
    public function testChannelLeave($type, $success)
    {
        $channel = Channel::factory()->type($type)->create();
        $channel->addUser($this->user);
        $status = $success ? 204 : 403;

        $this->actAsScopedUser($this->user, ['*']);

        // ensure in channel
        $this->getAssertableChannelList($this->user)
            ->assertFragment(['channel_id' => $channel->getKey()]);

        // leave channel
        $this->json('DELETE', route('api.chat.channels.part', [
            'channel' => $channel->channel_id,
            'user' => $this->user->getKey(),
        ]))
            ->assertStatus($status);

        $channelList = $this->getAssertableChannelList($this->user);

        if ($success) {
            // ensure no longer in channel
            $channelList->assertMissing(['channel_id' => $channel->getKey()]);
        } else {
            // ensure still in channel
            $channelList->assertFragment(['channel_id' => $channel->getKey()]);
        }
    }

    /**
     * @dataProvider dataProvider
     */
    public function testChannelLeaveWhenNotJoined($type, $success)
    {
        $channel = Channel::factory()->type($type)->create();
        $status = $success ? 204 : 403;

        $this->actAsScopedUser($this->user, ['*']);

        // ensure not in channel
        $this->getAssertableChannelList($this->user)
            ->assertMissing(['channel_id' => $channel->getKey()]);

        // leave channel
        $this->json('DELETE', route('api.chat.channels.part', [
            'channel' => $channel->channel_id,
            'user' => $this->user->getKey(),
        ]))
            ->assertStatus($status);
    }

    public function testChannelLeavePublicWhenGuest() // fail
    {
        $this->json('DELETE', route('api.chat.channels.part', [
            'channel' => $this->publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(401);
    }

    //endregion

    public static function dataProvider()
    {
        return [
            ['private', false],
            ['public', true],
            ['tourney', true],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->anotherUser = User::factory()->create();
        $this->publicChannel = Channel::factory()->type('public')->create();
        $this->privateChannel = Channel::factory()->type('private')->create();
        $this->pmChannel = Channel::factory()->type('pm')->create();
        $this->publicMessage = Message::factory()->create(['channel_id' => $this->publicChannel]);
    }

    private function getAssertableChannelList(User $user): AssertableJsonString
    {
        return new AssertableJsonString((new UserChannelList($user))->get());
    }
}
