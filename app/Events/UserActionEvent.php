<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;

class UserActionEvent extends NotificationEventBase
{
    use SerializesModels;

    public $action;
    public $data;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId, string $action, array $data)
    {
        parent::__construct();

        $this->action = $action;
        $this->data = $data;
        $this->userId = $userId;
    }

    public function broadcastAs()
    {
        return $this->action;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("private:user:{$this->userId}");
    }

    public function broadcastWith()
    {
        return $this->data;
    }
}
