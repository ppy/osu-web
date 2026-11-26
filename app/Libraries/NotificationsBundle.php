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
            $this->fillStack($this->objectType, $this->objectId, $this->category);
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
    private function fillStack(string $objectType, int $objectId, string $category): void
    {
        $key = static::stackKey($objectType, $objectId, $category);

        $query = $this->user
            ->userNotifications()
            ->hasPushDelivery()
            ->where('notifiable_type', $objectType)
            ->where('notifiable_id', $objectId)
            ->where('category', $category);

        if ($this->unreadOnly) {
            $query->where('is_read', false);
        }

        // get count before applying cursor.
        $total = $query->count();

        $query->orderBy('notification_id', 'desc')->limit(static::PER_STACK_LIMIT);

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

        foreach ($heads as $head) {
            $rawStr = $head->getRawAttribute('notification_ids');
            $notificationIds = explode(',', $rawStr, static::PER_STACK_LIMIT + 1);
            // last value might be truncated, so discard it. The extra item in the explode limit ensures we can blindly discard the last element.
            if (strlen($rawStr) >= 1024) {
                array_pop($notificationIds);
            }
            // handle the case if group_concat didn't get truncated but we still have more than the stack limit.
            if (count($notificationIds) > 50) {
                array_pop($notificationIds);
            }

            array_push($this->notificationIdsToFetch, ...array_map('intval', $notificationIds));

            $key = "{$head->notifiable_type}-{$head->notifiable_id}-{$head->category}";
            $stackSize = $head->getRawAttribute('stack_size');
            $this->stacks[$key] = [
                'category' => $head->category,
                'cursor' => $stackSize > static::PER_STACK_LIMIT ? ['id' => end($notificationIds)] : null,
                'object_type' => $head->notifiable_type,
                'object_id' => $head->notifiable_id,
                'total' => $stackSize,
            ];
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
            ->orderByDesc('max_id')
            ->select(
                DB::raw('MAX(notification_id) AS max_id'),
                DB::raw("SUBSTRING_INDEX(GROUP_CONCAT(notification_id ORDER BY notification_id DESC), ',', 50) AS notification_ids"),
                DB::raw('COUNT(*) AS stack_size'),
                'notifiable_type',
                'notifiable_id',
                'category',
            );

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
