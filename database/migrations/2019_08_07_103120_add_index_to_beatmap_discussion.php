<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToBeatmapDiscussion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beatmap_discussions', function (Blueprint $table) {
            $table->index(['user_id', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beatmap_discussions', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'updated_at']);
        });
    }
}
