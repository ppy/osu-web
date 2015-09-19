<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkinElements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skin_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->index();
            $table->string('name')->index();
            $table->enum('extension', ["jpg", "gif", "png", "ini", "mp3", "wav", "ogg", "ttf"]);
            $table->enum('type', ["image", "sound", "config", "font"]);
            $table->tinyInteger("animation");
            $table->tinyInteger("high_res");
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
        Schema::drop('skin_elements');
    }
}
