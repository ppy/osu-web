<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;

class NotificationReadEvent extends NotificationEventBase
{
    use SerializesModels;

    public $notificationIds;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId, $notificationIds)
    {
        parent::__construct();

        $this->notificationIds = $notificationIds;
        $this->userId = $userId;
    }

    public function broadcastAs()
    {
        return 'read';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("notification_read:{$this->userId}");
    }

    public function broadcastWith()
    {
        return ['ids' => $this->notificationIds];
    }
}
