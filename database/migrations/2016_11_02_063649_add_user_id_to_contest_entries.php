<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToContestEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contest_entries', function (Blueprint $table) {
            $table->mediumInteger('user_id')->unsigned()->nullable()->after('entry_url');
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
            $table->dropColumn('user_id');
        });
    }
}
