<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeatmapDiscussionReplies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beatmap_discussion_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('beatmap_discussion_id')->unsigned();
            $table->mediumInteger('user_id')->unsigned()->nullable();
            $table->timestamps();

            $table->text('message');

            $table->foreign('beatmap_discussion_id')
                ->references('id')
                ->on('beatmap_discussions')
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
        Schema::drop('beatmap_discussion_replies');
    }
}
