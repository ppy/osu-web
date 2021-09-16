<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\Count;
//use App\Models\UserNotification;
use Illuminate\Database\Migrations\Migration;

class SetLastMailNotificationIdSent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 2021-01-25: The method has been removed
        //$userNotification = UserNotification::where('is_read', false)->hasMailDelivery()->first();
        //if ($userNotification) {
        //    $last = Count::lastMailNotificationIdSent();
        //    $last->count = $userNotification->notification_id;
        //    $last->save();
        //}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Count::where('name', 'last_mail_notification_id_sent')->delete();
    }
}
