<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Mail;

use App\Exceptions\InvalidNotificationException;
use App\Jobs\Notifications\BroadcastNotificationBase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserNewNotifications extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $notifications;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $lines = [];
        foreach ($this->notifications as $notification) {
            try {
                $class = BroadcastNotificationBase::getNotificationClassFromNotification($notification);
                $lines[] = $class::getMailText($notification);
            } catch (InvalidNotificationException $e) {
                log_error($e);
            }

        }

        return $this->text('emails.user_new_notifications', compact('lines'));
    }
}
