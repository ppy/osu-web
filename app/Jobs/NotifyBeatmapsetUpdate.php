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

use App\Mail\BeatmapsetUpdateNotice;
use App\Models\UserNotificationOption;
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
    private $updatedAt;

    public function __construct($data)
    {
        $this->beatmapset = $data['beatmapset'];
        $this->user = $data['user'];
        $this->updatedAt = Carbon::now();
    }

    public function delayedDispatch()
    {
        return dispatch($this)->delay(Carbon::now()->addMinutes(5));
    }

    public function handle()
    {
        if ($this->beatmapset === null) {
            return;
        }

        $watches = $this
            ->beatmapset
            ->watches()
            ->read()
            ->where('last_read', '<', $this->updatedAt)
            ->with('user');

        if ($this->user !== null) {
            $watches->where('user_id', '<>', $this->user->getKey());
        }

        $userIds = $watches->pluck('user_id');

        $options = UserNotificationOption
            ::whereIn('user_id', $userIds)
            ->where(['name' => UserNotificationOption::BEATMAPSET_MODDING])
            ->get()
            ->keyBy('user_id');

        foreach ($watches->get() as $watch) {
            $user = $watch->user;

            if (!present($user->user_email)) {
                continue;
            }

            if (($options[$user->getKey()]->details['mail'] ?? true) !== true) {
                continue;
            }

            Mail::to($user)
                ->queue(new BeatmapsetUpdateNotice([
                    'watch' => $watch,
                ]));

            $watch->update(['last_notified' => Carbon::now()]);
        }
    }
}
