<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryToUserNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->unsignedTinyInteger('delivery')->default(0)->after('is_read');
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
            $table->dropColumn('delivery');
        });
    }
}
