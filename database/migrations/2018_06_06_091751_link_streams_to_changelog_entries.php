<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class LinkStreamsToChangelogEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repositories', function ($table) {
            $table->bigIncrements('id');
            $table->string('name', 150)->default(null);
            $table->unsignedInteger('stream_id')->default(null);
            $table->nullableTimestamps();

            $table->unique('name');
            $table->unique(['name', 'stream_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('repositories');
    }
}
