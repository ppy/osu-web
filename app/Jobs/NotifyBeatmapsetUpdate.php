<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
