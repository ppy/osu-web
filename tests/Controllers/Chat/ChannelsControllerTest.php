<?php
/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace Tests\Chat;

use App\Models\Chat;
use App\Models\User;
use Faker;
use TestCase;

class ChannelsControllerTest extends TestCase
{
    protected static $faker;

    public static function setUpBeforeClass()
    {
        self::$faker = Faker\Factory::create();
    }

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->anotherUser = factory(User::class)->create();
        $this->publicChannel = factory(Chat\Channel::class)->states('public')->create();
        $this->privateChannel = factory(Chat\Channel::class)->states('private')->create();
        $this->pmChannel = factory(Chat\Channel::class)->states('pm')->create();
        $this->publicMessage = factory(Chat\Message::class)->create(['channel_id' => $this->publicChannel->channel_id]);
    }

    //region GET /chat/channels - Get Channel List
    public function testChannelIndexWhenGuest()
    {
        $this->json('GET', route('api.chat.channels.index'))
            ->assertStatus(401);
    }

    public function testChannelIndex()
    {
        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.channels.index'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id])
            ->assertJsonMissing(['channel_id' => $this->privateChannel->channel_id])
            ->assertJsonMissing(['channel_id' => $this->pmChannel->channel_id]);
    }

    //endregion

    //region PUT /chat/channels/[channel_id]/users/[user_id] - Join Channel (public)
    public function testChannelJoinPublicWhenGuest() // fail
    {
        $this->json('PUT', route('api.chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]))
            ->assertStatus(401);
    }

    public function testChannelJoinPublicWhenDifferentUser() // fail
    {
        $this->actingAs($this->user, 'api')
            ->json('PUT', route('api.chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->anotherUser->user_id,
            ]))
            ->assertStatus(403);
    }

    public function testChannelJoinNonPublic() // fail
    {
        $this->actingAs($this->user, 'api')
            ->json('PUT', route('api.chat.channels.join', [
                'channel_id' => $this->privateChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]))
            ->assertStatus(404);
    }

    public function testChannelJoinPublic() // succeed
    {
        // ensure not in channel
        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->publicChannel->channel_id]);

        // join channel
        $this->actingAs($this->user, 'api')
            ->json('PUT', route('api.chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]))
            ->assertStatus(204);

        // ensure now in channel
        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id]);
    }

    public function testChannelJoinPublicWhenAlreadyJoined() // succeed
    {
        // ensure not in channel
        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->publicChannel->channel_id]);

        // join channel
        $this->actingAs($this->user, 'api')
            ->json('PUT', route('api.chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]))
            ->assertStatus(204);

        // ensure now in channel
        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id]);

        // attempt to join channel again
        $this->actingAs($this->user, 'api')
            ->json('PUT', route('api.chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]))
            ->assertStatus(204);

        // ensure still in channel
        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id]);
    }

    //endregion

    //region PUT /chat/channels/[channel_id]/mark-as-read/[message_id] - Mark Channel as Read
    public function testChannelMarkAsReadWhenGuest() // fail
    {
        $this->json(
            'PUT',
            route('api.chat.channels.mark-as-read', [
                'channel_id' => $this->publicChannel->channel_id,
                'message_id' => $this->publicMessage->message_id,
            ])
        )
        ->assertStatus(401);
    }

    public function testChannelMarkAsReadWhenUnjoined() // fail
    {
        $this->actingAs($this->user, 'api')
            ->json(
                'PUT',
                route('api.chat.channels.mark-as-read', [
                    'channel_id' => $this->publicChannel->channel_id,
                    'message_id' => $this->publicMessage->message_id,
                ])
            )
            ->assertStatus(404);
    }

    public function testChannelMarkAsReadWhenJoined() // success
    {
        $this->actingAs($this->user, 'api')
            ->json('PUT', route('api.chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]));

        $this->actingAs($this->user, 'api')
            ->json(
                'PUT',
                route('api.chat.channels.mark-as-read', [
                    'channel_id' => $this->publicChannel->channel_id,
                    'message_id' => $this->publicMessage->message_id,
                ])
            )
            ->assertStatus(204);

        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment([
                'channel_id' => $this->publicChannel->channel_id,
                'last_read_id' => $this->publicMessage->message_id,
            ]);
    }

    public function testChannelMarkAsReadBackwards() // success (with no change)
    {
        $newerPublicMessage = factory(Chat\Message::class)->create(['channel_id' => $this->publicChannel->channel_id]);

        $this->actingAs($this->user, 'api')
            ->json('PUT', route('api.chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]));

        // mark as read to $newerPublicMessage->message_id
        $this->actingAs($this->user, 'api')
            ->json(
                'PUT',
                route('api.chat.channels.mark-as-read', [
                    'channel_id' => $this->publicChannel->channel_id,
                    'message_id' => $newerPublicMessage->message_id,
                ])
            )
            ->assertStatus(204);

        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment([
                'channel_id' => $this->publicChannel->channel_id,
                'last_read_id' => $newerPublicMessage->message_id,
            ]);

        // attempt to mark as read to the older $this->publicMessage->message_id
        $this->actingAs($this->user, 'api')
            ->json(
                'PUT',
                route('api.chat.channels.mark-as-read', [
                    'channel_id' => $this->publicChannel->channel_id,
                    'message_id' => $this->publicMessage->message_id,
                ])
            )
            ->assertStatus(204);

        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment([
                'channel_id' => $this->publicChannel->channel_id,
                'last_read_id' => $newerPublicMessage->message_id,
            ]);
    }

    //endregion

    //region DELETE /chat/channels/[channel_id]/users/[user_id] - Leave Channel
    public function testChannelLeaveWhenGuest() // fail
    {
        $this->json('DELETE', route('api.chat.channels.part', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]))
            ->assertStatus(401);
    }

    public function testChannelLeaveWhenNotPublic() // fail
    {
        $this->actingAs($this->user, 'api')
            ->json('DELETE', route('api.chat.channels.part', [
                'channel_id' => $this->privateChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]))
            ->assertStatus(404);
    }

    public function testChannelLeaveWhenNotJoined() // success ?
    {
        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->publicChannel->channel_id]);

        $this->actingAs($this->user, 'api')
            ->json('DELETE', route('api.chat.channels.part', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]))
            ->assertStatus(204);

        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->publicChannel->channel_id]);
    }

    public function testChannelLeaveWhenJoined() // success
    {
        // ensure not in channel
        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->publicChannel->channel_id]);

        // join channel
        $this->actingAs($this->user, 'api')
            ->json('PUT', route('api.chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]))
            ->assertStatus(204);

        // ensure now in channel
        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonFragment(['channel_id' => $this->publicChannel->channel_id]);

        // leave channel
        $this->actingAs($this->user, 'api')
            ->json('DELETE', route('api.chat.channels.part', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]))
            ->assertStatus(204);

        // ensure no longer in channel
        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.presence'))
            ->assertStatus(200)
            ->assertJsonMissing(['channel_id' => $this->publicChannel->channel_id]);
    }

    //endregion
}
