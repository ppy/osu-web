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
use App\Models\Beatmap;
use App\Models\User;
use App\Models\Chat;
use App\Models\Chat\UserChannel;

class ChannelsControllerTest extends TestCase
{
    private function log($thing)
    {
        fwrite(STDERR, json_encode($thing));
    }

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->anotherUser = factory(User::class)->create();
        $this->publicChannel = factory(Chat\Channel::class)->states('public')->create();
        $this->privateChannel = factory(Chat\Channel::class)->states('private')->create();
        // $this->userChannel = factory(UserChannel::class)->create([
        //     'user_id' => $this->user->user_id,
        //     'channel_id' => $this->publicChannel->channel_id,
        // ]);
    }

    #region GET /chat/channels - Get Channel List
    public function testChannelIndexWhenGuest()
    {
        $this->json('GET', route('chat.channels.index'))
            ->assertStatus(401);
    }

    public function testChannelIndex()
    {
        $this->actingAs($this->user)
            ->json('GET', route('chat.channels.index'))
            ->assertStatus(200);
    }
    #endregion

    #region PUT /chat/channels/[channel_id]/users/[user_id] - Join Channel (public)
    public function testChannelJoinPublicWhenGuest() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        $this->actingAs($this->user)
            ->json('PUT', route('chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id
            ]))
            ->assertStatus(401);
    }

    public function testChannelJoinPublicWhenDifferentUser() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        $this->actingAs($this->user)
            ->json('PUT', route('chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->anotherUser->user_id
            ]))
            ->assertStatus(401);
    }

    public function testChannelJoinNonPublic() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        $this->actingAs($this->user)
            ->json('PUT', route('chat.channels.join', [
                'channel_id' => $this->privateChannel->channel_id,
                'user_id' => $this->user->user_id
            ]))
            ->assertStatus(401);
    }

    public function testChannelJoinPublic() // succeed
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        $this->actingAs($this->user)
            ->json('PUT', route('chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id
            ]))
            ->assertStatus(200);
    }
    #endregion

    #region GET /chat/channels/[channel_id] - Get Channel Messages (public)
    public function testChannelShowPublicWhenGuest() // fail
    {
        $this->json('GET', route('chat.channels.show', ['channel_id' => $this->publicChannel->channel_id]))
            ->assertStatus(401);
    }

    public function testChannelShowPublicWhenUnjoined() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        $this->actingAs($this->user)
            ->json('GET', route('chat.channels.show', ['channel_id' => $this->publicChannel->channel_id]))
            ->assertStatus(401);
    }

    public function testChannelShowPublic() // success
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        $this->actingAs($this->user)
            ->json('GET', route('chat.channels.show', ['channel_id' => $this->publicChannel->channel_id]))
            ->assertStatus(200)
            ->assertJson([]);

        // fwrite(STDERR, json_encode($this->userChannel));
        // fwrite(STDERR, $derp->content());
    }
    #endregion

    #region GET /chat/channels/[channel_id] - Get Channel Messages (private)
    public function testChannelShowPrivateWhenGuest() // fail
    {
        $this->json('GET', route('chat.channels.show', ['channel_id' => $this->privateChannel->channel_id]))
            ->assertStatus(401);
    }

    public function testChannelShowPrivateWhenUnauthorized() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        $this->json('GET', route('chat.channels.show', ['channel_id' => $this->privateChannel->channel_id]))
            ->assertStatus(401);
    }

    public function testChannelShowPrivate() // success
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        $this->actingAs($this->user)
            ->json('GET', route('chat.channels.show', ['channel_id' => $this->privateChannel->channel_id]))
            ->assertStatus(200)
            ->assertJson([]);

        // fwrite(STDERR, json_encode($this->userChannel));
        // fwrite(STDERR, $derp->content());
    }
    #endregion

    #region GET /chat/channels/[channel_id] - Get Channel Messages (pm)
    public function testChannelShowPMWhenGuest() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testChannelShowPMWhenUnjoined() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testChannelShowPM() // success
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    #endregion

    #region POST /chat/channels/[channel_id]/messages - Send Message to Channel
    public function testChannelSendWhenGuest() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testChannelSendWhenUnjoined() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testChannelSendWhenBlocked() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testChannelSend() // success
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    #endregion

    #region PUT /chat/channels/[channel_id]/mark-as-read/[message_id] - Mark Channel as Read
    public function testChannelMarkAsReadWhenGuest() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testChannelMarkAsReadWhenUnjoined() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testChannelMarkAsReadBackwards() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testChannelMarkAsRead() // success
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    #endregion

    #region DELETE /chat/channels/[channel_id]/users/[user_id] - Leave Channel
    public function testChannelLeaveWhenGuest() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testChannelLeaveWhenNotPublic() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testChannelLeaveWhenNotJoined() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testChannelLeave() // success
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    #endregion
}
