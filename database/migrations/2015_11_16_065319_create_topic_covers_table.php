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
            $table->increments('id');
            $table->integer('topic_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('hash');
            $table->string('ext');
            $table->timestamps();

            $table->index(['topic_id']);
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
