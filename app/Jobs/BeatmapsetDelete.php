<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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

            $this->beatmapset->removeCovers();
        });
    }
}
