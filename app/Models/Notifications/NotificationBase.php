<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Notifications;

use App\Models\User;
use App\Models\UserNotificationOption;

abstract class NotificationBase
{
    const CONTENT_TRUNCATE = 36;

    protected $notifiable;
    protected $object;
    protected $source;

    public static function filterUserIdsForNotificationOption(array $userIds, $optionName)
    {
        // FIXME: filtering all the ids could get quite large?
        $notificationOptions = UserNotificationOption
            ::whereIn('user_id', $userIds)
            ->where(['name' => $optionName])
            ->whereNotNull('details')
            ->get()
            ->keyBy('user_id');

        $filteredUserIds = [];
        foreach ($userIds as $userId) {
            if ($notificationOptions[$userId]->details['push'] ?? true) {
                $filteredUserIds[] = $userId;
            }
        }

        return $filteredUserIds;
    }

    public static function notificationClassFor(string $name)
    {
        return camel_case($name);
    }

    public function __construct($object, ?User $source)
    {
        $this->object = $object;
        $this->source = $source;
    }

    abstract function getDetails(): array;

    abstract function getReceiverIds(): array;

    public function getNotifiable()
    {
        return $this->notifiable ?? $this->object;
    }

    public function getSource(): ?User
    {
        return $this->source;
    }
}
