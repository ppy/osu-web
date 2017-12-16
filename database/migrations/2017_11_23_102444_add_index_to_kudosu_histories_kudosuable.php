<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddIndexToKudosuHistoriesKudosuable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_kudos_exchange', function ($table) {
            $table->index(['kudosuable_type', 'kudosuable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_kudos_exchange', function ($table) {
            $table->dropIndex(['kudosuable_type', 'kudosuable_id']);
        });
    }
}
