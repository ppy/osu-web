<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;

class NotificationDeleteEvent extends NotificationEventBase
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public $userId, public array $params, public bool $shouldBroadcastNow = false)
    {
        parent::__construct();
    }

    public function broadcastAs()
    {
        return 'delete';
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
        return $this->params;
    }

    public function shouldBroadcastNow()
    {
        return $this->shouldBroadcastNow;
    }
}
