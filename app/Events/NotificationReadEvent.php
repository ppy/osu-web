<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;

class NotificationReadEvent extends NotificationEventBase
{
    use SerializesModels;

    public $params;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId, array $params)
    {
        parent::__construct();

        $this->params = $params;
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
        return $this->params;
    }
}
