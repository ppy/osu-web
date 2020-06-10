<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Mail\UserNewNotifications;
use App\Models\Count;
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
    protected $signature = 'notifications:send-mail';

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
        $fromId = Count::lastMailNotificationIdSent();
        // TODO: need deterministic endpoint as well for consistency.

        $users = User::whereIn('user_id', UserNotification::where('notification_id', '>', $fromId)->groupBy('user_id')->select('user_id'))->get();

        $users->each(function ($user) use ($fromId) {
            // TODO: catch and log errors
            Mail::to($user)->queue(new UserNewNotifications($user, $fromId));
        });
    }
}
