<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries;

use App\Events\NewPrivateNotificationEvent;
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
    private Beatmap $beatmap;
    private Beatmapset $beatmapset;
    private User $mapper;

    /**
     * @dataProvider minPlaysVerificationDataProvider
     */
    public function testMinPlaysVerification(?int $minPlays, bool $verified, bool $success)
    {
        config()->set('osu.user.post_action_verification', false);

        $user = User::factory()->withPlays($minPlays)->create();
        $this->beatmapset->watches()->create(['user_id' => User::factory()->create()->getKey()]);

        $change = $success ? 1 : 0;
        $this->expectCountChange(fn () => BeatmapDiscussion::count(), $change, BeatmapDiscussion::class);
        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), $change, BeatmapDiscussionPost::class);
        $this->expectCountChange(fn () => Notification::count(), $change, Notification::class);
        $this->expectCountChange(fn () => UserNotification::count(), $change, UserNotification::class);

        $discussion = new BeatmapDiscussion(['message_type' => 'praise']);
        $discussion->beatmapset()->associate($this->beatmapset);
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
     * @dataProvider problemOnQualifiedBeatmapsetDataProvider
     */
    public function testProblemOnQualifiedBeatmapset(string $state, string $assertMethod)
    {
        $beatmapset = Beatmapset::factory()
            ->owner($this->mapper)
            ->$state()
            ->has(Beatmap::factory()->state([
                'user_id' => $this->mapper,
            ]))
            ->create();

        User::factory()->create()->notificationOptions()->create([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
            'details' => ['modes' => array_keys(Beatmap::MODES)],
        ]);

        $discussion = $beatmapset->beatmapDiscussions()->make([
            'message_type' => 'problem',
            'user_id' => $this->poster->getKey(),
        ]);

        (new BeatmapsetDiscussionPostNew($this->poster, $discussion, 'message'))->handle();

        $assertMethod(NewPrivateNotificationEvent::class);
    }

    public function testSecondProblemOnQualifiedBeatmapset()
    {
        // TODO: add test for priorOpenProblemCount?

        $beatmapset = Beatmapset::factory()
            ->owner($this->mapper)
            ->qualified()
            ->has(Beatmap::factory()->state([
                'user_id' => $this->mapper,
            ]))
            ->has(BeatmapDiscussion::factory()->general()->problem()->state([
                'user_id' => $this->mapper,
            ]))
            ->create();

        User::factory()->create()->notificationOptions()->create([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
            'details' => ['modes' => array_keys(Beatmap::MODES)],
        ]);

        $discussion = $beatmapset->beatmapDiscussions()->make([
            'message_type' => 'problem',
            'user_id' => $this->poster->getKey(),
        ]);

        (new BeatmapsetDiscussionPostNew($this->poster, $discussion, 'message'))->handle();

        Event::assertNotDispatched(NewPrivateNotificationEvent::class);
    }

    /**
     * @dataProvider problemOnQualifiedBeatmapsetModesNotificationDataProvider
     *
     * @return void
     */
    public function testProblemOnQualifiedBeatmapsetModesNotification(string $mode, array $notificationModes, bool $expectsNotification)
    {
        $beatmapset = Beatmapset::factory()
            ->owner($this->mapper)
            ->qualified()
            ->has(Beatmap::factory()->state([
                'playmode' => Beatmap::MODES[$mode],
                'user_id' => $this->mapper,
            ]))
            ->create();

        $user = User::factory()->create();
        $user->notificationOptions()->create([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
            'details' => ['modes' => $notificationModes],
        ]);

        $discussion = $beatmapset->beatmapDiscussions()->make([
            'message_type' => 'problem',
            'user_id' => $this->poster->getKey(),
        ]);

        // TODO: only test the handleProblemDiscussion() part?
        (new BeatmapsetDiscussionPostNew($this->poster, $discussion, 'message'))->handle();

        if ($expectsNotification) {
            Event::assertDispatched(NewPrivateNotificationEvent::class, function (NewPrivateNotificationEvent $event) use ($user) {
                return in_array($user->getKey(), $event->getReceiverIds(), true);
            });
        } else {
            Event::assertNotDispatched(NewPrivateNotificationEvent::class);
        }
    }

    /**
     * @dataProvider queuedJobsDataProvider
     */
    public function testQueuedJobs(string $state, ?string $group, array $queued, array $notQueued)
    {
        $user = User::factory()->withGroup($group)->create()->markSessionVerified();

        $beatmapset = Beatmapset::factory()
            ->owner($this->mapper)
            ->withNominations()
            ->$state()
            ->create();

        $discussion = $beatmapset->beatmapDiscussions()->make([
            'message_type' => 'problem',
            'user_id' => $user->getKey(),
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
     * @dataProvider reopeningProblemDoesNotDisqualifyOrResetNominationsDataProvider
     */
    public function testReopeningProblemDoesNotDisqualifyOrResetNominations(string $state)
    {
        $user = User::factory()->withGroup('bng')->create()->markSessionVerified();

        $beatmapset = Beatmapset::factory()
            ->owner($this->mapper)
            ->withNominations()
            ->$state()
            ->create();

        $discussion = BeatmapDiscussion::factory()->general()->problem()->state([
            'beatmapset_id' => $beatmapset,
            'resolved' => true,
            'user_id' => $user,
        ])->create();

        Queue::fake();

        $discussion->resolved = false;
        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message'))->handle();

        Queue::assertPushed(NotificationsBeatmapsetDiscussionPostNew::class);
        Queue::assertNotPushed(BeatmapsetDisqualify::class);
        Queue::assertNotPushed(BeatmapsetResetNominations::class);
    }

    /**
     * @dataProvider replyQueuesNotificationDataProvider
     */
    public function testReplyQueuesNotification(string $messageType, bool $includeStarter)
    {
        $user = User::factory()->create()->markSessionVerified();

        $discussion = BeatmapDiscussion::factory()->general()->state([
            'beatmapset_id' => $this->beatmapset,
            'message_type' => $messageType,
            'user_id' => $this->poster,
        ])->create();

        Queue::fake();

        (new BeatmapsetDiscussionPostNew($user, $discussion, 'message'))->handle();

        Queue::assertPushed(
            NotificationsBeatmapsetDiscussionPostNew::class,
            function (NotificationsBeatmapsetDiscussionPostNew $job) use ($includeStarter) {
                return $includeStarter
                    ? in_array($this->poster->getKey(), $job->getReceiverIds(), true)
                    : !in_array($this->poster->getKey(), $job->getReceiverIds(), true);
            }
        );
    }

    /**
     * @dataProvider shouldDisqualifyOrResetNominationsDataProvider
     */
    public function testShouldDisqualifyOrResetNominations(string $state, ?string $group, string $messageType, bool $existing, bool $expects)
    {
        $user = User::factory()->withGroup($group)->create()->markSessionVerified();

        $beatmapset = Beatmapset::factory()
            ->owner($this->mapper)
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
        $this->beatmapset->watches()->create(['user_id' => $watcher->getKey()]);

        $discussion = BeatmapDiscussion::factory()->general()->state([
            'beatmapset_id' => $this->beatmapset,
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

    public function queuedJobsDataProvider()
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
            ['pending'],
            ['qualified'],
        ];
    }

    public function replyQueuesNotificationDataProvider()
    {
        return [
            ['praise', false],
            ['problem', true],
            ['suggestion', true],
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

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();

        config()->set('osu.beatmapset.required_nominations', 1);

        $this->mapper = User::factory()->withPlays()->create();
        $this->poster = User::factory()->withPlays()->create();

        $this->beatmapset = Beatmapset::factory()->owner($this->mapper)->create();
        $this->beatmap = $this->beatmapset->beatmaps()->save(Beatmap::factory()->make([
            'user_id' => $this->mapper->getKey(),
        ]));
    }
}
