<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Events\NewPrivateNotificationEvent;
use App\Models\Notification;
use App\Models\Notifications\NotificationBase;
use App\Models\User;
use App\Traits\NotificationQueue;
use DB;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class BroadcastNotification implements ShouldQueue
{
    use NotificationQueue, Queueable, SerializesModels;

    const CONTENT_TRUNCATE = 36;

    private $name;
    private $notifiable;
    private $object;
    private $params = [];
    private $receiverIds;
    private $source;

    public function __construct(string $name, $object, ?User $source = null)
    {
        $this->name = $name;
        $this->object = $object;
        $this->source = $source;
    }

    public function getName()
    {
        return $this->name;
    }

    public function handle()
    {
        $class = NotificationBase::notificationClassFor($this->name);

        // TODO: handle InvalidNotificationException
        $builder = new $class($this->object, $this->source);

        if ($builder === null) {
            log_error(new Exception('Invalid event name: '.$this->name));

            return;
        }

        $this->receiverIds = array_values(array_unique(array_diff($builder->getReceiverIds(), [optional($builder->getSource())->getKey()])));

        if (empty($this->receiverIds)) {
            return;
        }

        $notification = $builder->makeNotification();
        $notification->saveOrExplode();

        event(new NewPrivateNotificationEvent($notification, $this->receiverIds));

        DB::transaction(function () use ($notification) {
            foreach ($this->receiverIds as $id) {
                $notification->userNotifications()->create(['user_id' => $id]);
            }
        });
    }
}
