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
        Schema::table('multiplayer_playlist_items', function (Blueprint $table) {
            $table->boolean('freestyle')->after('required_mods')->default(false);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('multiplayer_playlist_items', function (Blueprint $table) {
            $table->dropColumn('freestyle');
        });
    }
};
