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

    private $keyed = [];

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

    private function addKeyed(Notification $notification)
    {
        $key = $notification->notifiable_type;
        $id = $notification->notifiable_id;

        $this->keyed[$key][$id][] = $notification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        foreach ($this->notifications as $notification) {
            $this->addKeyed($notification);
        }

        $lines = [];
        foreach ($this->keyed as $notifiableType => $notificationsByNotifiableId) {
            foreach ($notificationsByNotifiableId as $notifiableId => $notifications) {
                $lines[] = "Updates in {$notifiableType}#{$notifiableId}";

                foreach ($notifications as $notification) {
                    try {
                        $class = BroadcastNotificationBase::getNotificationClassFromNotification($notification);
                        $lines[] = $class::getMailText($notification);
                    } catch (InvalidNotificationException $e) {
                        log_error($e);
                    }
                }

                $lines[] = '';
            }
        }

        return $this->text('emails.user_new_notifications', compact('lines'));
    }
}
