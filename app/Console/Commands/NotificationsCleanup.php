<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\UserNotification;
use Datadog;
use Illuminate\Console\Command;

class NotificationsCleanup extends Command
{
    const MAX_PER_LOOP = 1000;
    const NOTIFICATION_ID_BUFFER = 1000;

    protected $signature = 'notifications:cleanup';

    protected $description = 'Deletes old notifications';

    public function handle()
    {
        $total = config('osu.notification.cleanup.max_delete_per_run');

        if ($total === 0) {
            return;
        }

        $perLoop = min($total, static::MAX_PER_LOOP);
        $loops = $total / $perLoop;

        $maxNotificationId = optional(UserNotification::orderBy('id', 'ASC')->first())->notification_id;

        if ($maxNotificationId === null || $maxNotificationId < static::NOTIFICATION_ID_BUFFER) {
            $this->line('No notifications to delete');

            return;
        }

        $maxNotificationId -= static::NOTIFICATION_ID_BUFFER;

        $this->line("Deleting notifications up to {$maxNotificationId}");

        $deletedTotal = 0;

        for ($i = 0; $i < $loops; $i++) {
            $deleted = Notification::where('id', '<', $maxNotificationId)->limit($perLoop)->delete();
            Datadog::increment(config('datadog-helper.prefix_web').'.notifications_cleanup.notifications', 1, null, $deleted);

            $deletedTotal += $deleted;
        }

        $this->line("Deleted {$deletedTotal} notifications.");
    }
}
