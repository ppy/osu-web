<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserContestEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contest_entries', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('id');

            $table->string('original_filename');
            $table->string('hash');
            $table->string('ext');

            $table->integer('filesize');

            $table->mediumInteger('user_id')->unsigned();

            $table->integer('contest_id')->unsigned();

            $table->timestamps();

            $table->index(['user_id']);
            $table->index(['contest_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_contest_entries');
    }
}
