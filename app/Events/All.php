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

    public function broadcastAs()
    {
        return $this->notification->name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        $channels = $this->notification->userNotifications->map(function ($userNotification) {
            if ($userNotification === null) {
                return;
            }

            return new Channel("user:{$userNotification->user_id}");
        })->all();

        if (!$this->notification->is_private) {
            $channels[] = new Channel('global');
        }

        return $channels;
    }

    public function broadcastWith()
    {
        return json_item($this->notification, 'Notification');
    }
}
