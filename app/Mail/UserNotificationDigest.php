<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Mail;

use App\Exceptions\InvalidNotificationException;
use App\Jobs\Notifications\BroadcastNotificationBase;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Mail\Mailable;

// Not queueable to avoid trap of too many serialize/unserialize.
// Paired with App\Jobs\UserNotificationDigest
class UserNotificationDigest extends Mailable
{
    private $groups = [];
    private $notifications;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $notifications, User $user)
    {
        $this->user = $user;
        $this->notifications = $notifications;
    }

    private function addToGroups(Notification $notification)
    {
        try {
            $class = BroadcastNotificationBase::getNotificationClassFromNotification($notification);
            $baseKey = 'notifications.mail.'.$class::getBaseKey($notification);
            $key = "{$baseKey}-{$notification->notifiable_type}-{$notification->notifiable_id}";

            if (isset($this->groups[$key])) {
                return;
            }

            // remove anything not a string because trans doesn't like it.
            $details = array_filter($notification->details ?? [], function ($value) {
                return is_string($value);
            });

            $this->groups[$key] = [
                'link' => $class::getMailLink($notification),
                'text' => trans($baseKey, $details),
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

        $user = $this->user;

        return $this->text('emails.user_notification_digest', compact('lines', 'user'));
    }
}
