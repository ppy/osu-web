<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BeatmapsetUpdateNotice extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $tries = 5;

    private $watch;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($attributes)
    {
        $this->watch = $attributes['watch'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->watch === null) {
            return;
        }

        $beatmapset = $this->watch->beatmapset;
        $user = $this->watch->user;

        if ($beatmapset === null || $user === null) {
            return;
        }

        return $this
            ->text('emails.beatmapset.update_notice')
            ->subject(osu_trans('mail.beatmapset_update_notice.subject', [
                'title' => $beatmapset->getDisplayTitle($user),
            ]))
            ->with(compact('beatmapset', 'user'));
    }
}
