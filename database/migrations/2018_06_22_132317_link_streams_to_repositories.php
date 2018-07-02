<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class LinkStreamsToRepositories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repository_update_stream', function ($table) {
            $table->unsignedBigInteger('repository_id');
            $table->unsignedBigInteger('stream_id');
            $table->unique(['repository_id', 'stream_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('repository_update_stream');
    }
}
