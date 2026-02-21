<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\InterOp\Chat;

use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\User;
use Tests\TestCase;

class ChannelsControllerTest extends TestCase
{
    public function testAddUser(): void
    {
        $channel = Channel::factory()->create();
        $user = User::factory()->create();

        $this->expectCountChange(fn () => $channel->userChannels()->count(), 1);

        $this->withInterOpHeader(
            route('interop.chat.channels.add-user', compact('channel', 'user')),
            fn ($url) => $this->put($url),
        )->assertSuccessful();

        $this->assertNotNull($channel->userChannels()->firstWhere(['user_id' => $user->getKey()]));
    }

    public function testClose(): void
    {
        $message = Message::factory()->create();
        $channel = $message->channel;
        $channel->addUser($message->sender);

        $this->expectCountChange(fn () => $channel->userChannels()->count(), -1);
        $this->expectCountChange(fn () => $channel->messages()->count(), 0);

        $this->withInterOpHeader(
            route('interop.chat.channels.close', compact('channel')),
            fn ($url) => $this->post($url),
        )->assertSuccessful();
    }

    public function testRemoveUser(): void
    {
        $channel = Channel::factory()->create();
        $user = User::factory()->create();
        $channel->addUser($user);

        $this->expectCountChange(fn () => $channel->userChannels()->count(), -1);

        $this->withInterOpHeader(
            route('interop.chat.channels.remove-user', compact('channel', 'user')),
            fn ($url) => $this->delete($url),
        )->assertSuccessful();

        $this->assertNull($channel->userChannels()->firstWhere(['user_id' => $user->getKey()]));
    }

    public function testStore(): void
    {
        $this->expectCountChange(fn () => Channel::count(), 1);

        $this->withInterOpHeader(
            route('interop.chat.channels.store'),
            fn ($url) => $this->post($url, [
                'type' => 'TEMPORARY',
                'name' => 'temp channel',
            ]),
        )->assertSuccessful();
    }
}
