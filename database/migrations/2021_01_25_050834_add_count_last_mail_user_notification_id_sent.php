<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\Count;
use App\Models\UserNotification;
use Illuminate\Database\Migrations\Migration;

class AddCountLastMailUserNotificationIdSent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $lastNotificationIdSent = Count::where('name', 'last_mail_notification_id_sent')->first();

        if ($lastNotificationIdSent !== null) {
            $lastNotificationId = $lastNotificationIdSent->count;

            // prevent existing job from sending more digests
            $lastNotificationIdSent->update(['count' => PHP_INT_MAX]);

            $currentMaxId = UserNotification::max('id');

            $lastUserNotificationId = UserNotification
                ::where('notification_id', '<=', $lastNotificationId)
                ->where('id', '>', max($currentMaxId - 1000000, 1))
                ->max('id');

            if ($lastUserNotificationId !== null) {
                Count::updateOrCreate(
                    ['name' => 'last_mail_user_notification_id_sent'],
                    ['count' => $lastUserNotificationId]
                );
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $lastUserNotificationIdSent = Count::where('name', 'last_mail_user_notification_id_sent')->first();

        if ($lastUserNotificationIdSent !== null) {
            $lastUserNotification = UserNotification::find($lastUserNotificationIdSent->count);

            if ($lastUserNotification !== null) {
                Count::where('name', 'last_mail_user_notification_id_sent')->delete();
                Count::updateOrCreate(
                    ['name' => 'last_mail_notification_id_sent'],
                    ['count' => $lastUserNotification->notification_id]
                );
            }
        }
    }
}
