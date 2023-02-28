<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Mail;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class UserForceReactivation extends Mailable implements ShouldQueue
{
    private $user;
    private $reason;

    public function __construct($attributes)
    {
        $this->user = $attributes['user'];
        $this->reason = $attributes['reason'];
    }

    public function build()
    {
        return $this
            ->text('emails.user_force_reactivation')
            ->with([
                'reason' => $this->reason,
                'user' => $this->user,
            ])->subject(osu_trans('mail.user_force_reactivation.subject'));
    }
}
