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

        $currentDiscussions = BeatmapDiscussion::count();
        $currentDiscussionPosts = BeatmapDiscussionPost::count();
        $currentNotifications = Notification::count();
        $currentUserNotifications = UserNotification::count();

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
        $change = $success ? 1 : 0;
        $this->assertSame($currentDiscussions + $change, BeatmapDiscussion::count());
        $this->assertSame($currentDiscussionPosts + $change, BeatmapDiscussionPost::count());
        $this->assertSame($currentNotifications + $change, Notification::count());
        $this->assertSame($currentUserNotifications + $change, UserNotification::count());

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

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();

        $this->mapper = User::factory()->withPlays()->create();
        $this->poster = User::factory()->withPlays()->create();

        $this->beatmapset = Beatmapset::factory()->owner($this->mapper)->create();
        $this->beatmap = $this->beatmapset->beatmaps()->save(Beatmap::factory()->make([
            'user_id' => $this->mapper->getKey(),
        ]));
    }
}
