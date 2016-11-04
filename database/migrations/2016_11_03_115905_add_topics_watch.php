<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTopicsWatch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phpbb_topics_watch', function (Blueprint $table) {
            $table->unsignedMediumInteger('user_id')->nullable();
            $table->unsignedMediumInteger('topic_id')->nullable();
            $table->unsignedTinyInteger('notify_status');
            $table->index('topic_id');
            $table->index('notify_status');
            $table->primary(array('user_id', 'topic_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('phpbb_topics_watch');
    }
}
