<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContestVotesChangeWeightingToFloat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contest_votes', function (Blueprint $table) {
            $table->float('weight')->default(1.0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contest_votes', function (Blueprint $table) {
            $table->tinyInteger('weight')->default(1)->change();
        });
    }
}
