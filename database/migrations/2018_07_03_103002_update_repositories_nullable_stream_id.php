<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class UpdateRepositoriesNullableStreamId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repositories', function ($table) {
            $table->unsignedInteger('stream_id')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repositories', function ($table) {
            $table->unsignedInteger('stream_id')->default(null)->change();
        });
    }
}
