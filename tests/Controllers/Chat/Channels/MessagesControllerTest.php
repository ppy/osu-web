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

namespace Tests\Chat\Channels;

use App\Models\Chat;
use App\Models\Chat\Message;
use App\Models\Chat\UserChannel;
use App\Models\User;
use App\Models\UserRelation;
use Faker;
use TestCase;

class MessagesControllerTest extends TestCase
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
        $this->restrictedUser = factory(User::class)->states('restricted')->create();
        // TODO: convert $this->silencedUser to use afterCreatingState after upgrading to Laraval 5.6
        $this->silencedUser = factory(User::class)->create();
        $this->silencedUser->accountHistories()->save(
            factory(\App\Models\UserAccountHistory::class)->states('silence')->make()
        );
        $this->publicChannel = factory(Chat\Channel::class)->states('public')->create();
        $this->privateChannel = factory(Chat\Channel::class)->states('private')->create();
        $this->pmChannel = factory(Chat\Channel::class)->states('pm')->create();
    }

    //region GET /chat/channels/[channel_id] - Get Channel Messages (public)
    public function testChannelShowPublicWhenGuest() // fail
    {
        $this->json('GET', route('api.chat.channels.messages.index', ['channel_id' => $this->publicChannel->channel_id]))
            ->assertStatus(401);
    }

    public function testChannelShowPublicWhenUnjoined() // fail
    {
        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.channels.messages.index', ['channel_id' => $this->publicChannel->channel_id]))
            ->assertStatus(404);
    }

    public function testChannelShowPublicWhenJoined() // success
    {
        $this->actingAs($this->user, 'api')
            ->json('PUT', route('api.chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]));

        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.channels.messages.index', ['channel_id' => $this->publicChannel->channel_id]))
            ->assertStatus(200);
        // TODO: Add check for messages being present?
    }

    //endregion

    //region GET /chat/channels/[channel_id] - Get Channel Messages (private)
    public function testChannelShowPrivateWhenGuest() // fail
    {
        $this->json('GET', route('api.chat.channels.messages.index', ['channel_id' => $this->privateChannel->channel_id]))
            ->assertStatus(401);
    }

    public function testChannelShowPrivateWhenNotJoined() // fail
    {
        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.channels.messages.index', ['channel_id' => $this->privateChannel->channel_id]))
            ->assertStatus(404);
    }

    public function testChannelShowPrivateWhenJoined() // success
    {
        $this->userChannel = factory(UserChannel::class)->create([
            'user_id' => $this->user->user_id,
            'channel_id' => $this->privateChannel->channel_id,
        ]);

        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.channels.messages.index', ['channel_id' => $this->privateChannel->channel_id]))
            ->assertStatus(200);
    }

    //endregion

    //region GET /chat/channels/[channel_id] - Get Channel Messages (pm)
    public function testChannelShowPMWhenGuest() // fail
    {
        $this->json('GET', route('api.chat.channels.messages.index', ['channel_id' => $this->pmChannel->channel_id]))
            ->assertStatus(401);
    }

    public function testChannelShowPMWhenNotJoined() // fail
    {
        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.channels.messages.index', ['channel_id' => $this->pmChannel->channel_id]))
            ->assertStatus(404);
    }

    public function testChannelShowPMWhenTargetRestricted() // fail
    {
        $pmChannel = factory(Chat\Channel::class)->states('pm')->create();

        factory(UserChannel::class)->create([
            'user_id' => $this->user->user_id,
            'channel_id' => $pmChannel->channel_id,
        ]);
        factory(UserChannel::class)->create([
            'user_id' => $this->restrictedUser->user_id,
            'channel_id' => $pmChannel->channel_id,
        ]);

        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.channels.messages.index', ['channel_id' => $pmChannel->channel_id]))
            ->assertStatus(404);
    }

    public function testChannelShowPM() // success
    {
        $pmChannel = factory(Chat\Channel::class)->states('pm')->create();
        factory(UserChannel::class)->create([
            'user_id' => $this->user->user_id,
            'channel_id' => $pmChannel->channel_id,
        ]);

        $this->actingAs($this->user, 'api')
            ->json('GET', route('api.chat.channels.messages.index', ['channel_id' => $pmChannel->channel_id]))
            ->assertStatus(200);
        // TODO: Add check for messages being present?
    }

    //endregion

    //region POST /chat/channels/[channel_id]/messages - Send Message to Channel
    public function testChannelSendWhenGuest() // fail
    {
        $this->json(
            'POST',
            route('api.chat.channels.messages.store', ['channel_id' => $this->publicChannel->channel_id]),
            ['message' => self::$faker->sentence()]
        )->assertStatus(401);
    }

    public function testChannelSendWhenUnjoined() // fail
    {
        $this->actingAs($this->user, 'api')
            ->json(
                'POST',
                route('api.chat.channels.messages.store', ['channel_id' => $this->publicChannel->channel_id]),
                ['message' => self::$faker->sentence()]
            )
            ->assertStatus(403);
    }

    public function testChannelSendWhenJoined() // success
    {
        $message = self::$faker->sentence();

        $this->actingAs($this->user, 'api')
            ->json('PUT', route('api.chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->user->user_id,
            ]));

        $this->actingAs($this->user, 'api')
            ->json(
                'POST',
                route('api.chat.channels.messages.store', ['channel_id' => $this->publicChannel->channel_id]),
                ['message' => $message]
            )
            ->assertStatus(200)
            ->assertJsonFragment(['content' => $message]);
    }

    public function testChannelSendWhenModerated() // fail
    {
        $moderatedChannel = factory(Chat\Channel::class)->states('public')->create(['moderated' => true]);

        $this->actingAs($this->user, 'api')
            ->json(
                'POST',
                route('api.chat.channels.messages.store', ['channel_id' => $moderatedChannel->channel_id]),
                ['message' => self::$faker->sentence()]
            )
            ->assertStatus(403);
    }

    public function testChannelSendWhenBlocking() // fail
    {
        $pmChannel = factory(Chat\Channel::class)->states('pm')->create();
        factory(UserChannel::class)->create([
            'user_id' => $this->user->user_id,
            'channel_id' => $pmChannel->channel_id,
        ]);
        factory(UserChannel::class)->create([
            'user_id' => $this->anotherUser->user_id,
            'channel_id' => $pmChannel->channel_id,
        ]);
        factory(UserRelation::class)->states('block')->create([
            'user_id' => $this->user->user_id,
            'zebra_id' => $this->anotherUser->user_id,
        ]);

        $this->actingAs($this->user, 'api')
            ->json(
                'POST',
                route('api.chat.channels.messages.store', ['channel_id' => $pmChannel->channel_id]),
                ['message' => self::$faker->sentence()]
            )
            ->assertStatus(403);
    }

    public function testChannelSendWhenBlocked() // fail
    {
        $pmChannel = factory(Chat\Channel::class)->states('pm')->create();
        factory(UserChannel::class)->create([
            'user_id' => $this->user->user_id,
            'channel_id' => $pmChannel->channel_id,
        ]);
        factory(UserChannel::class)->create([
            'user_id' => $this->anotherUser->user_id,
            'channel_id' => $pmChannel->channel_id,
        ]);
        factory(UserRelation::class)->states('block')->create([
            'user_id' => $this->anotherUser->user_id,
            'zebra_id' => $this->user->user_id,
        ]);

        $this->actingAs($this->user, 'api')
            ->json(
                'POST',
                route('api.chat.channels.messages.store', ['channel_id' => $pmChannel->channel_id]),
                ['message' => self::$faker->sentence()]
            )
            ->assertStatus(403);
    }

    public function testChannelSendWhenRestrictedToPM() // fail
    {
        $pmChannel = factory(Chat\Channel::class)->states('pm')->create();

        factory(UserChannel::class)->create([
            'user_id' => $this->restrictedUser->user_id,
            'channel_id' => $pmChannel->channel_id,
        ]);
        factory(UserChannel::class)->create([
            'user_id' => $this->anotherUser->user_id,
            'channel_id' => $pmChannel->channel_id,
        ]);

        $this->actingAs($this->restrictedUser, 'api')
            ->json(
                'POST',
                route('api.chat.channels.messages.store', ['channel_id' => $pmChannel->channel_id]),
                ['message' => self::$faker->sentence()]
            )
            ->assertStatus(403);
    }

    public function testChannelSendWhenRestrictedToPublic() // fail
    {
        $this->actingAs($this->restrictedUser, 'api')
            ->json('PUT', route('api.chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->restrictedUser->user_id,
            ]));

        $this->actingAs($this->restrictedUser, 'api')
            ->json(
                'POST',
                route('api.chat.channels.messages.store', ['channel_id' => $this->publicChannel->channel_id]),
                ['message' => self::$faker->sentence()]
            )
            ->assertStatus(403);
    }

    public function testChannelSendWhenTargetRestricted() // fail
    {
        $pmChannel = factory(Chat\Channel::class)->states('pm')->create();

        factory(UserChannel::class)->create([
            'user_id' => $this->user->user_id,
            'channel_id' => $pmChannel->channel_id,
        ]);
        factory(UserChannel::class)->create([
            'user_id' => $this->restrictedUser->user_id,
            'channel_id' => $pmChannel->channel_id,
        ]);

        $this->actingAs($this->user, 'api')
            ->json(
                'POST',
                route('api.chat.channels.messages.store', ['channel_id' => $pmChannel->channel_id]),
                ['message' => self::$faker->sentence()]
            )
            ->assertStatus(404);
    }

    public function testChannelSendWhenSilencedToPM() // fail
    {
        $pmChannel = factory(Chat\Channel::class)->states('pm')->create();

        factory(UserChannel::class)->create([
            'user_id' => $this->silencedUser->user_id,
            'channel_id' => $pmChannel->channel_id,
        ]);
        factory(UserChannel::class)->create([
            'user_id' => $this->anotherUser->user_id,
            'channel_id' => $pmChannel->channel_id,
        ]);

        $this->actingAs($this->silencedUser, 'api')
            ->json(
                'POST',
                route('api.chat.channels.messages.store', ['channel_id' => $pmChannel->channel_id]),
                ['message' => self::$faker->sentence()]
            )
            ->assertStatus(403);
    }

    public function testChannelSendWhenSilencedToPublic() // fail
    {
        $this->actingAs($this->silencedUser, 'api')
            ->json('PUT', route('api.chat.channels.join', [
                'channel_id' => $this->publicChannel->channel_id,
                'user_id' => $this->silencedUser->user_id,
            ]));

        $this->actingAs($this->silencedUser, 'api')
            ->json(
                'POST',
                route('api.chat.channels.messages.store', ['channel_id' => $this->publicChannel->channel_id]),
                ['message' => self::$faker->sentence()]
            )
            ->assertStatus(403);
    }

    //endregion
}
