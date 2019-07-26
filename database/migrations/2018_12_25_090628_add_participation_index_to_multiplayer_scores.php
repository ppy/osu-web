<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParticipationIndexToMultiplayerScores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('multiplayer_scores', function (Blueprint $table) {
            $table->index(['room_id', 'user_id', 'deleted_at'], 'participation_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('multiplayer_scores', function (Blueprint $table) {
            $table->dropIndex('participation_index');
        });
    }
}
