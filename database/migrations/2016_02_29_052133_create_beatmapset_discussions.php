<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBeatmapsetDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('beatmapset_discussions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumInteger('beatmapset_id')->unsigned();
            $table->timestamps();

            $table->unique('beatmapset_id');

            $table->foreign('beatmapset_id')
                ->references('beatmapset_id')
                ->on('osu_beatmapsets')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('beatmapset_discussions');
    }
}
