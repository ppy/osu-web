<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Notification;
use App\Models\UserNotification;

class NotificationTransformer extends TransformerAbstract
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
