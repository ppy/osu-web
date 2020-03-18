<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use App\Models\User;
use App\Models\UserNotificationOption;
use Illuminate\Broadcasting\Channel;

class NotificationOptionChangeEvent extends NotificationEventBase
{
    public $userId;
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, UserNotificationOption $notificationOption)
    {
        parent::__construct();

        $this->userId = $user->getKey();
        $this->data = $notificationOption->only('name', 'details');
    }

    public function broadcastAs()
    {
        return 'notification_option.change';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("user_subscription:{$this->userId}");
    }

    public function broadcastWith()
    {
        return $this->data;
    }
}
