<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationThanks extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $tries = 5;

    private $params = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($donor, $length, $amount, $isGift, $continued)
    {
        $this->params = [
            'continued' => $continued,
            'donor' => $donor,
            'duration' => $length,
            'amount' => $amount,
            'isGift' => $isGift,
            'minutes' => round($amount / config('payments.running_cost') * 525949, 1), // 365.2425 days
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('emails.store.donation_thanks')
            ->with($this->params)
            ->from(
                config('store.mail.donation_thanks.sender_address'),
                config('store.mail.donation_thanks.sender_name')
            )
            ->subject(osu_trans('mail.donation_thanks.subject'));
    }
}
