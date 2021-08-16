<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Models\Chat\Channel;
use App\Models\User;
use App\Models\UserRelation;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    public function testPublicChannelDoesNotShowUsers()
    {
        $channel = factory(Channel::class)->states('public')->create();
        $user = factory(User::class)->create();

        $channel->addUser($user);
        $this->assertSame(1, $channel->users()->count());
        $this->assertEmpty($channel->visibleUsers());
    }

    /**
     * @dataProvider channelWithBlockedUserVisibilityDataProvider
     */
    public function testChannelWithBlockedUserVisibility(array|string $otherUserGroup, $expectVisible)
    {
        $channel = factory(Channel::class)->states('pm')->create();
        $user = factory(User::class)->create();
        $otherUser = $this->createUserWithGroup($otherUserGroup);

        $channel->addUser($user);
        $channel->addUser($otherUser);

        UserRelation::create([
            'user_id' => $user->getKey(),
            'zebra_id' => $otherUser->getKey(),
            'foe' => true,
        ]);

        $this->assertSame($expectVisible, $channel->isVisibleFor($user));
    }

    /**
     * @dataProvider channelCanMessageModeratedChannelDataProvider
     */
    public function testChannelCanMessageModeratedPmChannel($group, $canMessage)
    {
        $channel = factory(Channel::class)->states('moderated', 'pm')->create();
        $user = factory(User::class)->states($group)->create();
        $otherUser = factory(User::class)->create();

        $channel->addUser($user);
        $channel->addUser($otherUser);

        $this->assertSame($canMessage, $channel->canMessage($user));
    }

    /**
     * @dataProvider channelCanMessageModeratedChannelDataProvider
     */
    public function testChannelCanMessageModeratedPublicChannel($group, $canMessage)
    {
        $channel = factory(Channel::class)->states('moderated', 'public')->create();
        $user = factory(User::class)->states($group)->create();

        $channel->addUser($user);

        $this->assertSame($canMessage, $channel->canMessage($user));
    }

    /**
     * @dataProvider channelCanMessageModeratedChannelDataProvider
     */
    public function testChannelCanMessagePmChannelWhenBlocked($group, $canMessage)
    {
        $channel = factory(Channel::class)->states('pm')->create();
        $user = factory(User::class)->states($group)->create();
        $otherUser = factory(User::class)->create();

        $channel->addUser($user);
        $channel->addUser($otherUser);

        UserRelation::create([
            'user_id' => $user->getKey(),
            'zebra_id' => $otherUser->getKey(),
            'foe' => true,
        ]);

        $this->assertSame($canMessage, $channel->canMessage($user));
    }

    public function channelCanMessageModeratedChannelDataProvider()
    {
        return [
            [[], false],
            ['admin', true],
            ['bng', false],
            ['gmt', true],
            ['nat', true],
        ];
    }

    public function channelWithBlockedUserVisibilityDataProvider()
    {
        return [
            [[], false],
            ['admin', true],
            ['bng', false],
            ['gmt', true],
            ['nat', true],
        ];
    }
}
