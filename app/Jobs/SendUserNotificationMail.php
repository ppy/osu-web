<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Mail\UserNewNotifications;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendUserNotificationMail implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        if ($this->user === null) {
            return;
        }

        if (!present($this->user->user_email)) {
            return;
        }

        // TODO: temporary for testing
        $notifications = $this->user->userNotifications()->where('is_read', false)->with('notification.notifiable')->get()->pluck('notification');

        Mail::to($this->user)->queue(new UserNewNotifications($notifications));
    }
}
