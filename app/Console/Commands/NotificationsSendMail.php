<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Mail\UserNotificationDigest;
use App\Models\Count;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Console\Command;
use Mail;

class NotificationsSendMail extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'notifications:send-mail {--from=} {--to=}';

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

        if ($toId === null) {
            $this->warn('No notifications to send!');

            return;
        }

        $this->line("Sending notifications > {$fromId} <= {$toId}");

        $users = User::whereIn(
            'user_id',
            UserNotification::where('notification_id', '>', $fromId)->groupBy('user_id')->select('user_id')
        )->get();

        foreach ($users as $user) {
            // TODO: catch and log errors
            Mail::to($user)->queue(new UserNotificationDigest($user, $fromId, $toId));
        }

        $lastIdRow->count = $toId;
        $lastIdRow->save();
    }
}
