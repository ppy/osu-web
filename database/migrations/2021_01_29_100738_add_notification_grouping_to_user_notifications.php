<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\Notification;
use App\Models\UserNotification;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationGroupingToUserNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->string('notifiable_type', 255)->nullable();
            $table->unsignedBigInteger('notifiable_id')->nullable();
            $table->string('category', 255)->nullable();
            $table->index(['user_id', 'notifiable_type', 'notifiable_id', 'category'], 'user_notification_group_lookup');
        });

        // duplicate grouping; temporary assign name to category.
        DB::statement('UPDATE user_notifications u JOIN notifications n on n.id = u.notification_id set u.notifiable_type = n.notifiable_type, u.notifiable_id = n.notifiable_id, u.category = n.name');

        // remap name to category.
        foreach (Notification::NAME_TO_CATEGORY as $name => $category) {
            UserNotification::where(['category' => $name])->update(['category' => $category]);
        }

        Schema::table('user_notifications', function (Blueprint $table) {
            $table->string('notifiable_type', 255)->nullable(false)->change();
            $table->unsignedBigInteger('notifiable_id')->nullable(false)->change();
            $table->string('category', 255)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->dropIndex('user_notification_group_lookup');
            $table->dropColumn('notifiable_type');
            $table->dropColumn('notifiable_id');
            $table->dropColumn('category');
        });
    }
}
