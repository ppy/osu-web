<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicCoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_topic_covers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumInteger('topic_id')->unsigned()->nullable();
            $table->mediumInteger('user_id')->unsigned()->nullable();
            $table->string('hash');
            $table->string('ext');
            $table->timestamps();

            $table->index('topic_id');
            $table->index('user_id');

            $table->foreign('topic_id')
                ->references('topic_id')
                ->on('phpbb_topics')
                ->onDelete('set null');

            $table->foreign('user_id')
                ->references('user_id')
                ->on('phpbb_users')
                ->onDelete('set null');
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
        Schema::drop('forum_topic_covers');
    }
}
