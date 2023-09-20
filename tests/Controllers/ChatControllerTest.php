<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
use App\Models\User;
use Tests\TestCase;

class ChatControllerTest extends TestCase
{
    public function testRequestParamsChannelIdUnhide()
    {
        $sender = User::factory()->withGroup('announce')->create();
        $user = User::factory()->create();
        $channel = Channel::factory()->type('announce', [$sender, $user])->create();
        $fragment = ['channel_id' => $channel->getKey()];

        UserChannel::where($fragment)->update(['hidden' => true]);

        $this->actAsUser($user, true);
        $this
            ->get(route('chat.index', $fragment))
            ->assertSuccessful();

        app('OsuAuthorize')->resetCache();
        $channel->refresh();
        $this->assertFalse($this->invokeMethod($channel, 'userChannelFor', [$user])->isHidden());

        app('OsuAuthorize')->resetCache();
        $channel->refresh();
        $this->assertTrue($this->invokeMethod($channel, 'userChannelFor', [$sender])->isHidden());
    }

    public function testRequestParamsSendtoUnhide()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $channel = Channel::factory()->type('pm', [$user1, $user2])->create();
        $fragment = ['channel_id' => $channel->getKey()];

        UserChannel::where($fragment)->update(['hidden' => true]);

        $this->actAsUser($user1, true);
        $this
            ->get(route('chat.index', ['sendto' => $user2->getKey()]))
            ->assertSuccessful();

        app('OsuAuthorize')->resetCache();
        $channel->refresh();
        $this->assertFalse($this->invokeMethod($channel, 'userChannelFor', [$user1])->isHidden());

        app('OsuAuthorize')->resetCache();
        $channel->refresh();
        $this->assertTrue($this->invokeMethod($channel, 'userChannelFor', [$user2])->isHidden());
    }
}
