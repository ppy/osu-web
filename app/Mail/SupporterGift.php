<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupporterGift extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $tries = 5;

    private $params;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($donor, $giftee, $duration)
    {
        $this->params = [
            'donor' => $donor,
            'giftee' => $giftee,
            'duration' => $duration,
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('emails.store.supporter_gift')
            ->with($this->params)
            ->subject(osu_trans('mail.supporter_gift.subject'));
    }
}
