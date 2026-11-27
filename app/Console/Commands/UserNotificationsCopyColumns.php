<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\UserNotification;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Console\Helper\ProgressBar;

class UserNotificationsCopyColumns extends Command
{
    protected $signature = 'user-notifications:copy-columns
        {--from= : Copy after (but not including) the specified id}
    ';

    protected $description = 'Copy notification grouping columns to user_notifications.';

    private ProgressBar $bar;

    public function handle()
    {
        $from = get_int($this->option('from')) ?? 0;
        $this->bar = $this->output->createProgressBar();
        $this->bar->setProgress($from);
        $max = UserNotification::max('id') ?? 0;

        UserNotification::withoutTimestamps(fn () => UserNotification
            ::where('id', '>', $from)
            ->where('id', '<=', $max)
            ->with('notification')
            ->chunkById(1000, function (Collection $userNotifications): void {
                \DB::transaction(function () use ($userNotifications) {
                    foreach ($userNotifications as $userNotification) {
                        $notification = $userNotification->notification;
                        $userNotification->update([
                            'category' => $notification->category,
                            'notifiable_id' => $notification->notifiable_id,
                            'notifiable_type' => $notification->notifiable_type,
                        ]);
                    }
                });
                $this->bar->setProgress($userNotifications->last()->getKey());
            }));

        $this->bar->finish();
    }
}
