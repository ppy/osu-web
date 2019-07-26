<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParticipationCountToMultiplayerRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('multiplayer_rooms', function (Blueprint $table) {
            $table->unsignedInteger('participant_count')->default(0)->after('max_attempts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('multiplayer_rooms', function (Blueprint $table) {
            $table->dropColumn('participant_count');
        });
    }
}
