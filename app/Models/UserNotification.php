<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models;

use App\Events\NotificationReadEvent;
use App\Exceptions\InvariantException;
use DB;

class UserNotification extends Model
{
    protected $casts = [
        'is_read' => 'boolean',
    ];

    public static function markAsReadByIds(User $user, $identities)
    {
        // TODO: validate schema
        $ids = collect($identities)->pluck('id');

        $count = $user
            ->userNotifications()
            ->where('is_read', false)
            ->whereIn('notification_id', $ids)
            ->update(['is_read' => true]);

        if ($count > 0) {
            event(new NotificationReadEvent($user->getKey(), ['notifications' => $identities, 'read_count' => $count]));
        }
    }

    public static function markAsReadByNotificationIdentifier(User $user, $params)
    {
        $category = presence($params['category'] ?? null);
        $objectId = $params['object_id'] ?? null;
        $objectType = presence($params['object_type'] ?? null);

        if ($objectType === null) {
            throw new InvariantException('object_type is required.');
        }

        $tableName = (new static)->getTable();
        $notifications = Notification::where('notifiable_type', $objectType);
        if ($objectId !== null && $category !== null) {
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

        $count = $itemsQuery->update(['is_read' => true]);
        if ($count > 0) {
            event(new NotificationReadEvent($user->getKey(), ['notifications' => [$params], 'read_count' => $count]));
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
