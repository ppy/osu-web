<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Libraries\Notification\BatchIdentities;
use App\Models\User;
use App\Models\UserNotification;
use Datadog;
use Illuminate\Console\Command;

class UserNotificationsCleanup extends Command
{
    protected $signature = 'user-notifications:cleanup';

    protected $description = 'Deletes old user notifications';

    public function handle()
    {
        $total = config('osu.notification.cleanup.max_delete_per_run');

        if ($total === 0) {
            return;
        }

        $perLoop = min($total, 10000);
        $loops = $total / $perLoop;

        $createdBefore = now()->subDays(config('osu.notification.cleanup.keep_days'));
        $this->line("Deleting user notifications before {$createdBefore}");

        $progress = $this->output->createProgressBar($total);
        $deletedTotal = 0;

        for ($i = 0; $i < $loops; $i++) {
            $userNotifications = UserNotification
                ::with('notification')
                ->orderBy('id', 'ASC')
                ->limit($perLoop)
                ->get();

            $notificationIdByUserIds = [];
            $pastKeepDays = false;

            foreach ($userNotifications as $n) {
                if ($n->created_at > $createdBefore) {
                    $pastKeepDays = true;
                    break;
                }

                $notificationIdByUserIds[$n->user_id][] = $n->notification->toIdentityJson();
            }

            foreach ($notificationIdByUserIds as $userId => $notificationIds) {
                UserNotification::batchDestroy(
                    User::find($userId),
                    BatchIdentities::fromParams(['notifications' => $notificationIds])
                );
                $deleted = count($notificationIds);
                $deletedTotal += $deleted;
                Datadog::increment(config('datadog-helper.prefix_web').'.notifications_cleanup.user_notifications', 1, null, $deleted);
                $progress->advance($deleted);
            }

            if ($pastKeepDays || count($userNotifications) < $perLoop) {
                break;
            }
        }

        $progress->finish();
        $this->line('');
        $this->line("Deleted {$deletedTotal} user notifications.");
    }
}
