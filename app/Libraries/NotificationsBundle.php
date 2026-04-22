<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use DB;
use Illuminate\Database\Eloquent\Collection;

class NotificationsBundle
{
    const PER_STACK_LIMIT = 50;
    const STACK_LIMIT = 50;

    private static function stackKey(string $objectType, int $objectId, string $category): string
    {
        return "{$objectType}-{$objectId}-{$category}";
    }

    private $category;
    private array $countByType;
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
            $this->fillAllStacks([[$this->objectType, $this->objectId, $this->category]]);
        } else {
            $this->fillTypes($this->objectType);
        }

        $this->fillStackTotal();

        $response = [
            'notifications' => json_collection($this->userNotifications->load('notification'), 'Notification'),
            'stacks' => array_values($this->stacks),
            'timestamp' => json_time(now()),
            'types' => array_values($this->types),
        ];

        if ($this->unreadOnly) {
            $response['unread_count'] = $this->getTotalNotificationCount();
        }

        return $response;
    }

    private function fillAllStacks(array $stacks): void
    {
        foreach ($stacks as $stack) {
            foreach (Notification::namesInCategory($stack[2]) as $name) {
                $bindValues[] = $stack[0];
                $bindValues[] = $stack[1];
                $bindValues[] = $name;
                $binds[] = '(?, ?, ?)';
            }
        }
        $bindsString = implode(',', $binds);
        $cursorString = $this->cursorId === null ? '' : "AND un.notification_id < {$this->cursorId}";
        $unreadString = $this->unreadOnly ? 'AND un.is_read = 0' : '';
        $limit = static::PER_STACK_LIMIT;
        $notifications = Notification::selectRaw(
            "JSON_ARRAY((
                SELECT un.id
                FROM user_notifications un
                WHERE
                    un.notification_id = notifications.id
                    AND un.user_id = {$this->user->getKey()}
                    AND un.delivery & 1
                    {$unreadString}
                    {$cursorString}
                ORDER BY un.notification_id DESC
                LIMIT {$limit}
            )) user_notification_ids",
        )->whereRaw("(notifiable_type, notifiable_id, name) IN ({$bindsString})", $bindValues)->get();

        $userNotificationIds = [];
        foreach ($notifications as $notification) {
            $userNotificationIds = [
                ...$userNotificationIds,
                ...array_reject_null(json_decode($notification->getRawAttribute('user_notification_ids'), true)),
            ];
        }

        $userNotifications = UserNotification
            ::with('notification')
            ->whereIn('id', $userNotificationIds)
            ->orderByDesc('notification_id')
            ->orderByDesc('id')
            ->get();

        foreach ($userNotifications as $userNotification) {
            $notification = $userNotification->notification;

            $objectType = $notification->notifiable_type;
            $objectId = $notification->notifiable_id;
            $category = $notification->category;

            $groupedStacks[$objectType][$objectId][$category][] = $userNotification;
            $this->userNotifications->push($userNotification);
        }
        foreach ($groupedStacks as $objectType => $stacksByObjectId) {
            foreach ($stacksByObjectId as $objectId => $stacksByCategory) {
                foreach ($stacksByCategory as $category => $stack) {
                    $key = static::stackKey($objectType, $objectId, $category);
                    $this->stacks[$key] = $this->stackToJson($stack, $objectType, $objectId, $category);
                }
            }
        }
    }

    private function fillStackTotal(): void
    {
        if (empty($this->stacks)) {
            return;
        }

        $binds = [];
        $bindValues = [];
        foreach ($this->stacks as $key => $stackJson) {
            foreach (Notification::namesInCategory($stackJson['category']) as $name) {
                $bindValues[] = $stackJson['object_type'];
                $bindValues[] = $stackJson['object_id'];
                $bindValues[] = $name;
                $binds[] = '(?, ?, ?)';
            }
        }

        $notificationModel = new Notification();
        $userNotificationModel = new UserNotification();

        $groupColumns = [
            'type' => $notificationModel->qualifyColumn('notifiable_type'),
            'id' => $notificationModel->qualifyColumn('notifiable_id'),
            'name' => $notificationModel->qualifyColumn('name'),
        ];

        $bindsString = implode(', ', $binds);
        $whereString = "({$groupColumns['type']}, {$groupColumns['id']}, {$groupColumns['name']}) IN ({$bindsString})";

        $query = $this
            ->user
            ->userNotifications()
            ->hasPushDelivery()
            ->join(
                $notificationModel->getTable(),
                $notificationModel->qualifyColumn('id'),
                '=',
                $userNotificationModel->qualifyColumn('notification_id')
            )
            ->selectRaw("
                COUNT(*) as count,
                {$groupColumns['type']},
                {$groupColumns['id']},
                {$groupColumns['name']}")
            ->whereRaw($whereString, $bindValues)
            ->groupBy(array_values($groupColumns));

        if ($this->unreadOnly) {
            $query->where('is_read', false);
        }

        foreach ($query->get() as $row) {
            $name = $row->getRawAttribute('name');
            $category = Notification::NAME_TO_CATEGORY[$name] ?? $name;
            $key = static::stackKey($row->getRawAttribute('notifiable_type'), $row->getRawAttribute('notifiable_id'), $category);
            $this->stacks[$key]['total'] ??= 0;
            $this->stacks[$key]['total'] += $row->getRawAttribute('count');
        }
    }

    private function fillTypes(?string $type = null)
    {
        $heads = $this->getStackHeads($type);

        $allStacks = [];
        foreach ($heads as $head) {
            $allStacks[] = [
                $head->notifiable_type,
                $head->notifiable_id,
                $head->category,
            ];
        }
        $this->fillAllStacks($allStacks);

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
        if (!isset($this->countByType)) {
            $query = Notification ::whereHas('userNotifications', function ($q) {
                $q->hasPushDelivery()->where('user_id', $this->user->getKey());
                if ($this->unreadOnly) {
                    $q->where('is_read', false);
                }
            });

            if ($this->objectType !== null) {
                $query->where('notifiable_type', $this->objectType);
            }

            $this->countByType = $query
                ->groupBy('notifiable_type')
                ->selectRaw('count(*) type_count, notifiable_type')
                ->get()
                ->mapWithKeys(fn ($agg) => [$agg->notifiable_type => $agg->type_count])
                ->all();
        }

        return $type === null
            ? array_sum($this->countByType)
            : $this->countByType[$type] ?? 0;
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

    private function stackToJson(array $stack, string $objectType, int $objectId, string $category)
    {
        $last = $stack[array_key_last($stack)];
        if ($last === null) {
            return;
        }

        $cursor = count($stack) < static::PER_STACK_LIMIT ? null : [
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
