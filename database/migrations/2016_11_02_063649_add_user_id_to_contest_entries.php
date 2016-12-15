<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
