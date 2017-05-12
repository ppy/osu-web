<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddBuildPropagationHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('osu_build_propagation_history', function ($table) {
            $table->increments('id');
            $table->integer('stream_id')->unsigned();
            $table->unsignedMediumInteger('user_count')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('osu_build_propagation_history');
    }
}
