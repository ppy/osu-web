<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkinVersionsElements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skin_versions_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_element_id')->index();
            $table->unsignedInteger('element_id')->index();
            $table->unsignedInteger('version_id')->index();
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
        Schema::drop('skin_versions_elements');
    }
}
