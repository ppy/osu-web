<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Chat;

use App\Models\Chat;
use App\Models\Chat\Channel;
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

    public function testChannelJoinNonPublic() // fail
    {
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $this->privateChannel->channel_id,
            'user' => $this->user->user_id,
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

    public function testChannelJoinPublic() // succeed
    {
        // ensure not in channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->publicChannel->channel_id]);

        // join channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $this->publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id]);

        // ensure now in channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id]);
    }

    public function testChannelJoinPublicWhenAlreadyJoined() // succeed
    {
        // ensure not in channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->publicChannel->channel_id]);

        // join channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $this->publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id]);

        // ensure now in channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id]);

        // attempt to join channel again
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $this->publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id]);

        // ensure still in channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id]);
    }

    public function testChannelJoinTourney() // succeed
    {
        // ensure not in channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->tourneyChannel->channel_id]);

        // join channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $this->tourneyChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->tourneyChannel->channel_id]);

        // ensure now in channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->tourneyChannel->channel_id]);
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
            ->assertJsonFragment([
                'channel_id' => $this->publicChannel->channel_id,
                'last_read_id' => $newerPublicMessage->message_id,
            ]);
    }

    //endregion

    //region DELETE /chat/channels/[channel_id]/users/[user_id] - Leave Channel
    public function testChannelLeavePublicWhenGuest() // fail
    {
        $this->json('DELETE', route('api.chat.channels.part', [
            'channel' => $this->publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(401);
    }

    public function testChannelLeavePrivate() // fail
    {
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('DELETE', route('api.chat.channels.part', [
            'channel' => $this->privateChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(403);
    }

    public function testChannelLeavePublicWhenNotJoined() // success ?
    {
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->publicChannel->channel_id]);

        $this->actAsScopedUser($this->user, ['*']);
        $this->json('DELETE', route('api.chat.channels.part', [
            'channel' => $this->publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(204);

        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->publicChannel->channel_id]);
    }

    public function testChannelLeavePublicWhenJoined() // success
    {
        // ensure not in channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->publicChannel->channel_id]);

        // join channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $this->publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id]);

        // ensure now in channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id]);

        // leave channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('DELETE', route('api.chat.channels.part', [
            'channel' => $this->publicChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(204);

        // ensure no longer in channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->publicChannel->channel_id]);
    }

    public function testChannelLeaveTourneyWhenJoined() // success
    {
        // ensure not in channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->tourneyChannel->channel_id]);

        // join channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('PUT', route('api.chat.channels.join', [
            'channel' => $this->tourneyChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->tourneyChannel->channel_id]);

        // ensure now in channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->tourneyChannel->channel_id]);

        // leave channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('DELETE', route('api.chat.channels.part', [
            'channel' => $this->tourneyChannel->channel_id,
            'user' => $this->user->user_id,
        ]))
            ->assertStatus(204);

        // ensure no longer in channel
        $this->actAsScopedUser($this->user, ['*']);
        $this->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->tourneyChannel->channel_id]);
    }

    //endregion

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->anotherUser = factory(User::class)->create();
        $this->publicChannel = factory(Chat\Channel::class)->states('public')->create();
        $this->privateChannel = factory(Chat\Channel::class)->states('private')->create();
        $this->pmChannel = factory(Chat\Channel::class)->states('pm')->create();
        $this->publicMessage = factory(Chat\Message::class)->create(['channel_id' => $this->publicChannel->channel_id]);
        $this->tourneyChannel = factory(Chat\Channel::class)->states('tourney')->create();
    }
}
