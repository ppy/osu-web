<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Events\NotificationReadEvent;
use App\Exceptions\InvariantException;
use DB;

class UserNotification extends Model
{
    protected $casts = [
        'is_read' => 'boolean',
    ];

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

        $tableName = (new static)->getTable();

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

        // force mysql optimizer to optimize properly with a fake multi-table update
        // https://dev.mysql.com/doc/refman/8.0/en/subquery-optimization.html
        $itemsQuery = $user->getConnection()
            ->table(DB::raw("{$tableName}, (SELECT 1) dummy"))
            ->where('user_id', $user->getKey())
            ->where('is_read', false)
            ->whereIn('notification_id', $notifications->select('id'));

        $now = now();
        $count = $itemsQuery->update(['is_read' => true, 'updated_at' => $now]);
        if ($count > 0) {
            event(new NotificationReadEvent($user->getKey(), ['notifications' => [$params], 'read_count' => $count, 'timestamp' => $now]));
        }
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
