<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Jobs;

use App\Mail\BeatmapsetUpdateNotice;
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
