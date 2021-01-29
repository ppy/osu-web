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
            $this->fillStack($this->objectType, $this->objectId, $this->category);
        } else {
            $this->fillType($this->objectType);
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

    private function fillStack(string $objectType, int $objectId, string $category)
    {
        $key = "{$objectType}-{$objectId}-{$category}";

        $query = UserNotification::hasPushDelivery()
            ->where('user_id', $this->user->getKey())
            ->where('notifiable_type', $objectType)
            ->where('notifiable_id', $objectId)
            ->where('category', $category);

        if ($this->unreadOnly) {
            $query->where('is_read', false);
        }

        // get count before applying cursor.
        $total = $query->count();

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

        $this->stacks[$key] = [
            'category' => $category,
            'cursor' => $cursor,
            'object_type' => $objectType,
            'object_id' => $objectId,
            'total' => $total,
        ];
    }

    private function fillType(?string $type = null)
    {
        $heads = $this->getStackHeads($type);
        $batches = [];
        $unionQuery = null;

        foreach ($heads as $head) {
            // everything less than the stack's pagination size can be batched together
            // since no pagination or ordering is required for them.
            if ($head->stack_size <= static::PER_STACK_LIMIT) {
                // collect notifiable_id together so they can be selected together instead of multiple unions.
                // Unions are still run as seperate selects.
                $batchKey = "{$head->notifiable_type}-{$head->category}";
                $batches[$batchKey][] = $head->notifiable_id;

                $key = "{$head->notifiable_type}-{$head->notifiable_id}-{$head->category}";
                $this->stacks[$key] = [
                    'category' => $head->category,
                    'cursor' => null,
                    'object_type' => $head->notifiable_type,
                    'object_id' => $head->notifiable_id,
                    'total' => $head->stack_size,
                ];
            } else {
                // TODO: it's possible to union query these as well; it just looks really bad reading the query.
                $this->fillStack($head->notifiable_type, $head->notifiable_id, $head->category);
            }
        }

        foreach ($batches as $batchKey => $notifiableIds) {
            [$notifiableType, $category] = explode('-', $batchKey, 2);
            $query = UserNotification::where('user_id', $this->user->getKey())
                ->where('notifiable_type', $notifiableType)
                ->whereIn('notifiable_id', $notifiableIds)
                ->where('category', $category)
                ->select('notification_id');

            if ($this->unreadOnly) {
                $query->where('is_read', false);
            }

            if ($unionQuery === null) {
                $unionQuery = $query;
            } else {
                $unionQuery->union($query);
            }
        }

        if ($unionQuery !== null) {
            $notificationIds = $unionQuery->pluck('notification_id');
            $this->notificationIdsToFetch = $this->notificationIdsToFetch->merge($notificationIds);
        }

        $last = $heads->last();
        $cursor = $last !== null ? ['id' => $last->max_id] : null;
        $this->types[$type] = [
            'cursor' => $cursor,
            'name' => $type,
            'total' => $this->getTotalNotificationCount($type),
        ];

        // when notifications for all types, fill in the cursor and totals for the other types.
        if ($type === null) {
            $this->fillTypeWhenNull($cursor);
        }
    }

    private function getTotalNotificationCount(?string $type = null)
    {
        $query = UserNotification::hasPushDelivery()->where('user_id', $this->user->getKey());
        if ($this->unreadOnly) {
            $query->where('is_read', false);
        }

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
            ->select(DB::raw('MAX(notification_id) as max_id'), DB::raw('COUNT(*) as stack_size'), 'notifiable_type', 'notifiable_id', 'category');

        if ($this->unreadOnly) {
            $query->where('is_read', false)->groupBy('is_read');
        }

        if ($type !== null) {
            $query->where('notifiable_type', $type);
        }

        // TODO: ignore cursor if params don't match
        if ($this->cursorId !== null) {
            $query->having('max_id', '<', $this->cursorId);
        }

        return $query->limit(static::STACK_LIMIT)->get();
    }

    private function fillTypeWhenNull($cursor)
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
}
