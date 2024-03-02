<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Listeners\MedalUnlocks;

use App\Models\Achievement;
use App\Models\Beatmap;
use App\Models\User;
use App\Models\UserAchievement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Listener for the unlock conditions of a medal.
 *
 * In subclasses of this type, declare an `$event` property with the types of
 * events the unlock should listen for.
 */
abstract class MedalUnlock implements ShouldQueue
{
    use InteractsWithQueue;

    public bool $afterCommit = true;

    /**
     * State recorded at queue time.
     */
    protected mixed $state;

    /**
     * Get the medal's slug.
     */
    abstract public static function getMedalSlug(): string;

    /**
     * Get additional state at queue time that should be made available at
     * `$this->state` when handling.
     */
    public static function getQueueableState(): mixed
    {
        return null;
    }

    private static function getMedal(): ?Achievement
    {
        return app('medals')->bySlug(static::getMedalSlug());
    }

    /**
     * Get the users that may be able to unlock the medal.
     */
    abstract protected function getApplicableUsers(): Collection|User|array;

    /**
     * Test whether this unlock should be queued for handling.
     */
    abstract protected function shouldHandle(): bool;

    /**
     * Test whether the given user meets the unlock conditions for the medal.
     *
     * This is also an appropriate time to store tracking information about
     * the user's progress on the medal unlock, if necessary.
     */
    abstract protected function shouldUnlockForUser(User $user): bool;

    final public function handle(object $event): void
    {
        if (($medal = static::getMedal()) === null) {
            return;
        }

        $this->event = $event;
        $this->state = $this->job->payload()['data']['state'];

        $users = Collection::wrap($this->getApplicableUsers())
            ->unique('user_id')
            ->filter(
                fn (User $user) =>
                    $user
                        ->userAchievements()
                        ->where('achievement_id', $medal->getKey())
                        ->doesntExist() &&
                    $this->shouldUnlockForUser($user),
            );

        if ($users->isEmpty()) {
            return;
        }

        DB::transaction(function () use ($medal, $users) {
            foreach ($users as $user) {
                UserAchievement::unlock(
                    $user,
                    $medal,
                    $this->getBeatmapForUser($user),
                );
            }
        });
    }

    final public function shouldQueue(object $event): bool
    {
        if (static::getMedal() === null) {
            return false;
        }

        $this->event = $event;

        return $this->shouldHandle();
    }

    /**
     * Get the beatmap associated with this medal unlock for the given user.
     */
    protected function getBeatmapForUser(User $user): ?Beatmap
    {
        return null;
    }
}
