<?php

use Illuminate\Database\Migrations\Migration;

class IndexOsuBanchostats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_banchostats', function ($table) {
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_banchostats', function ($table) {
            $table->dropIndex('date');
        });
    }
}
