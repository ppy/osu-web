<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanchostatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('osu_banchostats')) {
            return;
        }

        Schema::create('osu_banchostats', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';


            $table->increments('banchostats_id');
            $table->smallInteger('users_irc');
            $table->smallInteger('users_osu');
            $table->smallInteger('multiplayer_games');
            $table->timestamp('date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('osu_banchostats');
    }
}
