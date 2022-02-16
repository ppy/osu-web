<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries;

use App\Events\NewPrivateNotificationEvent;
use App\Exceptions\VerificationRequiredException;
use App\Libraries\BeatmapsetDiscussionPostNew;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Event;
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
        $watcher = User::factory()->create();
        $this->beatmapset->watches()->create(['user_id' => $watcher->getKey()]);

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

        // TODO: exception thrown means the fail case doesn't get this far...
        if ($success) {
            Event::assertDispatched(NewPrivateNotificationEvent::class, function (NewPrivateNotificationEvent $event) use ($user, $watcher) {
                // assert watchers in receivers and sender is not.
                return in_array($watcher->getKey(), $event->getReceiverIds(), true)
                    && !in_array($user->getKey(), $event->getReceiverIds(), true);
            });
        } else {
            Event::assertNotDispatched(NewPrivateNotificationEvent::class);
        }
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

        $params = [
            'message_type' => $messageType,
            'user_id' => $user->getKey(),
        ];

        if ($existing) {
            $discussion = $beatmapset->beatmapDiscussions()->create($params);
            // models created by factory still have wasRecentlyCreated = true.
            $discussion->wasRecentlyCreated = false;
        } else {
            $discussion = $beatmapset->beatmapDiscussions()->create($params);
        }

        $subject = new BeatmapsetDiscussionPostNew($user, $discussion, 'message');

        $value = $this->invokeMethod($subject, 'shouldDisqualifyOrResetNominations');
        $this->assertSame($expects, $value);
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
