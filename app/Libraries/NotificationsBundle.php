<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use App\Transformers\NotificationTransformer;
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

    private array $notificationIdsToFetch = [];
    private ?string $category;
    private array $countByType;
    private ?int $cursorId;
    private ?int $objectId;
    private ?string $objectType;
    private array $stacks = [];
    private array $types = [];
    private bool $unreadOnly;

    public function __construct(private User $user, array $request)
    {
        $this->unreadOnly = get_bool($request['unread'] ?? false);
        $this->cursorId = get_int($request['cursor']['id'] ?? null);

        $this->objectId = get_int($request['object_id'] ?? null);
        $this->objectType = presence($request['type'] ?? null) ?? presence($request['object_type'] ?? null);
        $this->category = presence($request['category'] ?? null);
    }

    public function toArray(): array
    {
        if ($this->objectId !== null && $this->objectType !== null && $this->category !== null) {
            $this->fillStacks($this->objectType, $this->objectId, $this->category);
        } else {
            $this->fillTypes($this->objectType);
        }

        $notifications = Notification::whereIn('id', $this->notificationIdsToFetch)->get();
        $response = [
            'notifications' => json_collection($notifications, new NotificationTransformer()),
            'stacks' => array_values($this->stacks),
            'timestamp' => json_time(now()),
            'types' => array_values($this->types),
        ];

        if ($this->unreadOnly) {
            $response['unread_count'] = $this->getTotalNotificationCount();
        }

        return $response;
    }

    /**
     * Note: Prefetch stack size if filling multiple stacks.
     */
    private function fillStacks(string $objectType, int $objectId, string $category, ?int $stackSize = null): void
    {
        $key = static::stackKey($objectType, $objectId, $category);
        // skip multiple notification names mapped to the same category.
        if (isset($this->stacks[$key])) {
            return;
        }

        $query = $this->user
            ->userNotifications()
            ->hasPushDelivery()
            ->where('notifiable_type', $objectType)
            ->where('notifiable_id', $objectId)
            ->where('category', $category);

        if ($this->unreadOnly) {
            $query->where('is_read', false);
        }

        // use pre-fetched value; otherwise get count before applying cursor.
        $total = $stackSize ?? $query->count();

        $query->orderBy('id', 'desc')->limit(static::PER_STACK_LIMIT);

        if ($this->cursorId !== null) {
            $query->where('notification_id', '<', $this->cursorId);
        }

        $notificationIds = $query->pluck('notification_id');
        $last = $notificationIds->last();
        if ($last === null) {
            return;
        }

        array_push($this->notificationIdsToFetch, ...$notificationIds);

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

    private function fillTypes(?string $type = null): void
    {
        $heads = $this->getStackHeads($type);

        $batches = [];
        $unionQuery = null;

        foreach ($heads as $head) {
            // everything less than the stack's pagination size can be batched together
            // since no pagination or ordering is required for them.
            $stackSize = $head->getRawAttribute('stack_size');
            if ($stackSize <= static::PER_STACK_LIMIT) {
                // collect notifiable_id together so they can be selected together instead of multiple unions.
                // This is more for reducing queries sent; unions are still considered multiple queries.
                $batchKey = "{$head->notifiable_type}-{$head->category}";
                $batches[$batchKey][] = $head->notifiable_id;

                $key = "{$head->notifiable_type}-{$head->notifiable_id}-{$head->category}";
                $this->stacks[$key] = [
                    'category' => $head->category,
                    'cursor' => null,
                    'object_type' => $head->notifiable_type,
                    'object_id' => $head->notifiable_id,
                    'total' => $stackSize,
                ];
            } else {
                // TODO: it's possible to union query these as well; it just looks really bad reading the query.
                $this->fillStacks($head->notifiable_type, $head->notifiable_id, $head->category, $stackSize);
            }
        }

        foreach ($batches as $batchKey => $notifiableIds) {
            [$notifiableType, $category] = explode('-', $batchKey, 2);
            $query = $this->user
                ->userNotifications()
                ->hasPushDelivery()
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
                $unionQuery->unionAll($query);
            }
        }

        if ($unionQuery !== null) {
            $notificationIds = $unionQuery->pluck('notification_id');
            array_push($this->notificationIdsToFetch, ...$notificationIds);
        }

        $last = $heads->last();
        $cursor = $last !== null ? ['id' => $last->getRawAttribute('max_id')] : null;
        $this->types[$type ?? ''] = [
            'cursor' => $cursor,
            'name' => $type,
            'total' => $this->getTotalNotificationCount($type),
        ];

        // when notifications for all types, fill in the cursor and totals for the other types.
        if ($type === null) {
            $this->fillTypesWhenNull($cursor);
        }
    }

    private function getTotalNotificationCount(?string $type = null): int
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
                ->mapWithKeys(fn ($agg) => [$agg->notifiable_type => $agg->getRawAttribute('type_count')])
                ->all();
        }

        return $type === null
            ? array_sum($this->countByType)
            : $this->countByType[$type] ?? 0;
    }

    /**
     * @return Collection<int, UserNotification>
     */
    private function getStackHeads(?string $type = null): Collection
    {
        $query = $this->user
            ->userNotifications()
            ->hasPushDelivery()
            ->groupBy('notifiable_type', 'notifiable_id', 'category')
            ->orderBy('max_id', 'DESC')
            ->select(DB::raw('MAX(notification_id) as max_id'), DB::raw('COUNT(*) as stack_size'), 'notifiable_type', 'notifiable_id', 'category');

        if ($this->unreadOnly) {
            $query->where('is_read', false);
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

    private function fillTypesWhenNull(?array $cursor): void
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
