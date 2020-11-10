<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Libraries\Notification\BatchIdentities;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Console\Command;

/**
 * Removes expired tokens and auth codes from the OAuth tables.
 * It uses chunkById which is much slower than a straight batch delete, but doesn't lock the entire table while deleting.
 */
class UserNotificationsCleanup extends Command
{
    protected $signature = 'user-notifications:cleanup';

    protected $description = 'Deletes old user notifications';

    public function handle()
    {
        $total = config('osu.notification.cleanup.max_delete_per_run');
        $perLoop = 10000;
        $loops = $total / $perLoop;

        $createdBefore = now()->subDays(config('osu.notification.cleanup.keep_days'));
        $this->line("Deleting before {$createdBefore}");

        $progress = $this->output->createProgressBar($total);
        $deletedTotal = 0;

        for ($i = 0; $i < $loops; $i++) {
            $userNotifications = UserNotification
                ::where('created_at', '<', $createdBefore)
                ->with('notification')
                ->orderBy('id', 'ASC')
                ->limit($perLoop)
                ->get();

            $notificationIdByUserIds = [];

            foreach ($userNotifications as $n) {
                $notificationIdByUserIds[$n->user_id][] = $n->notification->toIdentityJson();
            }

            foreach ($notificationIdByUserIds as $userId => $notificationIds) {
                UserNotification::batchDestroy(
                    User::find($userId),
                    BatchIdentities::fromParams(['notifications' => $notificationIds])
                );
                $deleted = count($notificationIds);
                $deletedTotal += $deleted;
                $progress->advance($deleted);
            }

            if (count($userNotifications) < $perLoop) {
                break;
            }
        }

        $progress->finish();
        $this->line('');
        $this->line("Deleted {$deletedTotal} old user notifications.");
    }
}
