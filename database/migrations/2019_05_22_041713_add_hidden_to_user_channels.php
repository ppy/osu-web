<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddHiddenToUserChannels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $builder = Schema::connection('mysql-chat');

        $builder->table('user_channels', function ($table) {
            $table->boolean('hidden')->default(0)->after('channel_id');
            $table->index('hidden');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $builder = Schema::connection('mysql-chat');

        $builder->table('user_channels', function ($table) {
            $table->dropColumn('hidden');
        });
    }
}
