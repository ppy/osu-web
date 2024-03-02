<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\MedalUnlocks;

use App\Models\Achievement;
use App\Models\Beatmap;
use App\Models\User;
use Illuminate\Events\CallQueuedListener;
use Illuminate\Queue\QueueManager;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Testing\Fakes\QueueFake;
use Tests\TestCase;

abstract class MedalUnlockTestCase extends TestCase
{
    /**
     * The medal to test.
     */
    protected Achievement $medal;

    /**
     * The user that may unlock the medal.
     */
    protected User $user;

    private QueueFake $queueFake;
    private QueueManager $queueReal;

    /**
     * Get the medal unlock class to test.
     */
    abstract protected static function getMedalUnlockClass(): string;

    /**
     * Assert that the user has unlocked the medal.
     */
    protected function assertMedalUnlocked(bool $unlocked = true): void
    {
        $this->handleQueuedMedalUnlocks();

        $this->assertSame(
            $unlocked,
            $this->user
                ->userAchievements()
                ->where('achievement_id', $this->medal->getKey())
                ->exists(),
        );
    }

    /**
     * Assert that the user has unlocked the medal, and that the unlock is
     * associated with the given beatmap.
     */
    protected function assertMedalUnlockedWithBeatmap(?Beatmap $beatmap): void
    {
        $this->handleQueuedMedalUnlocks();

        $medal = $this->user
            ->userAchievements()
            ->where('achievement_id', $this->medal->getKey())
            ->first();

        $this->assertNotNull($medal);
        $this->assertSame($beatmap?->getKey(), $medal->beatmap_id);
    }

    /**
     * Assert that the medal unlock has been queued for handling.
     */
    protected function assertMedalUnlockQueued(bool $queued = true): void
    {
        $method = $queued ? 'assertPushed' : 'assertNotPushed';

        Queue::$method(CallQueuedListener::class, function (CallQueuedListener $job) {
            return $job->class === static::getMedalUnlockClass();
        });
    }

    /**
     * Reset the user's medal unlock.
     */
    protected function resetMedalProgress(): void
    {
        $this->invokeSetProperty(app('queue'), 'jobs', []);

        $this->user
            ->userAchievements()
            ->where('achievement_id', $this->medal->getKey())
            ->delete();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->queueReal = Queue::getFacadeRoot();
        $this->queueFake = Queue::fake();

        $this->medal = Achievement::factory()->create([
            'slug' => static::getMedalUnlockClass()::getMedalSlug(),
        ]);
        $this->user = User::factory()->create();
    }

    private function handleQueuedMedalUnlocks(): void
    {
        $listenerJobs = Queue::pushedJobs()[CallQueuedListener::class] ?? [];

        if (empty($listenerJobs)) {
            return;
        }

        Queue::swap($this->queueReal);

        foreach ($listenerJobs as $job) {
            if ($job['job']->class === static::getMedalUnlockClass()) {
                dispatch_sync($job['job']);
            }
        }

        Queue::swap($this->queueFake);
        $this->invokeSetProperty(app('queue'), 'jobs', []);
    }
}
