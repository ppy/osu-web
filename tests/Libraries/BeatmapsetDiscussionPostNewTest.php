<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries;

use App\Events\NewPrivateNotificationEvent;
use App\Exceptions\AuthorizationException;
use App\Exceptions\InvariantException;
use App\Exceptions\VerificationRequiredException;
use App\Jobs\Notifications\BeatmapsetDiscussionPostNew as NotificationsBeatmapsetDiscussionPostNew;
use App\Jobs\Notifications\BeatmapsetDiscussionQualifiedProblem;
use App\Jobs\Notifications\BeatmapsetDisqualify;
use App\Jobs\Notifications\BeatmapsetResetNominations;
use App\Libraries\BeatmapsetDiscussionPostNew;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Event;
use Queue;
use Tests\TestCase;

class BeatmapsetDiscussionPostNewTest extends TestCase
{
    private User $mapper;

    /**
     * @dataProvider minPlaysVerificationDataProvider
     */
    public function testMinPlaysVerification(?int $minPlays, bool $verified, bool $success)
    {
        config()->set('osu.user.post_action_verification', false);

        $user = User::factory()->withPlays($minPlays)->create();
        $beatmapset = $this->beatmapsetFactory()->create();
        $beatmapset->watches()->create(['user_id' => User::factory()->create()->getKey()]);

        $change = $success ? 1 : 0;
        $this->expectCountChange(fn () => BeatmapDiscussion::count(), $change, BeatmapDiscussion::class);
        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), $change, BeatmapDiscussionPost::class);
        $this->expectCountChange(fn () => Notification::count(), $change, Notification::class);
        $this->expectCountChange(fn () => UserNotification::count(), $change, UserNotification::class);

        $discussion = new BeatmapDiscussion(['message_type' => 'praise']);
        $discussion->beatmapset()->associate($beatmapset);
        $discussion->user()->associate($user);

        if ($verified) {
            $user->markSessionVerified();
        }

        if (!$success) {
            $this->expectException(VerificationRequiredException::class);
        }

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message'))->handle();
    }

    /**
     * See testReopeningProblemDoesNotDisqualifyOrResetNominations for assertions
     * jobs are not queued when reopening a resolved discussion.
     *
     * @dataProvider newDiscussionQueuesJobsDataProvider
     */
    public function testNewDiscussionQueuesJobs(string $state, ?string $group, array $queued, array $notQueued)
    {
        $user = User::factory()->withGroup($group)->create()->markSessionVerified();

        $beatmapset = $this->beatmapsetFactory()
            ->withNominations()
            ->$state()
            ->create();

        $discussion = BeatmapDiscussion::factory()->general()->problem()->make([
            'beatmapset_id' => $beatmapset,
            'user_id' => $user,
        ]);

        Queue::fake();

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message'))->handle();

        foreach ($queued as $class) {
            Queue::assertPushed($class);
        }

        foreach ($notQueued as $class) {
            Queue::assertNotPushed($class);
        }
    }

    /**
     * @dataProvider shouldDisqualifyOrResetNominationsDataProvider
     */
    public function testShouldDisqualifyOrResetNominations(string $state, ?string $group, string $messageType, bool $existing, bool $expects)
    {
        $user = User::factory()->withGroup($group)->create()->markSessionVerified();

        $beatmapset = $this->beatmapsetFactory()
            ->withNominations()
            ->$state()
            ->create();

        $discussion = BeatmapDiscussion::factory()->general()->state([
            'beatmapset_id' => $beatmapset,
            'message_type' => $messageType,
            'user_id' => $user,
        ]);

        $discussion = $existing ? $discussion->create() : $discussion->make();

        $subject = new BeatmapsetDiscussionPostNew($user, $discussion, 'message');

        $value = $this->invokeMethod($subject, 'shouldDisqualifyOrResetNominations');
        $this->assertSame($expects, $value);
    }

    public function testWatchersGetNotification()
    {
        $user = User::factory()->create()->markSessionVerified();
        $watcher = User::factory()->create();
        $beatmapset = $this->beatmapsetFactory()->create();
        $beatmapset->watches()->create(['user_id' => $watcher->getKey()]);

        $discussion = BeatmapDiscussion::factory()->general()->state([
            'beatmapset_id' => $beatmapset,
            'message_type' => 'praise',
            'user_id' => $user,
        ])->make();

        Queue::fake();

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message'))->handle();

        Queue::assertPushed(NotificationsBeatmapsetDiscussionPostNew::class, function (NotificationsBeatmapsetDiscussionPostNew $job) use ($user, $watcher) {
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

    //region Reporting problem on a beatmap

    /**
     * @dataProvider problemOnQualifiedBeatmapsetDataProvider
     */
    public function testProblemOnQualifiedBeatmapset(string $state, string $assertMethod)
    {
        $user = User::factory()->create()->markSessionVerified();

        $beatmapset = $this->beatmapsetFactory()
            ->$state()
            ->create();

        User::factory()->create()->notificationOptions()->create([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
            'details' => ['modes' => array_keys(Beatmap::MODES)],
        ]);

        $discussion = BeatmapDiscussion::factory()->general()->problem()->make([
            'beatmapset_id' => $beatmapset,
            'user_id' => $user,
        ]);

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message'))->handle();

        $assertMethod(NewPrivateNotificationEvent::class);
    }

    public function testSecondProblemOnQualifiedBeatmapset()
    {
        // TODO: add test for priorOpenProblemCount?

        $user = User::factory()->create()->markSessionVerified();

        $beatmapset = $this->beatmapsetFactory()
            ->qualified()
            ->has(BeatmapDiscussion::factory()->general()->problem()->state([
                'user_id' => $this->mapper,
            ]))
            ->create();

        User::factory()->create()->notificationOptions()->create([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
            'details' => ['modes' => array_keys(Beatmap::MODES)],
        ]);

        $discussion = BeatmapDiscussion::factory()->general()->problem()->make([
            'beatmapset_id' => $beatmapset,
            'user_id' => $user,
        ]);

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message'))->handle();

        Event::assertNotDispatched(NewPrivateNotificationEvent::class);
    }

    /**
     * @dataProvider problemOnQualifiedBeatmapsetModesNotificationDataProvider
     *
     * @return void
     */
    public function testProblemOnQualifiedBeatmapsetModesNotification(string $mode, array $notificationModes, bool $expectsNotification)
    {
        $user = User::factory()->create()->markSessionVerified();

        $beatmapset = $this->beatmapsetFactory(['playmode' => Beatmap::MODES[$mode]])
            ->qualified()
            ->create();

        $watcher = User::factory()->create();
        $watcher->notificationOptions()->create([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
            'details' => ['modes' => $notificationModes],
        ]);

        $discussion = BeatmapDiscussion::factory()->general()->problem()->make([
            'beatmapset_id' => $beatmapset,
            'user_id' => $user,
        ]);

        // TODO: only test the handleProblemDiscussion() part?
        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message'))->handle();

        if ($expectsNotification) {
            Event::assertDispatched(NewPrivateNotificationEvent::class, function (NewPrivateNotificationEvent $event) use ($watcher) {
                return in_array($watcher->getKey(), $event->getReceiverIds(), true);
            });
        } else {
            Event::assertNotDispatched(NewPrivateNotificationEvent::class);
        }
    }

    //endregion

    //region Replying to an exisitng discussion

    /**
     * @dataProvider replyQueuesNotificationDataProviderToStarter
     */
    public function testReplyQueuesNotificationToStarter(string $messageType, bool $includeStarter)
    {
        $user = User::factory()->create()->markSessionVerified();
        $starter = User::factory()->create();
        $beatmapset = $this->beatmapsetFactory()->create();

        $discussion = BeatmapDiscussion::factory()->general()->state([
            'beatmapset_id' => $beatmapset,
            'message_type' => $messageType,
            'user_id' => $starter,
        ])->create();

        Queue::fake();

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message'))->handle();

        Queue::assertPushed(
            NotificationsBeatmapsetDiscussionPostNew::class,
            function (NotificationsBeatmapsetDiscussionPostNew $job) use ($includeStarter, $starter) {
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
        $beatmapset = $this->beatmapsetFactory()->qualified()->create();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->state([
            'beatmapset_id' => $beatmapset,
            'resolved' => true,
            'user_id' => User::factory(),
        ])->create();

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), 1);

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message'))->handle();

        $this->assertTrue($discussion->fresh()->resolved);
    }

    /**
     * @dataProvider userGroupsDataProvider
     */
    public function testReplyUnresolvedDiscussion(?string $group)
    {
        $user = User::factory()->withGroup($group)->create()->markSessionVerified();
        $beatmapset = $this->beatmapsetFactory()->qualified()->create();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->state([
            'beatmapset_id' => $beatmapset,
            'resolved' => false,
            'user_id' => User::factory(),
        ])->create();

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), 1);

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message'))->handle();

        $this->assertFalse($discussion->fresh()->resolved);
    }

    //endregion

    //region Resolving discussions

    /**
     * @dataProvider resolveDiscussionByStarterDataProvider
     */
    public function testResolveDiscussionByStarter(string $messageType, bool $expected)
    {
        $user = User::factory()->create()->markSessionVerified();
        $beatmapset = $this->beatmapsetFactory()->create();
        $discussion = BeatmapDiscussion::factory()->general()->state([
            'beatmapset_id' => $beatmapset,
            'message_type' => $messageType,
            'user_id' => $user,
        ])->create();

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), $expected ? 2 : 0);
        if (!$expected) {
            $this->expectException(InvariantException::class);
        }

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message', true))->handle();

        $this->assertSame($expected, $discussion->fresh()->resolved);
    }

    /**
     * @dataProvider resolveDiscussionByMapperDataProvider
     */
    public function testResolveDiscussionByMapper(string $state, bool $expected)
    {
        $starter = User::factory()->create();
        $beatmapset = $this->beatmapsetFactory()->$state()->create();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->state([
            'beatmapset_id' => $beatmapset,
            'user_id' => $starter,
        ])->create();

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), $expected ? 2 : 0);
        if (!$expected) {
            $this->expectException(AuthorizationException::class);
        }

        (new BeatmapsetDiscussionPostNew($this->mapper, $discussion, 'message', true))->handle();

        $this->assertSame($expected, $discussion->fresh()->resolved);
    }

    /**
     * @dataProvider resolveDiscussionByMapperDataProvider
     */
    public function testResolveDiscussionByGuestMapper(string $state, bool $expected)
    {
        $user = User::factory()->create()->markSessionVerified();
        $beatmapset = $this->beatmapsetFactory()->$state()->create(['user_id' => $user]);
        $beatmap = $beatmapset->beatmaps->first();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->state([
            'beatmap_id' => $beatmap,
            'beatmapset_id' => $beatmapset,
            'user_id' => User::factory(),
        ])->create();

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), $expected ? 2 : 0);
        if (!$expected) {
            $this->expectException(AuthorizationException::class);
        }

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message', true))->handle();

        $this->assertSame($expected, $discussion->fresh()->resolved);
    }

    /**
     * @dataProvider resolveDiscussionByOtherUsersDataProvider
     */
    public function testResolveDiscussionByOtherUsers(?string $group, bool $expected)
    {
        $user = User::factory()->withGroup($group)->create()->markSessionVerified();
        $beatmapset = $this->beatmapsetFactory()->create();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->state([
            'beatmapset_id' => $beatmapset,
            'user_id' => User::factory(),
        ])->create();

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), $expected ? 2 : 0);
        if (!$expected) {
            $this->expectException(AuthorizationException::class);
        }

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message', true))->handle();

        $this->assertSame($expected, $discussion->fresh()->resolved);
    }

    //endregion

    //region Reopening a resolved issue

    /**
     * This test also includes reopening by other users; see testNewDiscussionQueuesJobs for new discussions
     *
     * @dataProvider reopeningProblemDoesNotDisqualifyOrResetNominationsDataProvider
     */
    public function testReopeningProblemDoesNotDisqualifyOrResetNominations(?string $group, string $state)
    {
        $user = User::factory()->withGroup(null)->create()->markSessionVerified();

        $beatmapset = $this->beatmapsetFactory()
            ->withNominations()
            ->$state()
            ->create();

        $discussion = BeatmapDiscussion::factory()->general()->problem()->state([
            'beatmapset_id' => $beatmapset,
            'resolved' => true,
            'user_id' => User::factory(),
        ])->create();

        Queue::fake();

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message', false))->handle();

        Queue::assertPushed(NotificationsBeatmapsetDiscussionPostNew::class);
        Queue::assertNotPushed(BeatmapsetDisqualify::class);
        Queue::assertNotPushed(BeatmapsetResetNominations::class);

        $discussion->refresh();

        $this->assertFalse($discussion->resolved);
        $this->assertSame($state, $beatmapset->status());
    }

    public function testReopenResolvedDiscussionByMapper()
    {
        $beatmapset = $this->beatmapsetFactory()->qualified()->create();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->state([
            'beatmapset_id' => $beatmapset,
            'resolved' => true,
            'user_id' => $this->mapper,
        ])->create();

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), 2);

        (new BeatmapsetDiscussionPostNew($this->mapper, $discussion, 'message', false))->handle();

        $this->assertFalse($discussion->fresh()->resolved);
        $this->assertTrue($beatmapset->isQualified());
    }

    public function testReopenResolvedDiscussionByStarter()
    {
        $user = User::factory()->create()->markSessionVerified();
        $beatmapset = $this->beatmapsetFactory()->qualified()->create();
        $discussion = BeatmapDiscussion::factory()->general()->problem()->state([
            'beatmapset_id' => $beatmapset,
            'resolved' => true,
            'user_id' => $user,
        ])->create();

        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), 2);

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message', false))->handle();

        $this->assertFalse($discussion->fresh()->resolved);
        $this->assertTrue($beatmapset->isQualified());
    }

    //endregion

    public function minPlaysVerificationDataProvider()
    {
        return [
            [config('osu.user.min_plays_for_posting') - 1, false, false],
            [config('osu.user.min_plays_for_posting') - 1, true, true],
            [null, false, true],
            [null, true, true],
        ];
    }

    public function problemOnQualifiedBeatmapsetDataProvider()
    {
        return [
            ['pending', 'Event::assertNotDispatched'],
            ['qualified', 'Event::assertDispatched'],
        ];
    }

    public function problemOnQualifiedBeatmapsetModesNotificationDataProvider()
    {
        return [
            'with matching notification mode' => ['osu', ['osu'], true],
            'wihtout matching notification mode' => ['osu', ['taiko'], false],
        ];
    }

    public function newDiscussionQueuesJobsDataProvider()
    {
        return [
            [
                'qualified',
                'bng',
                [BeatmapsetDisqualify::class, NotificationsBeatmapsetDiscussionPostNew::class],
                [BeatmapsetDiscussionQualifiedProblem::class, BeatmapsetResetNominations::class],
            ],
            [
                'qualified',
                'bng_limited',
                [NotificationsBeatmapsetDiscussionPostNew::class, BeatmapsetDiscussionQualifiedProblem::class],
                [BeatmapsetDisqualify::class, BeatmapsetResetNominations::class],
            ],
            [
                'qualified',
                null,
                [NotificationsBeatmapsetDiscussionPostNew::class, BeatmapsetDiscussionQualifiedProblem::class],
                [BeatmapsetDisqualify::class, BeatmapsetResetNominations::class],
            ],
            [
                'pending',
                'bng',
                [BeatmapsetResetNominations::class, NotificationsBeatmapsetDiscussionPostNew::class],
                [BeatmapsetDiscussionQualifiedProblem::class, BeatmapsetDisqualify::class],
            ],
            [
                'pending',
                'bng_limited',
                [BeatmapsetResetNominations::class, NotificationsBeatmapsetDiscussionPostNew::class],
                [BeatmapsetDiscussionQualifiedProblem::class, BeatmapsetDisqualify::class],
            ],
            [
                'pending',
                null,
                [NotificationsBeatmapsetDiscussionPostNew::class],
                [BeatmapsetDiscussionQualifiedProblem::class, BeatmapsetDisqualify::class, BeatmapsetResetNominations::class],
            ],
        ];
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

    public function shouldDisqualifyOrResetNominationsDataProvider()
    {
        return [
            ['pending', 'bng', 'problem', true, false],
            ['pending', 'bng', 'problem', false, true],
            ['pending', 'bng', 'suggestion', true, false],
            ['pending', 'bng', 'suggestion', false, false],
            ['pending', 'bng_limited', 'problem', true, false],
            ['pending', 'bng_limited', 'problem', false, true],
            ['pending', 'bng_limited', 'suggestion', true, false],
            ['pending', 'bng_limited', 'suggestion', false, false],
            ['pending', null, 'problem', true, false],
            ['pending', null, 'problem', false, false],
            ['pending', null, 'suggestion', true, false],
            ['pending', null, 'suggestion', false, false],

            // similar to pending except bng_limited cannot disqualify
            ['qualified', 'bng', 'problem', true, false],
            ['qualified', 'bng', 'problem', false, true],
            ['qualified', 'bng', 'suggestion', true, false],
            ['qualified', 'bng', 'suggestion', false, false],
            ['qualified', 'bng_limited', 'problem', true, false],
            ['qualified', 'bng_limited', 'problem', false, false], // cannot disqualify
            ['qualified', 'bng_limited', 'suggestion', true, false],
            ['qualified', 'bng_limited', 'suggestion', false, false],
            ['qualified', null, 'problem', true, false],
            ['qualified', null, 'problem', false, false],
            ['qualified', null, 'suggestion', true, false],
            ['qualified', null, 'suggestion', false, false],
        ];
    }

    public function userGroupsDataProvider()
    {
        return [
            ['admin'],
            ['bng'],
            ['gmt'],
            ['nat'],
            [null],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

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
}
