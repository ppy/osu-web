<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddBeatmapsetWatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beatmapset_watches', function ($table) {
            $table->bigIncrements('id');
            $table->mediumInteger('beatmapset_id')->unsigned();
            $table->mediumInteger('user_id')->unsigned();
            $table->timestampTz('last_read')->useCurrent();
            $table->timestampTz('last_notified')->nullable()->default(null);
            $table->timestampsTz();

            $table->foreign('beatmapset_id')
                ->references('beatmapset_id')
                ->on('osu_beatmapsets')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('user_id')
                ->on('phpbb_users')
                ->onDelete('cascade');

            $table->unique(['beatmapset_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('beatmapset_watches');
    }
}
