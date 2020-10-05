<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Events\NotificationReadEvent;
use App\Exceptions\InvariantException;
use DB;

class UserNotification extends Model
{
    const DELIVERY_OFFSETS = [
        'push' => 0,
        'mail' => 1,
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public static function deliveryMask(string $type): int
    {
        return 1 << self::DELIVERY_OFFSETS[$type];
    }

    public static function markAsReadByIds(User $user, array $params)
    {
        $ids = [];
        $identities = array_map(function ($param) use (&$ids) {
            $identity = get_params($param, null, [
                'category',
                'id:int',
                'object_id:int',
                'object_type',
            ]);

            $ids[] = $identity['id'] ?? null;

            return $identity;
        }, $params);

        $now = now();
        $count = $user
            ->userNotifications()
            ->hasPushDelivery()
            ->where('is_read', false)
            ->whereIn('notification_id', $ids)
            ->update(['is_read' => true, 'updated_at' => $now]);

        if ($count > 0) {
            event(new NotificationReadEvent($user->getKey(), ['notifications' => $identities, 'read_count' => $count, 'timestamp' => $now]));
        }
    }

    public static function markAsReadByNotificationIdentifier(User $user, array $params)
    {
        $params = get_params($params, null, [
            'category',
            'object_id:int',
            'object_type',
        ]);

        $category = presence($params['category'] ?? null);
        $objectId = $params['object_id'] ?? null;
        $objectType = presence($params['object_type'] ?? null);

        $notifications = Notification::query();
        if ($objectType !== null) {
            $notifications->where('notifiable_type', $objectType);
        }

        if ($objectId !== null && $category !== null) {
            if ($objectType === null) {
                throw new InvariantException('object_type is required.');
            }

            $names = Notification::namesInCategory($category);
            $notifications
                ->where('notifiable_id', $objectId)
                ->whereIn('name', $names);
        }

        $instance = new static();
        $tableName = $instance->getTable();
        // force mysql optimizer to optimize properly with a fake multi-table update
        // https://dev.mysql.com/doc/refman/8.0/en/subquery-optimization.html
        $itemsQuery = $instance->getConnection()
            ->table(DB::raw("{$tableName}, (SELECT 1) dummy"))
            ->where('user_id', $user->getKey())
            ->where('is_read', false)
            ->whereIn('notification_id', $notifications->select('id'));
        // raw builder doesn't have model scope magic.
        $instance->scopeHasPushDelivery($itemsQuery);

        $now = now();
        $count = $itemsQuery->update(['is_read' => true, 'updated_at' => $now]);
        if ($count > 0) {
            event(new NotificationReadEvent($user->getKey(), ['notifications' => [$params], 'read_count' => $count, 'timestamp' => $now]));
        }
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
