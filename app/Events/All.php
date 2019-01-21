<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class All implements ShouldBroadcast
{
    use SerializesModels;

    public $notification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        if ($this->notification->is_private) {
            return $this->notification->userNotifications->map(function ($userNotification) {
                if ($userNotification === null) {
                    return;
                }

                return new Channel("user:{$userNotification->user_id}");
            })->all();
        }

        return new Channel('global');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->notification->getKey(),
            'name' => $this->notification->name,
            'object_type' => $this->notification->notifiable_type,
            'object_id' => $this->notification->notifiable_id,
            'source_user_id' => $this->notification->source_user_id,
            'details' => $this->notification->details,
        ];
    }
}
