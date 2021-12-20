<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Chat;

use App\Models\Chat;
use App\Models\Chat\Channel;
use App\Models\Multiplayer\Score;
use App\Models\User;
use Faker;
use Tests\TestCase;

class ChannelsControllerTest extends TestCase
{
    protected static $faker;

    public static function setUpBeforeClass(): void
    {
        self::$faker = Faker\Factory::create();
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
        $this->assertFalse($channel->hasUser($this->user));

        $this->actAsScopedUser($this->user, ['*']);
        $this->json('POST', route('api.chat.channels.store'), [
            'target_id' => $this->anotherUser->getKey(),
            'type' => Channel::TYPES['pm'],
        ])->assertSuccessful()
            ->assertJsonFragment([
                'channel_id' => $channel->getKey(),
                'recent_messages' => [],
            ]);

        $this->assertTrue($channel->hasUser($this->user));
    }

    //endregion

    /**
     * @dataProvider dataProvider
     */
    public function testChannelJoin($type, $success)
    {
        $channel = factory(Channel::class)->states($type)->create();
        $status = $success ? 200 : 403;

        $this->actAsScopedUser($this->user, ['*']);

        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $channel->getKey()]);

        // join channel
        $request = $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $channel->getKey(),
            'user' => $this->user->getKey(),
        ]))->assertStatus($status);

        if ($success) {
            $request->assertJsonFragment(['channel_id' => $channel->getKey()]);

            // ensure now in channel
            $this->json('GET', route('api.chat.presence'))
                ->assertStatus(200)
                ->assertJsonFragment(['channel_id' => $channel->getKey()]);
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
        $score = factory(Score::class)->create();

        $this->actAsScopedUser($this->user, ['*']);
        $request = $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $score->room->channel_id,
            'user' => $this->user->getKey(),
        ]));

        $request->assertStatus(403);
    }

    public function testChannelJoinMultiplayerWhenParticipated()
    {
        $score = factory(Score::class)->create(['user_id' => $this->user->getKey()]);

        $this->actAsScopedUser($this->user, ['*']);
        $request = $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $score->room->channel_id,
            'user' => $this->user->getKey(),
        ]));

        $request->assertStatus(200)->assertJsonFragment(['channel_id' => $score->room->channel_id]);
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

        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonPath('0.current_user_attributes.last_read_id', $this->publicMessage->message_id)
            ->assertJsonFragment([
                'channel_id' => $this->publicChannel->channel_id,
                'last_read_id' => $this->publicMessage->message_id,
            ]);
    }

    public function testChannelMarkAsReadBackwards() // success (with no change)
    {
        $newerPublicMessage = factory(Chat\Message::class)->create(['channel_id' => $this->publicChannel->channel_id]);

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

        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonPath('0.current_user_attributes.last_read_id', $newerPublicMessage->message_id)
            ->assertJsonFragment([
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

        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonPath('0.current_user_attributes.last_read_id', $newerPublicMessage->message_id)
            ->assertJsonFragment([
                'channel_id' => $this->publicChannel->channel_id,
                'last_read_id' => $newerPublicMessage->message_id,
            ]);
    }

    //endregion

    /**
     * @dataProvider dataProvider
     */
    public function testChannelLeave($type, $success)
    {
        $channel = factory(Channel::class)->states($type)->create();
        $channel->addUser($this->user);
        $status = $success ? 204 : 403;

        $this->actAsScopedUser($this->user, ['*']);

        // ensure in channel
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $channel->getKey()]);

        // leave channel
        $this->json('DELETE', route('api.chat.channels.part', [
            'channel' => $channel->channel_id,
            'user' => $this->user->getKey(),
        ]))
            ->assertStatus($status);

        if ($success) {
            // ensure no longer in channel
            $this->json('GET', route('api.chat.presence'))
                ->assertStatus(200)
                ->assertJsonMissing(['channel_id' => $channel->getKey()]);
        } else {
            // ensure still in channel
            $this->json('GET', route('api.chat.presence'))
                ->assertStatus(200)
                ->assertJsonFragment(['channel_id' => $channel->getKey()]);
        }
    }

    /**
     * @dataProvider dataProvider
     */
    public function testChannelLeaveWhenNotJoined($type, $success)
    {
        $channel = factory(Channel::class)->states($type)->create();
        $status = $success ? 204 : 403;

        $this->actAsScopedUser($this->user, ['*']);

        // ensure not in channel
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $channel->getKey()]);

        // leave channel
        $this->json('DELETE', route('api.chat.channels.part', [
            'channel' => $channel->channel_id,
            'user' => $this->user->getKey(),
        ]))
            ->assertStatus($status);
    }

    //region DELETE /chat/channels/[channel_id]/users/[user_id] - Leave Channel
    public function testChannelLeavePublicWhenGuest() // fail
    {
        $this->json('DELETE', route('api.chat.channels.part', [
            'channel' => $this->publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(401);
    }

    //endregion

    public function dataProvider()
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
        $this->publicChannel = factory(Chat\Channel::class)->states('public')->create();
        $this->privateChannel = factory(Chat\Channel::class)->states('private')->create();
        $this->pmChannel = factory(Chat\Channel::class)->states('pm')->create();
        $this->publicMessage = factory(Chat\Message::class)->create(['channel_id' => $this->publicChannel->channel_id]);
        $this->tourneyChannel = factory(Chat\Channel::class)->states('tourney')->create();
    }
}
