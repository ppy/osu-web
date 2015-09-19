<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkinUsersElements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skin_users_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("element_id")->index();
            $table->unsignedInteger("user_id")->index();
            $table->tinyInteger("allow_reusage");
            $table->tinyInteger("animation");
            $table->tinyInteger("high_res");
            $table->integer("frame");
            $table->string("hash")->index();
            $table->unsignedInteger("size");
            $table->enum('extension', ["jpg", "gif", "png", "ini", "mp3", "wav", "ogg", "ttf"]);
            $table->enum('type', ["image", "sound", "config", "font"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('skin_users_elements');
    }
}
