<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
    private $notificationIdsToFetch;
    private $objectId;
    private $objectType;
    private $stacks = [];
    private $types = [];
    private $unreadOnly;
    private $user;



    public function __construct(User $user, array $request)
    {
        $this->user = $user;
        $this->notificationIdsToFetch = collect();
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

        $notifications = Notification::whereIn('id', $this->notificationIdsToFetch)->get();

        $response = [
            'notifications' => json_collection($notifications, 'Notification'),
            'stacks' => array_values($this->stacks),
            'timestamp' => json_time(now()),
            'types' => array_values($this->types),
        ];

        if ($this->unreadOnly) {
            $response['unread_count'] = $this->user->userNotifications()->hasPushDelivery()->where('is_read', false)->count();
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

        $query = UserNotification::hasPushDelivery()
            ->where('user_id', $this->user->getKey())
            ->where('notifiable_type', $objectType)
            ->where('notifiable_id', $objectId)
            ->where('category', $category);

        if ($this->unreadOnly) {
            $query->where('is_read', false);
        }

        $query->orderBy('id', 'desc')->limit(static::PER_STACK_LIMIT);

        if ($this->cursorId !== null) {
            $query->where('notification_id', '<', $this->cursorId);
        }

        $notificationIds = $query->pluck('notification_id');
        $last = $notificationIds->last();
        if ($last === null) {
            return;
        }

        $this->notificationIdsToFetch = $this->notificationIdsToFetch->merge($notificationIds);

        $cursor = $notificationIds->count() < static::PER_STACK_LIMIT ? null : [
            'id' => $last,
        ];

        $json = [
            'category' => $category,
            'cursor' => $cursor,
            'object_type' => $objectType,
            'object_id' => $objectId,
        ];

        $total = $query->count();
        $json['total'] = $total;
        $this->stacks[$key] = $json;
    }

    private function fillTypes(?string $type = null)
    {
        $heads = $this->getStackHeads($type);

        $heads->each(function ($row) {
            $this->fillStacks($row->notifiable_type, $row->notifiable_id, $row->category);
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
            $q->hasPushDelivery()->where('user_id', $this->user->getKey());
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
        $query = $this->user
            ->userNotifications()
            ->hasPushDelivery()
            // need to group by all the where conditions for mysql to consider using the index;
            // for smaller sets, the analyzer may use a different index.
            // TODO: add migrations
            ->groupBy('notifiable_type', 'notifiable_id', 'category', 'user_id', 'delivery')
            ->orderBy('max_id', 'DESC')
            ->select(DB::raw('MAX(notification_id) as max_id'));

        if ($this->unreadOnly) {
            $query->where('is_read', false)->groupBy('is_read');
        }

        // TODO: ignore cursor if params don't match
        if ($this->cursorId !== null) {
            $query->having('max_id', '<', $this->cursorId);
        }

        // Mysql doesn't support subquery with order by, so we have to fetch first.
        $notificationIds = $query->limit(static::STACK_LIMIT)->get();

        return Notification::whereIn('id', $notificationIds)->select('id', 'notifiable_type', 'notifiable_id', 'name')->get();
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
            'category' => $last->category,
            'cursor' => $cursor,
            'name' => $last->name,
            'object_type' => $last->notifiable_type,
            'object_id' => $last->notifiable_id,
        ];
    }
}
