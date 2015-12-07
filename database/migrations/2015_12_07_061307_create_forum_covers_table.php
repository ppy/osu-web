<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumCoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_forum_covers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumInteger('forum_id')->unsigned()->nullable();
            $table->mediumInteger('user_id')->unsigned()->nullable();
            $table->string('hash');
            $table->string('ext');
            $table->timestamps();

            $table->unique('forum_id');
            $table->index('user_id');

            $table->foreign('forum_id')
                ->references('forum_id')
                ->on('phpbb_forums')
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
        Schema::drop('forum_forum_covers');
    }
}
