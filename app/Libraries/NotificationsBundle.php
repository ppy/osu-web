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

namespace App\Libraries;

use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use DB;

class NotificationsBundle
{
    const PER_STACK_LIMIT = 50;
    const STACK_LIMIT = 50;

    private $category;
    private $cursorId;
    private $notifications;
    private $objectId;
    private $objectType;
    private $stacks = [];
    private $types = [];
    private $unreadOnly;
    private $user;

    public function __construct(User $user, array $request)
    {
        $this->user = $user;
        $this->notifications = collect();
        $this->unreadOnly = get_bool($request['unread'] ?? false);
        $this->cursorId = get_int($request['cursor']['id'] ?? null);

        $this->objectId = get_int($request['object_id'] ?? null);
        $this->objectType = presence($request['type'] ?? null) ?? presence($request['object_type'] ?? null);
        $this->category = presence($request['category'] ?? null);
    }

    public function toArray()
    {
        if ($this->objectId && $this->objectType && $this->category) {
            $this->fillStacks($this->objectType, $this->objectId, $this->category);
        } else {
            $this->fillTypes($this->objectType);
        }

        $response = [
            'notifications' => json_collection($this->notifications, 'Notification'),
            'stacks' => array_values($this->stacks),
            'types' => array_values($this->types),
        ];

        if ($this->unreadOnly) {
            $response['unread_count'] = $this->user->userNotifications()->where('is_read', false)->count();
        }

        return $response;
    }

    private function fillStacks(string $objectType, int $objectId, string $category)
    {
        $key = "{$objectType}-{$objectId}-{$category}";
        // skip multiple notification names mapped to the same category.
        if (isset($this->stacks[$key])) {
            return;
        }

        $query = $this->user->userNotifications()->with('notification')->whereHas('notification', function ($q) use ($objectId, $objectType, $category) {
            $names = Notification::namesInCategory($category);
            $q
                ->where('notifiable_type', $objectType)
                ->where('notifiable_id', $objectId)
                ->whereIn('name', $names);
        });

        if ($this->unreadOnly) {
            $query->where('is_read', false);
        }

        $total = $query->count();

        $query->orderBy('id', 'desc')->limit(static::PER_STACK_LIMIT);

        if ($this->cursorId !== null) {
            $query->where('notification_id', '<', $this->cursorId);
        }

        $stack = $query->get();

        $json = $this->stackToJson($stack);
        if ($json !== null) {
            $json['total'] = $total;
            $this->stacks[$key] = $json;
            $this->notifications = $this->notifications->merge($stack);
        }
    }

    private function fillTypes(?string $type = null)
    {
        $heads = $this->getStackHeads($type);

        $heads->each(function ($row) {
            $category = Notification::nameToCategory($row->name);
            $this->fillStacks($row->notifiable_type, $row->notifiable_id, $category);
        });

        $last = $heads->last();
        $cursor = $last !== null ? ['id' => $last->max_id] : null;
        $this->types[$type] = [
            'cursor' => $cursor,
            'name' => $type,
            'total' => $this->getTotalNotificationCount($type),
        ];

        // when notifications for all types, fill in the cursor and totals for the other types.
        if ($type === null) {
            $this->fillTypesWhenNull($cursor);
        }
    }

    private function getTotalNotificationCount(?string $type = null)
    {
        $query = Notification::whereHas('userNotifications', function ($q) {
            $q->where('user_id', $this->user->getKey());
            if ($this->unreadOnly) {
                $q->where('is_read', false);
            }
        });

        if ($type !== null) {
            $query->where('notifiable_type', $type);
        }

        return $query->count();
    }

    private function getStackHeads(?string $type = null)
    {
        $heads = Notification::whereHas('userNotifications', function ($q) {
            $q->where('user_id', $this->user->getKey());
            if ($this->unreadOnly) {
                $q->where('is_read', false);
            }
        })
        ->groupBy('name', 'notifiable_type', 'notifiable_id')
        ->orderBy('max_id', 'DESC')
        ->select(DB::raw('MAX(id) as max_id'), 'name', 'notifiable_type', 'notifiable_id');

        if ($type !== null) {
            $heads->where('notifiable_type', $type);
        }

        // TODO: ignore cursor if params don't match
        if ($this->cursorId !== null) {
            $heads->having('max_id', '<', $this->cursorId);
        }

        return $heads->limit(static::STACK_LIMIT)->get();
    }

    private function fillTypesWhenNull($cursor)
    {
        foreach (Notification::NOTIFIABLE_CLASSES as $class) {
            $type = MorphMap::getType($class);
            $cursor['type'] = $type;

            $this->types[$type] = [
                'cursor' => $cursor,
                'name' => $type,
                'total' => $this->getTotalNotificationCount($type),
            ];
        }
    }

    private function stackToJson($stack)
    {
        $last = $stack->last();
        if ($last === null) {
            return;
        }

        $last = $last instanceof UserNotification ? $last->notification : $last;
        $cursor = $stack->count() < static::PER_STACK_LIMIT ? null : [
            'id' => $last->id,
        ];

        return [
            'category' => Notification::nameToCategory($last->name),
            'cursor' => $cursor,
            'name' => $last->name,
            'object_type' => $last->notifiable_type,
            'object_id' => $last->notifiable_id,
        ];
    }
}
