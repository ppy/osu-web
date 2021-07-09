<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserVerification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $keys;
    public $user;
    public $requestCountry;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($attributes)
    {
        $this->keys = $attributes['keys'];
        $this->user = $attributes['user'];
        $this->requestCountry = $attributes['requestCountry'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->text('emails.user_verification')
            ->subject(osu_trans('mail.user_verification.subject'));
    }
}
