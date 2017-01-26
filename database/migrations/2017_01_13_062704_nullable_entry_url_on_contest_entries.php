<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullableEntryUrlOnContestEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contest_entries', function (Blueprint $table) {
            $table->string('entry_url')->nullable()->default('NULL')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contest_entries', function (Blueprint $table) {
            $table->string('entry_url')->nullable(false)->default('')->change();
        });
    }
}
