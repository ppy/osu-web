<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skins', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id")->index();
            $table->unsignedInteger("default_version_id")->index();

            $table->unsignedInteger("downloaded_count");
            $table->unsignedInteger("favourite_count");
            $table->timestamps();

            //$table->foreign('user_id')->references('user_id')->on('phpbb_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('skins');
    }
}