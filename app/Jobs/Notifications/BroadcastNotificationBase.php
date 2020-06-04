<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Events\NewPrivateNotificationEvent;
use App\Exceptions\InvalidNotificationException;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotificationOption;
use App\Traits\NotificationQueue;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

abstract class BroadcastNotificationBase implements ShouldQueue
{
    use NotificationQueue, Queueable, SerializesModels;

    const CONTENT_TRUNCATE = 36;

    protected $name;
    protected $object;
    protected $source;

    public static function filterUserIdsForNotificationOption(array $userIds, $optionName)
    {
        // FIXME: filtering all the ids could get quite large?
        $notificationOptions = UserNotificationOption
            ::whereIn('user_id', $userIds)
            ->where(['name' => $optionName])
            ->whereNotNull('details')
            ->get()
            ->keyBy('user_id');

        $filteredUserIds = [];
        foreach ($userIds as $userId) {
            if ($notificationOptions[$userId]->details['push'] ?? true) {
                $filteredUserIds[] = $userId;
            }
        }

        return $filteredUserIds;
    }

    public static function getNotificationClass(string $name)
    {
        $class = get_class_namespace(static::class).'\\'.studly_case($name);

        if ($class === null) {
            throw new InvalidNotificationException('Invalid event name: '.$name);
        }

        return $class;
    }

    public function __construct($object, ?User $source = null)
    {
        $this->name = snake_case(get_class_basename(get_class($this)));
        $this->object = $object;
        $this->source = $source;
    }

    abstract public function getDetails(): array;

    abstract public function getListeningUserIds(): array;

    public function getName()
    {
        return $this->name;
    }

    public function getNotifiable()
    {
        return $this->object;
    }

    /**
     * In most cases this is a deduplicated list that excludes the user id that
     * triggered the notifications. This should be overriden in cases where the source user id shouldn't be removed.
     * e.g. UserAchievementUnlock.
     */
    public function getReceiverIds(): array
    {
        return array_values(array_unique(array_diff($this->getListeningUserIds(), [optional($this->source)->getKey()])));
    }

    public function getSource(): ?User
    {
        return $this->source;
    }

    public function handle()
    {
        $receiverIds = $this->getReceiverIds();

        if (empty($receiverIds)) {
            return;
        }

        $notification = $this->makeNotification();
        $notification->saveOrExplode();

        event(new NewPrivateNotificationEvent($notification, $receiverIds));

        DB::transaction(function () use ($notification, $receiverIds) {
            foreach ($receiverIds as $id) {
                $notification->userNotifications()->create(['user_id' => $id]);
            }
        });
    }

    public function makeNotification(): Notification
    {
        $params['details'] = $this->getDetails();
        $params['name'] = $this->name;

        if (method_exists($this, 'getTimestamp')) {
            $params['created_at'] = $this->getTimestamp();
        }

        if ($this->source !== null) {
            $params['details']['username'] = $this->source;
        }

        $notification = new Notification($params);
        $notification->notifiable()->associate($this->getNotifiable());
        if ($this->source !== null) {
            $notification->source()->associate($this->source);
        }

        return $notification;
    }
}
