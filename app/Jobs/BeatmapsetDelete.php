<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Exceptions\AuthorizationException;
use App\Models\Beatmapset;
use App\Models\Event;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BeatmapsetDelete implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Beatmapset */
    private $beatmapset;

    /** @var User */
    private $user;

    public function __construct(Beatmapset $beatmapset, User $user)
    {
        $this->user = $user;
        $this->beatmapset = $beatmapset;
    }

    public function handle()
    {
        // Extra check that doesn't get bypassed by admin permissions.
        if ($this->beatmapset->isScoreable()) {
            throw new AuthorizationException('This beatmap is no longer deleteable.');
        }

        $this->beatmapset->getConnection()->transaction(function () {
            if ($this->beatmapset->user_id === $this->user->user_id) {
                Event::generate(
                    'beatmapsetDelete',
                    ['beatmapset' => $this->beatmapset, 'user' => $this->user]
                );
            } else {
                Log::log([
                    'log_data' => array_only($this->beatmapset->getAttributes(), ['beatmapset_id', 'title']),
                    'log_time' => Carbon::now(),
                    'log_type' => Log::LOG_BEATMAPSET_MOD,
                    'log_ip' => request()->ip(),
                    'log_operation' => 'LOG_BEATMAPSET_DELETE',
                    'user_id' => $this->user->user_id,
                ]);
            }

            // won't update already deleted beatmaps which is what we want.
            $this->beatmapset->beatmaps()->delete();
            if ($this->beatmapset->delete() === false) {
                // something internal probably went wrong, so just force a rollback.
                throw new Exception('Failed to delete beatmapset.');
            }

            // only update the non-deleted comments.
            $this->beatmapset->comments()->withoutTrashed()->update([
                'deleted_by_id' => $this->user->getKey(),
                // can restore comments >= than this date if really needed when undeleting.
                'deleted_at' => $this->beatmapset->deleted_at,
            ]);

            if ($this->beatmapset->topic !== null) {
                $this->beatmapset->topic->delete();
            }

            $this->beatmapset->removeCovers();
        });
    }
}
