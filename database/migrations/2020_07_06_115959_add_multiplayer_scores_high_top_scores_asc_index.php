<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultiplayerScoresHighTopScoresAscIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('multiplayer_scores_high', function (Blueprint $table) {
            $table->index(['playlist_item_id', 'total_score', DB::raw('score_id DESC')], 'top_scores_asc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('multiplayer_scores_high', function (Blueprint $table) {
            $table->dropIndex('top_scores_asc');
        });
    }
}
