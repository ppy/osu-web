<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries;

use App\Events\NewPrivateNotificationEvent;
use App\Exceptions\AuthorizationException;
use App\Exceptions\InvariantException;
use App\Jobs\Notifications\BeatmapsetDiscussionPostNew;
use App\Jobs\Notifications\BeatmapsetDisqualify;
use App\Jobs\Notifications\BeatmapsetResetNominations;
use App\Libraries\BeatmapsetDiscussionReply;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;
use Event;
use Queue;
use Tests\TestCase;

class BeatmapsetDiscussionReplyTest extends TestCase
{
    private User $mapper;

    public function testWatchersGetNotification()
    {
        $user = User::factory()->create()->markSessionVerified();
        $watcher = User::factory()->create();
        $discussion = BeatmapDiscussion::factory()
            ->general()
            ->for($this->beatmapsetFactory())
            ->create(['user_id' => $this->mapper]);

        $discussion->beatmapset->watches()->create(['user_id' => $watcher->getKey()]);

        (new BeatmapsetDiscussionReply($user, $discussion, 'message'))->handle();

        Queue::assertPushed(BeatmapsetDiscussionPostNew::class, function (BeatmapsetDiscussionPostNew $job) use ($user, $watcher) {
            return in_array($watcher->getKey(), $job->getReceiverIds(), true)
                && !in_array($user->getKey(), $job->getReceiverIds(), true);
        });

        $this->runFakeQueue();

        // TODO: this should probably be changed to asserting "if job queued, then event is broadcast to receivers with option set"
        Event::assertDispatched(NewPrivateNotificationEvent::class, function (NewPrivateNotificationEvent $event) use ($user, $watcher) {
            return in_array($watcher->getKey(), $event->getReceiverIds(), true)
                && !in_array($user->getKey(), $event->getReceiverIds(), true);
        });
    }

    /**
     * @dataProvider replyQueuesNotificationDataProviderToStarter
     */
    public function testReplyQueuesNotificationToStarter(string $messageType, bool $includeStarter)
    {
        $user = User::factory()->create()->markSessionVerified();
        $starter = User::factory()->create();

        $discussion = BeatmapDiscussion::factory()->general()->create([
            'beatmapset_id' => $this->beatmapsetFactory(),
            'message_type' => $messageType,
            'user_id' => $starter,
        ]);

        (new BeatmapsetDiscussionReply($user, $discussion, 'message'))->handle();

        Queue::assertPushed(
            BeatmapsetDiscussionPostNew::class,
            function (BeatmapsetDiscussionPostNew $job) use ($includeStarter, $starter) {
                return $includeStarter
                    ? in_array($starter->getKey(), $job->getReceiverIds(), true)
                    : !in_array($starter->getKey(), $job->getReceiverIds(), true);
            }
        );
    }

