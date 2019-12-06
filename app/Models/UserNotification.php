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

class UserNotification extends Model
{
    protected $casts = [
        'is_read' => 'boolean',
    ];

    public static function markAsReadByIds(User $user, $ids)
    {
        if ($user->userNotifications()->whereIn('notification_id', $ids)->update(['is_read' => true])) {
            event(new NotificationReadEvent($user->getKey(), $ids));
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

        $itemsQuery = $user
            ->userNotifications()
            ->where('is_read', false)
            ->whereHas('notification', function ($query) use ($category, $objectId, $objectType) {
                $query->where('notifiable_type', $objectType);

                if ($objectId !== null && $category !== null) {
                    $names = Notification::namesInCategory($category);
                    $query
                        ->where('notifiable_id', $objectId)
                        ->whereIn('name', $names);
                }
            }
        );

        $count = $itemsQuery->update(['is_read' => true]);
        if ($count > 0) {
            event(new NotificationReadEvent($user->getKey(), null, ['notification' => $params, 'read_count' => $count]));
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
