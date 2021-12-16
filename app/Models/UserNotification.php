<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Events\NotificationDeleteEvent;
use App\Events\NotificationReadEvent;
use App\Libraries\Notification\BatchIdentities;
use DB;
use Illuminate\Database\Eloquent\Builder;

class UserNotification extends Model
{
    const DELIVERY_OFFSETS = [
        'push' => 0,
        'mail' => 1,
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public static function batchDestroy(User $user, BatchIdentities $batchIdentities)
    {
        $notificationIds = $batchIdentities->getNotificationIds();
        $identities = $batchIdentities->getIdentities();

        if (empty($notificationIds)) {
            return;
        }

        $now = now();
        // obtain and filter valid user notification ids
        $ids = $user
            ->userNotifications()
            ->whereIn('notification_id', $notificationIds)
            ->where('created_at', '<=', $now)
            ->pluck('id')
            ->all();

        if (empty($ids)) {
            return;
        }

        $readCount = 0;

        foreach (array_chunk($ids, 1000) as $chunkedIds) {
            $unreadCountQuery = $user
                ->userNotifications()
                ->hasPushDelivery()
                ->where('is_read', false)
                ->whereIn('id', $chunkedIds);
            $unreadCountInitial = $unreadCountQuery->count();
            $user
                ->userNotifications()
                ->whereIn('id', $chunkedIds)
                ->delete();

            $unreadCountCurrent = $unreadCountQuery->count();
            $readCount += $unreadCountInitial - $unreadCountCurrent;
        }

        (new NotificationDeleteEvent($user->getKey(), [
            'notifications' => $identities,
            'read_count' => $readCount,
            'timestamp' => $now,
        ]))->broadcast();
    }

    public static function batchMarkAsRead(User $user, BatchIdentities $batchIdentities)
    {
        $ids = $batchIdentities->getNotificationIds();
        $identities = $batchIdentities->getIdentities();
        $now = now();

        if (empty($ids)) {
            return;
        } else if ($ids instanceof Builder) {
            $instance = new static();
            $tableName = $instance->getTable();
            // force mysql optimizer to optimize properly with a fake multi-table update
            // https://dev.mysql.com/doc/refman/8.0/en/subquery-optimization.html
            // FIXME: this is supposedly fixed by mysql 8.0.22
            $itemsQuery = $instance->getConnection()
                ->table(DB::raw("{$tableName}, (SELECT 1) dummy"))
                ->where('user_id', $user->getKey())
                ->where('is_read', false)
                ->whereIn('notification_id', $ids);
            // raw builder doesn't have model scope magic.
            $instance->scopeHasPushDelivery($itemsQuery);

            $count = $itemsQuery->update(['is_read' => true, 'updated_at' => $now]);
        } else {
            $count = $user
                ->userNotifications()
                ->hasPushDelivery()
                ->where('is_read', false)
                ->whereIn('notification_id', $ids)
                ->update(['is_read' => true, 'updated_at' => $now]);
        }

        if ($count > 0) {
            (new NotificationReadEvent($user->getKey(), ['notifications' => $identities, 'read_count' => $count, 'timestamp' => $now]))->broadcast();
        }
    }

    public static function deliveryMask(string $type): int
    {
        return 1 << self::DELIVERY_OFFSETS[$type];
    }

    public function isDelivery(string $type): bool
    {
        $mask = static::deliveryMask($type);

        return ($this->delivery & $mask) === $mask;
    }

    public function isMail(): bool
    {
        return $this->isDelivery('mail');
    }

    public function isPush(): bool
    {
        return $this->isDelivery('push');
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function scopeHasMailDelivery($query)
    {
        return $query->where('delivery', '&', static::deliveryMask('mail'));
    }

    public function scopeHasPushDelivery($query)
    {
        return $query->where('delivery', '&', static::deliveryMask('push'));
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
