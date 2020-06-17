<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Mail\UserNotificationDigest as UserNotificationDigestMail;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class UserNotificationDigest implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $fromId;
    private $toId;
    private $user;

    public function __construct(User $user, int $fromId, int $toId)
    {
        $this->user = $user;
        $this->fromId = $fromId;
        $this->toId = $toId;
    }

    public function handle()
    {
        $notifications = Notification
            ::whereHas('userNotifications', function ($q) {
                $q->where('user_id', $this->user->getKey())->hasMailDelivery();
            })
            ->where('id', '>', $this->fromId)
            ->where('id', '<=', $this->toId)
            ->get()
            ->all();

        if (empty($notifications)) {
            return;
        }

        // TODO: catch and log errors?
        Mail::to($this->user)->sendNow(new UserNotificationDigestMail($notifications));
    }
}
