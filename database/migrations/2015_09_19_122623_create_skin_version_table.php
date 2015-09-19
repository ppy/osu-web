<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkinVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skin_versions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('skin_id')->index();
            $table->unsignedInteger('previous_skin_id')->index();
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('preview_image_id')->index();
            $table->tinyInteger('allow_remixes');
            $table->tinyInteger('released');
            $table->tinyInteger('public');
            $table->text('title');
            $table->text('version_title');
            $table->text('description');
            $table->unsignedInteger('size');
            $table->unsignedInteger('elements_count');
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
        Schema::drop('skin_versions');
    }
}
