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

        $this->notifiable = $builder->getNotifiable();
        $this->params['details'] = $builder->getDetails();
        $this->receiverIds = $builder->getReceiverIds();

        $this->params['name'] = $this->name;
        // TODO: move setting username
        if ($builder->getSource() !== null) {
            $this->params['details']['username'] = $builder->getSource()->username;
        }

        $this->receiverIds = array_values(array_unique(array_diff($this->receiverIds, [optional($builder->getSource())->getKey()])));

        if (empty($this->receiverIds)) {
            return;
        }

        $notification = new Notification($this->params);
        $notification->notifiable()->associate($this->notifiable);
        if ($builder->getSource() !== null) {
            $notification->source()->associate($builder->getSource());
        }

        $notification->save();

        event(new NewPrivateNotificationEvent($notification, $this->receiverIds));

        DB::transaction(function () use ($notification) {
            foreach ($this->receiverIds as $id) {
                $notification->userNotifications()->create(['user_id' => $id]);
            }
        });
    }
}
