<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeatmapDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beatmap_discussions', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('beatmapset_discussion_id')->unsigned();
            $table->mediumInteger('beatmap_id')->unsigned();
            $table->mediumInteger('user_id')->unsigned()->nullable();

            $table->integer('message_type')->nullable();
            $table->integer('timestamp')->nullable();
            $table->text('message')->default('');
            $table->boolean('resolved')->default(false);

            $table->timestamps();

            $table->foreign('beatmapset_discussion_id')
                ->references('id')
                ->on('beatmapset_discussions')
                ->onDelete('RESTRICT');

            $table->foreign('beatmap_id')
                ->references('beatmap_id')
                ->on('osu_beatmaps')
                ->onDelete('RESTRICT');

            $table->foreign('user_id')
                ->references('user_id')
                ->on('phpbb_users')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('beatmap_discussions');
    }
}
