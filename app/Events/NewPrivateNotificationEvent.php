<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;

class NewPrivateNotificationEvent extends NewNotificationEvent
{
    use SerializesModels;

    private $receiverIds;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Notification $notification, array $receiverIds)
    {
        parent::__construct($notification);

        $this->receiverIds = $receiverIds;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return array_map(function ($userId) {
            return new Channel("private:user:{$userId}");
        }, $this->receiverIds);
    }
}
