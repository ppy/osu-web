<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Events\NewPrivateNotificationEvent;
use App\Exceptions\InvalidNotificationException;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserNotification;
use App\Models\UserNotificationOption;
use App\Traits\NotificationQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

abstract class BroadcastNotificationBase implements ShouldQueue
{
    use NotificationQueue, Queueable, SerializesModels;

    const CONTENT_TRUNCATE = 36;

    const NOTIFICATION_OPTION_NAME = null;

    protected $name;
    protected $source;
    protected $timestamp;

    public static function getBaseKey(Notification $notification): string
    {
        return "{$notification->notifiable_type}.{$notification->category}.{$notification->name}";
    }

    public static function getMailGroupingKey(Notification $notification): string
    {
        $base = static::getBaseKey($notification);

        return "{$base}-{$notification->notifiable_type}-{$notification->notifiable_id}";
    }

    abstract public static function getMailLink(Notification $notification): string;

    public static function getNotificationClass(string $name)
    {
        $class = get_class_namespace(static::class).'\\'.studly_case($name);

        if (!class_exists($class)) {
            throw new InvalidNotificationException('Invalid event name: '.$name);
        }

        return $class;
    }

    public static function getNotificationClassFromNotification(Notification $notification)
    {
        return static::getNotificationClass($notification->name);
    }

    /**
     * Checks if a notification should be included into the user notification mail digest.
     * This mainly used to exclude the more generic notifications from being re-notified if they haven't been 'read'.
     * The notifications with more specific messages or links should still be included, since they're usually going to be
     * different in each digest.
     *
     * @param Notification $notification The notification to check.
     * @param $watches A keyed collection of watches; this is here because there's no DB context cache but watches need preloading,
     * so it's preloaded and then passed in.
     * @param $time The time the mail notification is considered run at.
     * @return bool
     */
    public static function shouldSendMail(Notification $notification, $watches, $time): bool
    {
        return true;
    }

    private static function applyDeliverySettings(array $userIds)
    {
        static $defaults = ['mail' => true, 'push' => true];

        if (static::NOTIFICATION_OPTION_NAME !== null) {
            $notificationOptionsQuery = UserNotificationOption
                ::where(['name' => static::NOTIFICATION_OPTION_NAME])
                ->whereNotNull('details');
        }

        $deliverySettings = [];

        foreach (array_chunk($userIds, 10000) as $chunkedUserIds) {
            if (isset($notificationOptionsQuery)) {
                $notificationOptions = (clone $notificationOptionsQuery)
                    ->whereIntegerInRaw('user_id', $chunkedUserIds)
                    ->get()
                    ->keyBy('user_id');
            } else {
                $notificationOptions = [];
            }

            foreach ($chunkedUserIds as $userId) {
                $details = $notificationOptions[$userId]->details ?? $defaults;
                $delivery = 0;
                foreach (UserNotification::DELIVERY_OFFSETS as $type => $_offset) {
                    if ($details[$type] ?? $defaults[$type]) {
                        $delivery |= UserNotification::deliveryMask($type);
                    }
                }

                $deliverySettings[$userId] = $delivery;
            }
        }

        return $deliverySettings;
    }

    private static function excludeBotUserIds(array $userIds)
    {
        $botGroupId = app('groups')->byIdentifier('bot')->getKey();

        $allBotUserIds = UserGroup
            ::where('group_id', $botGroupId)
            ->select('user_id');

        // only consider users with bot as their primary group
        $botUserIds = User
            ::where('group_id', $botGroupId)
            ->whereIn('user_id', $allBotUserIds)
            ->pluck('user_id')
            ->all();

        return array_values(array_diff($userIds, $botUserIds));
    }

    public function __construct(?User $source = null)
    {
        $this->name = snake_case(get_class_basename(get_class($this)));
        $this->source = $source;
    }

    abstract public function getDetails(): array;

    abstract public function getListeningUserIds(): array;

    public function getName()
    {
        return $this->name;
    }

    abstract public function getNotifiable();

    /**
     * In most cases this is a deduplicated list that excludes the user id that
     * triggered the notifications. This should be overriden in cases where the source user id shouldn't be removed.
     * e.g. UserAchievementUnlock.
     */
    public function getReceiverIds(): array
    {
        return array_values(array_unique(array_diff($this->getListeningUserIds(), [optional($this->source)->getKey()])));
    }

    public function getTimestamp()
    {
        if ($this->timestamp === null) {
            $this->timestamp = now();
        }

        return $this->timestamp;
    }

    public function handle()
    {
        $deliverySettings = static::applyDeliverySettings(static::excludeBotUserIds($this->getReceiverIds()));

        if (empty($deliverySettings)) {
            return;
        }

        $notification = $this->makeNotification();
        $notification->saveOrExplode();

        // client should now be able to handle push notifications that come in after notification has been loaded,
        // so, it should be fine to create the user notifications first.

        $pushReceiverIds = [];
        $notification->getConnection()->transaction(function () use ($deliverySettings, $notification, &$pushReceiverIds) {
            $timestamp = (string) $this->getTimestamp();
            $notificationId = $notification->getKey();
            $tempUserNotification = new UserNotification();

            $userNotifications = [];
            foreach ($deliverySettings as $userId => $delivery) {
                $userNotifications[] = [
                    'created_at' => $timestamp,
                    'delivery' => $delivery,
                    'notification_id' => $notificationId,
                    'updated_at' => $timestamp,
                    'user_id' => $userId,
                ];
                $tempUserNotification->delivery = $delivery;
                $tempUserNotification->isPush() && $pushReceiverIds[] = $userId;

                if (count($userNotifications) === 1000) {
                    UserNotification::insert($userNotifications);
                    $userNotifications = [];
                }
            }
            UserNotification::insert($userNotifications);
        });

        if (!empty($pushReceiverIds)) {
            event(new NewPrivateNotificationEvent($notification, $pushReceiverIds));
        }
    }

    public function makeNotification(): Notification
    {
        $params['created_at'] = $this->getTimestamp();
        $params['details'] = $this->getDetails();
        $params['name'] = $this->name;

        if ($this->source !== null) {
            $params['details']['username'] = $this->source->username;
        }

        $notification = new Notification($params);
        $notification->notifiable()->associate($this->getNotifiable());
        if ($this->source !== null) {
            $notification->source()->associate($this->source);
        }

        return $notification;
    }
}
