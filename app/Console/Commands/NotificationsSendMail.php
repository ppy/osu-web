<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Jobs\UserNotificationDigest;
use App\Models\Count;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Console\Command;

class NotificationsSendMail extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'notifications:send-mail {--chunk-size=} {--from=} {--to=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail notifications';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lastIdRow = Count::lastMailNotificationIdSent();

        $fromId = get_int($this->option('from')) ?? $lastIdRow->count;
        $toId = get_int($this->option('to')) ?? optional(Notification::last())->getKey();

        $chunkSize = get_int($this->option('chunk-size')) ?? 100;

        if ($toId === null) {
            $this->warn('No notifications to send!');

            return;
        }

        $this->line("Sending notifications > {$fromId} <= {$toId}");

        // TODO: this query needs more investigation with larger dataset
        // on whether an index over (notification_id, delivery) would actually be useful;
        // currently getting inconsistent results...
        $userIds = UserNotification
            ::where('notification_id', '>', $fromId)
            ->where('notification_id', '<=', $toId)
            ->groupBy('user_id')
            ->pluck('user_id');

        foreach ($userIds->chunk($chunkSize) as $chunk) {
            $users = User::whereIn('user_id', $chunk)->get();
            foreach ($users as $user) {
                dispatch(new UserNotificationDigest($user, $fromId, $toId));
            }
        }

        if ($toId > $lastIdRow->count) {
            $lastIdRow->count = $toId;
            $lastIdRow->save();
        }
    }
}
