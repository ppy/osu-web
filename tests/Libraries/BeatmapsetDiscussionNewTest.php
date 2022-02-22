<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries;

use App\Events\NewPrivateNotificationEvent;
use App\Exceptions\AuthorizationException;
use App\Exceptions\VerificationRequiredException;
use App\Jobs\Notifications\BeatmapsetDiscussionPostNew;
use App\Jobs\Notifications\BeatmapsetDiscussionQualifiedProblem;
use App\Jobs\Notifications\BeatmapsetDisqualify;
use App\Jobs\Notifications\BeatmapsetResetNominations;
use App\Libraries\BeatmapsetDiscussionNew;
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

class BeatmapsetDiscussionNewTest extends TestCase
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

        if ($verified) {
            $user->markSessionVerified();
        }

        if (!$success) {
            $this->expectException(VerificationRequiredException::class);
        }

        (new BeatmapsetDiscussionNew($user, $beatmapset, $this->makeParams('praise')))->handle();
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

        Queue::fake();

        (new BeatmapsetDiscussionNew($user, $beatmapset, $this->makeParams('problem')))->handle();

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
    public function testShouldDisqualifyOrResetNominations(string $state, ?string $group, string $messageType, bool $expects)
    {
        $user = User::factory()->withGroup($group)->create()->markSessionVerified();

        $beatmapset = $this->beatmapsetFactory()
            ->withNominations()
            ->$state()
            ->create();

        $subject = new BeatmapsetDiscussionNew($user, $beatmapset, $this->makeParams($messageType));

        $value = $this->invokeMethod($subject, 'shouldDisqualifyOrResetNominations');
        $this->assertSame($expects, $value);
    }

    public function testWatchersGetNotification()
    {
        $user = User::factory()->create()->markSessionVerified();
        $watcher = User::factory()->create();
        $beatmapset = $this->beatmapsetFactory()->create();
        $beatmapset->watches()->create(['user_id' => $watcher->getKey()]);

        Queue::fake();

        (new BeatmapsetDiscussionNew($user, $beatmapset, $this->makeParams('praise')))->handle();

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

    //region Posting mapper notes

    public function testNewMapperNote()
    {
        $beatmapset = $this->beatmapsetFactory()->create();

        $this->expectCountChange(fn () => BeatmapDiscussion::count(), 1, BeatmapDiscussion::class);
        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), 1, BeatmapDiscussionPost::class);

        (new BeatmapsetDiscussionNew($this->mapper, $beatmapset, $this->makeParams('mapper_note')))->handle();
    }

    /**
     * @dataProvider newMapperNoteByOtherUsersDataProvider
     */
    public function testNewMapperNoteByOtherUsers(?string $group, bool $expected)
    {
        $user = User::factory()->withGroup($group)->create()->markSessionVerified();
        $beatmapset = $this->beatmapsetFactory()->create();

        $change = $expected ? 1 : 0;
        $this->expectCountChange(fn () => BeatmapDiscussion::count(), $change, BeatmapDiscussion::class);
        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), $change, BeatmapDiscussionPost::class);

        if (!$expected) {
            $this->expectException(AuthorizationException::class);
        }

        (new BeatmapsetDiscussionNew($user, $beatmapset, $this->makeParams('mapper_note')))->handle();
    }

    public function testNewMapperNoteNoteByGuestOnGuestBeatmap()
    {
        $user = User::factory()->create()->markSessionVerified();
        $beatmapset = $this->beatmapsetFactory(['user_id' => $user])->create();
        $beatmap = $beatmapset->beatmaps->first();

        $this->expectCountChange(fn () => BeatmapDiscussion::count(), 1, BeatmapDiscussion::class);
        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), 1, BeatmapDiscussionPost::class);

        (new BeatmapsetDiscussionNew(
            $user,
            $beatmapset,
            $this->makeParams('mapper_note', $beatmap)
        ))->handle();
    }

    public function testNewMapperNoteNoteByMapperOnGuestBeatmap()
    {
        $user = User::factory()->create()->markSessionVerified();
        $beatmapset = $this->beatmapsetFactory(['user_id' => $user])->create();
        $beatmap = $beatmapset->beatmaps->first();

        $this->expectCountChange(fn () => BeatmapDiscussion::count(), 1, BeatmapDiscussion::class);
        $this->expectCountChange(fn () => BeatmapDiscussionPost::count(), 1, BeatmapDiscussionPost::class);

        (new BeatmapsetDiscussionNew(
            $this->mapper,
            $beatmapset,
            $this->makeParams('mapper_note', $beatmap)
        ))->handle();
    }

    //endregion

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

        (new BeatmapsetDiscussionNew($user, $beatmapset, $this->makeParams('problem')))->handle();

        $assertMethod(NewPrivateNotificationEvent::class);
    }

    public function testSecondProblemOnQualifiedBeatmapset()
    {
        // TODO: add test for hasPriorOpenProblems?

        $user = User::factory()->create()->markSessionVerified();

        $beatmapset = $this->beatmapsetFactory()
            ->qualified()
            ->has(BeatmapDiscussion::factory()->general()->problem()->state([
                'user_id' => $user,
            ]))
            ->create();

        User::factory()->create()->notificationOptions()->create([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
            'details' => ['modes' => array_keys(Beatmap::MODES)],
        ]);

        (new BeatmapsetDiscussionNew($user, $beatmapset, $this->makeParams('problem')))->handle();

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

        // TODO: only test the handleProblemDiscussion() part?
        (new BeatmapsetDiscussionNew($user, $beatmapset, $this->makeParams('problem')))->handle();

        if ($expectsNotification) {
            Event::assertDispatched(NewPrivateNotificationEvent::class, function (NewPrivateNotificationEvent $event) use ($watcher) {
                return in_array($watcher->getKey(), $event->getReceiverIds(), true);
            });
        } else {
            Event::assertNotDispatched(NewPrivateNotificationEvent::class);
        }
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
                [BeatmapsetDisqualify::class, BeatmapsetDiscussionPostNew::class],
                [BeatmapsetDiscussionQualifiedProblem::class, BeatmapsetResetNominations::class],
            ],
            [
                'qualified',
                'bng_limited',
                [BeatmapsetDiscussionPostNew::class, BeatmapsetDiscussionQualifiedProblem::class],
                [BeatmapsetDisqualify::class, BeatmapsetResetNominations::class],
            ],
            [
                'qualified',
                null,
                [BeatmapsetDiscussionPostNew::class, BeatmapsetDiscussionQualifiedProblem::class],
                [BeatmapsetDisqualify::class, BeatmapsetResetNominations::class],
            ],
            [
                'pending',
                'bng',
                [BeatmapsetResetNominations::class, BeatmapsetDiscussionPostNew::class],
                [BeatmapsetDiscussionQualifiedProblem::class, BeatmapsetDisqualify::class],
            ],
            [
                'pending',
                'bng_limited',
                [BeatmapsetResetNominations::class, BeatmapsetDiscussionPostNew::class],
                [BeatmapsetDiscussionQualifiedProblem::class, BeatmapsetDisqualify::class],
            ],
            [
                'pending',
                null,
                [BeatmapsetDiscussionPostNew::class],
                [BeatmapsetDiscussionQualifiedProblem::class, BeatmapsetDisqualify::class, BeatmapsetResetNominations::class],
            ],
        ];
    }

    public function newMapperNoteByOtherUsersDataProvider()
    {
        return [
            ['bng', true],
            ['bng_limited', true],
            ['gmt', true],
            ['nat', true],
            [null, false],
        ];
    }

    public function shouldDisqualifyOrResetNominationsDataProvider()
    {
        return [
            ['pending', 'bng', 'problem', true],
            ['pending', 'bng', 'suggestion', false],
            ['pending', 'bng_limited', 'problem', true],
            ['pending', 'bng_limited', 'suggestion', false],
            ['pending', null, 'problem', false],
            ['pending', null, 'suggestion', false],

            // similar to pending except bng_limited cannot disqualify
            ['qualified', 'bng', 'problem', true],
            ['qualified', 'bng', 'suggestion', false],
            ['qualified', 'bng_limited', 'problem', false], // cannot disqualify
            ['qualified', 'bng_limited', 'suggestion', false],
            ['qualified', null, 'problem', false],
            ['qualified', null, 'suggestion', false],
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

    private function makeParams(string $messageType, ?Beatmap $beatmap = null)
    {
        $params = [
            'beatmap_discussion' => [
                'message_type' => $messageType,
            ],
            'beatmap_discussion_post' => ['message' => 'message'],
        ];

        if ($beatmap !== null) {
            $params['beatmap_discussion']['beatmap_id'] = $beatmap->getKey();
        }

        return $params;
    }
}
