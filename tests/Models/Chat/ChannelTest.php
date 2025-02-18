<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models\Chat;

use App\Events\ChatChannelEvent;
use App\Jobs\Notifications\ChannelAnnouncement;
use App\Libraries\User\AvatarHelper;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\Chat\UserChannel;
use App\Models\User;
use App\Models\UserRelation;
use Event;
use Illuminate\Filesystem\Filesystem;
use Queue;
use SplFileInfo;
use Storage;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    public function testAnnouncementSendMessage()
    {
        Queue::fake();

        $user = User::factory()->withGroup('announce')->create();
        $otherUser = User::factory()->create();
        $channel = Channel::factory()->type('announce', [$user, $otherUser])->create();

        $channel->receiveMessage($user, 'test');

        Queue::assertPushed(ChannelAnnouncement::class);
    }

    public function testAnnouncementSendToRestrictedUsers()
    {
        Queue::fake();

        $sender = User::factory()->withGroup('announce')->create();
        $user = User::factory()->create();
        $channel = Channel::factory()->type('announce', [$sender, $user])->create();

        $user->update(['user_warnings' => 1]);
        $channel = $channel->fresh();

        // ChatMessageEvent uses activeUserIds to broadcast.
        $this->assertContains($user->getKey(), $channel->activeUserIds());

        $channel->receiveMessage($sender, 'message');

        Queue::assertPushed(
            ChannelAnnouncement::class,
            fn (ChannelAnnouncement $job) => in_array($user->getKey(), $job->getReceiverIds(), true)
        );
    }

    public function testCreatePM()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $channel = Channel::createPM($user1, $user2);
        $channel->refresh();

        $users = $channel->users();
        $this->assertContains($user1, $users);
        $this->assertContains($user2, $users);
        $this->assertCount(2, $users);
    }

    /**
     * For testing the factory creates the channel in the expected form.
     */
    public function testCreatePMWithFactory()
    {
        $channel1 = Channel::factory()->type('pm')->create();
        $users = $channel1->users();

        // multiple PM channels can be created; existing channel check is handled by sendPrivateMessage;
        // createPM is typically not called directly.
        $channel2 = Channel::createPM(...$users);

        $this->assertCount(2, $users);
        $this->assertSame($channel2->name, $channel1->name);
        $this->assertEquals($channel2->users(), $users);
    }

    /**
     * @dataProvider channelWithBlockedUserVisibilityDataProvider
     */
    public function testChannelWithBlockedUserVisibility(?string $otherUserGroup, bool $expectVisible)
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->withGroup($otherUserGroup)->create();
        $channel = Channel::factory()->type('pm', [$user, $otherUser])->create();

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
    public function testChannelCanMessageModeratedPmChannel(?string $group, bool $canMessage)
    {
        $user = User::factory()->withGroup($group)->create();
        $otherUser = User::factory()->create();
        $channel = Channel::factory()->type('pm', [$user, $otherUser])->moderated()->create();

        $this->assertSame($canMessage, $channel->checkCanMessage($user)->can());
    }

    /**
     * @dataProvider channelCanMessageModeratedChannelDataProvider
     */
    public function testChannelCanMessageModeratedPublicChannel(?string $group, bool $canMessage)
    {
        $user = User::factory()->withGroup($group)->create();
        $channel = Channel::factory()->type('public', [$user])->moderated()->create();

        $this->assertSame($canMessage, $channel->checkCanMessage($user)->can());
    }

    /**
     * @dataProvider channelCanMessageWhenBlockedDataProvider
     */
    public function testChannelCanMessagePmChannelWhenBlocked(?string $group, bool $canMessage)
    {
        $user = User::factory()->withGroup($group)->create();
        $otherUser = User::factory()->create();
        $channel = Channel::factory()->type('pm', [$user, $otherUser])->create();

        UserRelation::create([
            'user_id' => $user->getKey(),
            'zebra_id' => $otherUser->getKey(),
            'foe' => true,
        ]);

        // reset caches from previous steps.
        $user->refresh();
        $otherUser->refresh();
        app('OsuAuthorize')->resetCache();

        // this assertion to make sure the correct block direction is being tested.
        $this->assertTrue($user->hasBlocked($otherUser));
        $this->assertSame($canMessage, $channel->checkCanMessage($user)->can());
    }

    /**
     * @dataProvider channelCanMessageWhenBlockedDataProvider
     */
    public function testChannelCanMessagePmChannelWhenBlocking(?string $group, bool $canMessage)
    {
        $user = User::factory()->withGroup($group)->create();
        $otherUser = User::factory()->create();
        $channel = Channel::factory()->type('pm', [$user, $otherUser])->create();

        UserRelation::create([
            'user_id' => $otherUser->getKey(),
            'zebra_id' => $user->getKey(),
            'foe' => true,
        ]);

        // reset caches from previous steps.
        $user->refresh();
        $otherUser->refresh();
        app('OsuAuthorize')->resetCache();

        // this assertion to make sure the correct block direction is being tested.
        $this->assertTrue($otherUser->hasBlocked($user));
        $this->assertSame($canMessage, $channel->checkCanMessage($user)->can());
    }

    /**
     * @dataProvider channelCanMessageWhenBlockedDataProvider
     */
    public function testChannelCanMessagePmChannelWhenFriendsOnly(?string $group, bool $canMessage)
    {
        $user = User::factory()->withGroup($group)->create();
        $otherUser = User::factory()->create(['pm_friends_only' => true]);
        $channel = Channel::factory()->type('pm', [$user, $otherUser])->create();

        app('OsuAuthorize')->resetCache();

        $this->assertSame($canMessage, $channel->checkCanMessage($user)->can());
    }

    public function testCreateAnnouncement()
    {
        Event::fake(ChatChannelEvent::class);

        $users = User::factory()->count(2)->create();

        $channel = Channel::createAnnouncement($users, ['description' => 'channel', 'name' => 'the best']);

        $channel = $channel->fresh();

        $this->assertEmpty($users->diff($channel->users()), 'created channel has too many users.');
        $this->assertEmpty($channel->users()->diff($users), 'created channel is missing users.');
        $this->assertSame(Channel::TYPES['announce'], $channel->type);

        Event::assertDispatched(fn (ChatChannelEvent $event) => $event->action === 'join', 2);
        Event::assertNotDispatched(fn (ChatChannelEvent $event) => $event->action !== 'join');
    }

    public function testDelete(): void
    {
        $message = Message::factory()->create();
        $message->channel->addUser($message->sender);

        $this->expectCountChange(fn () => Channel::count(), -1);
        $this->expectCountChange(fn () => UserChannel::count(), -1);
        $this->expectCountChange(fn () => Message::count(), -1);

        $message->channel->delete();
    }

    public function testGetPMChannelName()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $this->assertSame(
            Channel::getPMChannelName($user1, $user2),
            Channel::getPMChannelName($user2, $user1)
        );
    }

    /**
     * @dataProvider leaveChannelDataProvider
     */
    public function testLeaveChannel(string $type, bool $inChannel)
    {
        $users = User::factory()->count(2)->create();
        $user = $users[0];
        $channel = Channel::factory()->type($type, [...$users])->create();
        $channel->refresh();

        $channel->removeUser($user);
        $channel->refresh();

        if ($inChannel) {
            $this->assertContains($user->getKey(), $channel->userIds());
            $this->assertTrue($channel->hasUser($user));
        } else {
            $this->assertNotContains($user->getKey(), $channel->userIds());
            $this->assertFalse($channel->hasUser($user));
        }
    }

    public function testPmChannelIcon()
    {
        Storage::fake('local-avatar');
        $this->beforeApplicationDestroyed(function () {
            (new Filesystem())->deleteDirectory(storage_path('framework/testing/disks/local-avatar'));
        });

        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $testFile = new SplFileInfo(public_path('images/layout/avatar-guest.png'));
        AvatarHelper::set($user, $testFile);
        AvatarHelper::set($otherUser, $testFile);

        $channel = Channel::factory()->type('pm', [$user, $otherUser])->create();
        $this->assertSame($otherUser->user_avatar, $channel->displayIconFor($user));
        $this->assertSame($user->user_avatar, $channel->displayIconFor($otherUser));
    }

    public function testPmChannelName()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $channel = Channel::factory()->type('pm', [$user, $otherUser])->create();
        $this->assertSame($otherUser->username, $channel->displayNameFor($user));
        $this->assertSame($user->username, $channel->displayNameFor($otherUser));
    }

    public function testPublicChannelDoesNotShowUsers()
    {
        $user = User::factory()->create();
        $channel = Channel::factory()->type('public', [$user])->create();

        $this->assertSame(1, $channel->users()->count());
        $this->assertEmpty($channel->visibleUsers());
    }

    // test add/removeUser resets any memoized values
    public function testResetMemoized()
    {
        $user = User::factory()->create();
        $channel = Channel::factory()->create();

        $channel->addUser($user); // removeUser doesn't trigger resetMemoized if the user isn't in the channel.
        $memoized = $this->invokeProperty($channel, 'memoized');
        $this->assertEmpty($memoized); // addUser calls resetMemoized at the end so it should be empty.

        $this->invokeMethod($channel, 'userChannelFor', [$user]);
        $memoized = $this->invokeProperty($channel, 'memoized');
        $this->assertNotEmpty($memoized);

        $channel->removeUser($user);
        $memoized = $this->invokeProperty($channel, 'memoized');
        $this->assertEmpty($memoized);
    }

    public static function channelCanMessageModeratedChannelDataProvider()
    {
        return [
            [null, false],
            ['admin', true],
            ['bng', false],
            ['bot', false],
            ['gmt', true],
            ['nat', true],
        ];
    }

    public static function channelCanMessageWhenBlockedDataProvider()
    {
        return [
            [null, false],
            ['admin', true],
            ['bng', false],
            ['bot', true],
            ['gmt', true],
            ['nat', true],
        ];
    }

    public static function channelWithBlockedUserVisibilityDataProvider()
    {
        return [
            [null, false],
            ['admin', true],
            ['bng', false],
            ['bot', true],
            ['gmt', true],
            ['nat', true],
        ];
    }

    public static function leaveChannelDataProvider()
    {
        return [
            ['announce', true],
            ['pm', true],
            ['public', false],
        ];
    }
}
