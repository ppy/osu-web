<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Mail;

use App\Exceptions\InvalidNotificationException;
use App\Jobs\Notifications\BroadcastNotificationBase;
use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserNewNotifications extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $groups = [];

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

    private function addToGroups(Notification $notification)
    {
        try {
            $class = BroadcastNotificationBase::getNotificationClassFromNotification($notification);
            $baseKey = 'notifications.mail.'.$class::getMailBaseKey($notification);
            $key = "{$baseKey}-{$notification->notifiable_type}-{$notification->notifiable_id}";

            if (isset($this->groups[$key])) {
                return;
            }

            $this->groups[$key] = [
                'link' => $class::getMailLink($notification),
                'text' => trans($baseKey, $notification->details),
            ];
        } catch (InvalidNotificationException $e) {
            log_error($e);
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        foreach ($this->notifications as $notification) {
            $this->addToGroups($notification);
        }

        $lines = [];
        foreach ($this->groups as $key => $values) {
            $lines[] = $values['text'];
            $lines[] = $values['link'];
            $lines[] = '';
        }

        return $this->text('emails.user_new_notifications', compact('lines'));
    }
}
