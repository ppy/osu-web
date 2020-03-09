<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChannelTypeIndexToChannels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-chat')->table('channels', function (Blueprint $table) {
            $table->index(['type'], 'channel_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-chat')->table('channels', function (Blueprint $table) {
            $table->dropIndex('channel_type');
        });
    }
}
