<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Mail\BeatmapsetUpdateNotice;
use App\Models\Beatmapset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class NotifyBeatmapsetUpdate implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $beatmapset;
    private $user;

    public static function dispatch($attributes)
    {
        return dispatch((new static($attributes))->delay(Carbon::now()->addMinutes(5)));
    }

    public function __construct($attributes)
    {
        $this->beatmapset = $attributes['beatmapset'];
        $this->user = $attributes['user'];
    }

    public function handle()
    {
        if ($this->beatmapset === null) {
            return;
        }

        $discussions = $this->beatmapset->beatmapDiscussions();
        $lastDiscussion = $discussions->orderBy('id', 'DESC')->first();

        $events = $this->beatmapset->events();
        $lastEvent = $events->orderBy('id', 'DESC')->first();

        $lastUpdate = max([
            $this->beatmapset->last_update,
            $lastDiscussion->updated_at ?? null,
            $lastEvent->updated_at ?? null,
        ]);

        if ($lastUpdate === null) {
            return;
        }

        $watches = $this
            ->beatmapset
            ->watches()
            ->read()
            ->where('last_read', '<', $lastUpdate)
            ->with('user');

        if ($this->user !== null) {
            $watches->where('user_id', '<>', $this->user->getKey());
        }

        foreach ($watches->get() as $watch) {
            $user = $watch->user;

            if (!present($user->user_email)) {
                continue;
            }

            Mail::to($user->user_email)
                ->queue(new BeatmapsetUpdateNotice([
                    'watch' => $watch,
                ]));

            $watch->update(['last_notified' => Carbon::now()]);
        }
    }
}
