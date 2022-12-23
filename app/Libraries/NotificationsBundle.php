<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Notification;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Collection;

class NotificationsBundle
{
    const PER_STACK_LIMIT = 50;
    const STACK_LIMIT = 50;

    private $category;
    private $cursorId;
    private $objectId;
    private $objectType;
    private $stacks = [];
    private $types = [];
    private $unreadOnly;
    private $user;
    private Collection $userNotifications;

    public function __construct(User $user, array $request)
    {
        $this->user = $user;
        $this->userNotifications = new Collection();
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
            'notifications' => json_collection($this->userNotifications->load('notification'), 'Notification'),
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

        $query = $this->user->userNotifications()->hasPushDelivery()->whereHas('notification', function ($q) use ($objectId, $objectType, $category) {
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

        $json = $this->stackToJson($stack, $objectType, $objectId, $category);
        if ($json !== null) {
            $json['total'] = $total;
            $this->stacks[$key] = $json;
            $this->userNotifications = $this->userNotifications->merge($stack);
        }
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
        $heads = Notification::whereHas('userNotifications', function ($q) {
            $q->hasPushDelivery()->where('user_id', $this->user->getKey());
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

    private function stackToJson($stack, string $objectType, int $objectId, string $category)
    {
        $last = $stack->last();
        if ($last === null) {
            return;
        }

        $cursor = $stack->count() < static::PER_STACK_LIMIT ? null : [
            'id' => $last->notification_id,
        ];

        return [
            'category' => $category,
            'cursor' => $cursor,
            // TODO: deprecated. Actual value isn't used by osu-web and it's
            // expensive to obtain at the point this function is called.
            // Remove when not used by anything else.
            'name' => Notification::namesInCategory($category)[0],
            'object_type' => $objectType,
            'object_id' => $objectId,
        ];
    }
}
