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
            ])->subject(trans('mail.user_force_reactivation.subject'));
    }
}
