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

namespace App\Transformers;

use App\Models\Notification;
use App\Models\UserNotification;
use League\Fractal;

class NotificationTransformer extends Fractal\TransformerAbstract
{
    public function transform($object)
    {
        if ($object instanceof UserNotification) {
            $notification = $object->notification;
            $isRead = $object->is_read;
        } elseif ($object instanceof Notification) {
            $notification = $object;
            $isRead = false;
        } // otherwise just explode from accessing null

        return [
            'id' => $notification->getKey(),
            'name' => $notification->name,
            'created_at' => json_time($notification->created_at),
            'object_type' => $notification->notifiable_type,
            'object_id' => $notification->notifiable_id,
            'source_user_id' => $notification->source_user_id,
            'is_read' => $isRead,
            'details' => $notification->details,
        ];
    }
}
