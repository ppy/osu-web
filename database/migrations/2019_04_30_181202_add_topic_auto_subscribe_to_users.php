<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTopicAutoSubscribeToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phpbb_users', function (Blueprint $table) {
            $table->boolean('topic_auto_subscribe')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phpbb_users', function (Blueprint $table) {
            $table->dropColumn('topic_auto_subscribe');
        });
    }
}
