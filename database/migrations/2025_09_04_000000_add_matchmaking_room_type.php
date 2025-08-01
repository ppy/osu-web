<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `type` ENUM(
            'playlists',
            'head_to_head',
            'team_versus',
            'matchmaking'
        ) NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `type` ENUM(
            'playlists',
            'head_to_head',
            'team_versus'
        ) NOT NULL");
    }
};
