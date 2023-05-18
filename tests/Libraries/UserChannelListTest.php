<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries;

use App\Libraries\Chat;
use App\Libraries\UserChannelList;
use App\Models\Chat\Channel;
use App\Models\User;
use App\Models\UserRelation;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserChannelListTest extends TestCase
{
    private User $target;
    private User $user;

    public function testChannelList()
    {
        $channel = Channel::factory()->type('public')->create();
        $channel->addUser($this->user);

        AssertableJson::fromArray((new UserChannelList($this->user))->get())
            ->where('0.channel_id', $channel->getKey());
    }

    public function testChannelHidden()
    {
        $message = Chat::sendPrivateMessage($this->user, $this->target, 'message', false);
        $channel = $message->channel;

        $channel->removeUser($this->user);
        $this->resetCache();

        // TODO: future update will make this not empty.
        $this->assertEmpty((new UserChannelList($this->user))->get());

        $channel->addUser($this->user);
        $this->resetCache();

        AssertableJson::fromArray((new UserChannelList($this->user))->get())
            ->whereContains('0.users', $this->target->getKey())
            ->where('0.channel_id', $channel->getKey());
    }

    public function testUserBlocked()
    {
        $message = Chat::sendPrivateMessage($this->user, $this->target, 'message', false);

        // block $this->target
        $block = UserRelation::factory()->block()->create([
            'user_id' => $this->user,
            'zebra_id' => $this->target,
        ]);
        $this->resetCache();

        $this->assertEmpty((new UserChannelList($this->user))->get());

        // unblock $this->target
        $block->delete();
        $this->resetCache();

        // ensure conversation with $this->target is visible again
        AssertableJson::fromArray((new UserChannelList($this->user))->get())
            ->whereContains('0.users', $this->target->getKey())
            ->where('0.channel_id', $message->channel->getKey());
    }

    public function testUserRestricted()
    {
        $message = Chat::sendPrivateMessage($this->user, $this->target, 'message', false);

        // restrict $this->target
        $this->target->update(['user_warnings' => 1]);
        $this->resetCache();

        $this->assertEmpty((new UserChannelList($this->user))->get());

        // unrestrict $this->target
        $this->target->update(['user_warnings' => 0]);
        $this->resetCache();

        // ensure conversation with $this->target is visible again
        AssertableJson::fromArray((new UserChannelList($this->user))->get())
            ->whereContains('0.users', $this->target->getKey())
            ->where('0.channel_id', $message->channel->getKey());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create()->markSessionVerified();
        $this->target = User::factory()->create();
    }

    private function resetCache(): void
    {
        $this->user->refresh();
        $this->target->refresh();
        app('OsuAuthorize')->resetCache();
    }
}
