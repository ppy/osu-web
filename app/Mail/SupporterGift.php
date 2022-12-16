<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Mail;

use App\Models\User;
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
    public function __construct(User $donor, User $giftee, int $duration, ?iterable $messages = null)
    {
        $this->params = [
            'donor' => $donor,
            'duration' => $duration,
            'giftee' => $giftee,
            'messages' => $messages,
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
