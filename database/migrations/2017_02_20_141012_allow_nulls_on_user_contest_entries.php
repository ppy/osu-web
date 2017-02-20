<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllowNullsOnUserContestEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE user_contest_entries MODIFY user_id MEDIUMINT UNSIGNED NULL');

        Schema::table('user_contest_entries', function ($table) {
            $table->string('original_filename')->nullable()->change();
            $table->string('hash')->nullable()->change();
            $table->string('ext')->nullable()->change();
            $table->integer('filesize')->nullable()->change();
            $table->unsignedInteger('contest_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE user_contest_entries MODIFY user_id MEDIUMINT UNSIGNED NOT NULL');

        Schema::table('user_contest_entries', function ($table) {
            $table->string('original_filename')->nullable(false)->change();
            $table->string('hash')->nullable(false)->change();
            $table->string('ext')->nullable(false)->change();
            $table->integer('filesize')->nullable(false)->change();
            $table->unsignedInteger('contest_id')->nullable(false)->change();
        });
    }
}
