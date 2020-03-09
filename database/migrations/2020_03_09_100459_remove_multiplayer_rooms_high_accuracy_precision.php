<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveMultiplayerRoomsHighAccuracyPrecision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->float('accuracy')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // This won't actually do anything; change() won't add precision,
        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->float('accuracy', 5, 4)->default(0)->change();
        });
    }
}