    /**
     * @dataProvider userGroupsDataProvider
     */
    public function testReplyResolvedDiscussion(?string $group)
    {
        $user = User::factory()->withGroup($group)->create()->markSessionVerified();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->create([
            'beatmapset_id' => $this->beatmapsetFactory(),
            'resolved' => true,
            'user_id' => User::factory(),
        ]);

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), 1);

        (new BeatmapsetDiscussionReply($user, $discussion, 'message'))->handle();

        Queue::assertPushed(BeatmapsetDiscussionPostNew::class);

        $this->assertTrue($discussion->fresh()->resolved);
    }

    /**
     * @dataProvider userGroupsDataProvider
     */
    public function testReplyUnresolvedDiscussion(?string $group)
    {
        $user = User::factory()->withGroup($group)->create()->markSessionVerified();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->create([
            'beatmapset_id' => $this->beatmapsetFactory(),
            'resolved' => false,
            'user_id' => User::factory(),
        ]);

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), 1);

        (new BeatmapsetDiscussionReply($user, $discussion, 'message'))->handle();

        Queue::assertPushed(BeatmapsetDiscussionPostNew::class);

        $this->assertFalse($discussion->fresh()->resolved);
    }

    /**
     * @dataProvider resolveDiscussionByStarterDataProvider
     */
    public function testResolveDiscussionByStarter(string $messageType, bool $expected)
    {
        $user = User::factory()->create()->markSessionVerified();
        $discussion = BeatmapDiscussion::factory()->general()->create([
            'beatmapset_id' => $this->beatmapsetFactory(),
            'message_type' => $messageType,
            'user_id' => $user,
        ]);

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), $expected ? 2 : 0);
        if (!$expected) {
            $this->expectException(InvariantException::class);
        }

        $posts = (new BeatmapsetDiscussionReply($user, $discussion, 'message', true))->handle();

        Queue::assertPushed(BeatmapsetDiscussionPostNew::class);

        $this->assertSame($expected, $discussion->fresh()->resolved);
        $this->assertCount(1, $this->getSystemPosts($posts, $discussion));
    }

    /**
     * @dataProvider resolveDiscussionByMapperDataProvider
     */
    public function testResolveDiscussionByMapper(string $state, bool $expected)
    {
        $starter = User::factory()->create();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->create([
            'beatmapset_id' => $this->beatmapsetFactory()->$state(),
            'user_id' => $starter,
        ]);

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), $expected ? 2 : 0);
        if (!$expected) {
            $this->expectException(AuthorizationException::class);
        }

        $posts = (new BeatmapsetDiscussionReply($this->mapper, $discussion, 'message', true))->handle();

        Queue::assertPushed(BeatmapsetDiscussionPostNew::class);

        $this->assertSame($expected, $discussion->fresh()->resolved);
        $this->assertCount(1, $this->getSystemPosts($posts, $discussion));
    }

    /**
     * @dataProvider resolveDiscussionByMapperDataProvider
     */
    public function testResolveDiscussionByGuestMapper(string $state, bool $expected)
    {
        $user = User::factory()->create()->markSessionVerified();
        $beatmapset = $this->beatmapsetFactory()->$state()->create(['user_id' => $user]);
        $beatmap = $beatmapset->beatmaps->first();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->create([
            'beatmap_id' => $beatmap,
            'beatmapset_id' => $beatmapset,
            'user_id' => User::factory(),
        ]);

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), $expected ? 2 : 0);
        if (!$expected) {
            $this->expectException(AuthorizationException::class);
        }

        $posts = (new BeatmapsetDiscussionReply($user, $discussion, 'message', true))->handle();

        Queue::assertPushed(BeatmapsetDiscussionPostNew::class);

        $this->assertSame($expected, $discussion->fresh()->resolved);
        $this->assertCount(1, $this->getSystemPosts($posts, $discussion));
    }

    /**
     * @dataProvider resolveDiscussionByOtherUsersDataProvider
     */
    public function testResolveDiscussionByOtherUsers(?string $group, bool $expected)
    {
        $user = User::factory()->withGroup($group)->create()->markSessionVerified();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->create([
            'beatmapset_id' => $this->beatmapsetFactory(),
            'user_id' => User::factory(),
        ]);

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), $expected ? 2 : 0);
        if (!$expected) {
            $this->expectException(AuthorizationException::class);
        }

        $posts = (new BeatmapsetDiscussionReply($user, $discussion, 'message', true))->handle();

        Queue::assertPushed(BeatmapsetDiscussionPostNew::class);

        $this->assertSame($expected, $discussion->fresh()->resolved);
        $this->assertCount(1, $this->getSystemPosts($posts, $discussion));
    }

    /**
     * @dataProvider reopeningProblemDoesNotDisqualifyOrResetNominationsDataProvider
     */
    public function testReopeningProblemDoesNotDisqualifyOrResetNominations(?string $group, string $state)
    {
        $user = User::factory()->withGroup($group)->create()->markSessionVerified();

        $beatmapset = $this->beatmapsetFactory()
            ->withNominations()
            ->$state()
            ->create();

        $discussion = BeatmapDiscussion::factory()->general()->problem()->create([
            'beatmapset_id' => $beatmapset,
            'resolved' => true,
            'user_id' => User::factory(),
        ]);


        (new BeatmapsetDiscussionReply($user, $discussion, 'message', false))->handle();

        Queue::assertPushed(BeatmapsetDiscussionPostNew::class);
        Queue::assertNotPushed(BeatmapsetDisqualify::class);
        Queue::assertNotPushed(BeatmapsetResetNominations::class);

        $this->assertFalse($discussion->fresh()->resolved);
        $this->assertSame($state, $beatmapset->fresh()->status());
    }

    public function testReopenResolvedDiscussionByMapper()
    {
        $beatmapset = $this->beatmapsetFactory()->qualified()->create();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->create([
            'beatmapset_id' => $beatmapset,
            'resolved' => true,
            'user_id' => $this->mapper,
        ]);

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), 2);

        $posts = (new BeatmapsetDiscussionReply($this->mapper, $discussion, 'message', false))->handle();

        Queue::assertPushed(BeatmapsetDiscussionPostNew::class);

        $this->assertFalse($discussion->fresh()->resolved);
        $this->assertTrue($beatmapset->fresh()->isQualified());
        $this->assertCount(1, $this->getSystemPosts($posts, $discussion));
    }

    public function testReopenResolvedDiscussionByStarter()
    {
        $user = User::factory()->create()->markSessionVerified();
        $beatmapset = $this->beatmapsetFactory()->qualified()->create();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->create([
            'beatmapset_id' => $beatmapset,
            'resolved' => true,
            'user_id' => $user,
        ]);

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), 2);

        $posts = (new BeatmapsetDiscussionReply($user, $discussion, 'message', false))->handle();

        Queue::assertPushed(BeatmapsetDiscussionPostNew::class);

        $this->assertFalse($discussion->fresh()->resolved);
        $this->assertTrue($beatmapset->fresh()->isQualified());
        $this->assertCount(1, $this->getSystemPosts($posts, $discussion));
    }

    /**
     * @dataProvider userGroupsDataProvider
     */
    public function testReplyToMapperNoteByOtherUsers(?string $group)
    {
        $user = User::factory()->withGroup($group)->create()->markSessionVerified();

        $discussion = BeatmapDiscussion::factory()->general()->mapperNote()->create([
            'beatmapset_id' => $this->beatmapsetFactory(),
            'user_id' => $this->mapper,
        ]);

        $this->expectCountChange(fn () => BeatmapDiscussion::count(), 0, BeatmapDiscussion::class);
        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), 1, BeatmapDiscussionPost::class);

        (new BeatmapsetDiscussionReply($user, $discussion, 'message'))->handle();

        Queue::assertPushed(BeatmapsetDiscussionPostNew::class);
    }

    public function reopeningProblemDoesNotDisqualifyOrResetNominationsDataProvider()
    {
        return [
            ['bng', 'pending'],
            ['bng', 'qualified'],
            ['bng_limited', 'pending'],
            ['bng_limited', 'qualified'],
            [null, 'pending'],
            [null, 'qualified'],
        ];
    }

    public function replyQueuesNotificationDataProviderToStarter()
    {
        return [
            ['praise', false],
            ['problem', true],
            ['suggestion', true],
        ];
    }

    public function resolveDiscussionByStarterDataProvider()
    {
        return [
            ['praise', false],
            ['problem', true],
            ['suggestion', true],
        ];
    }

    public function resolveDiscussionByMapperDataProvider()
    {
        return [
            ['pending', true],
            ['qualified', false],
        ];
    }

    public function resolveDiscussionByOtherUsersDataProvider()
    {
        return [
            ['bng', false],
            ['bng_limited', false],
            ['gmt', true],
            ['nat', true],
            [null, false],
        ];
    }

    public function userGroupsDataProvider()
    {
        return [
            ['admin'],
            ['bng'],
            ['bng_limited'],
            ['gmt'],
            ['nat'],
            [null],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();

        config()->set('osu.beatmapset.required_nominations', 1);

        $this->mapper = User::factory()->create()->markSessionVerified();
    }

    private function beatmapsetFactory(array $beatmapState = [])
    {
        $factory = Beatmapset::factory()
            ->owner($this->mapper)
            ->has(Beatmap::factory()->state(array_merge([
                'user_id' => $this->mapper,
            ], $beatmapState)));

        return $factory;
    }

    private function getSystemPosts(array $posts, BeatmapDiscussion $discussion)
    {
        return array_filter(
            $posts,
            fn (BeatmapDiscussionPost $post) => $post->system && $post->beatmap_discussion_id === $discussion->getKey()
        );
    }
}
