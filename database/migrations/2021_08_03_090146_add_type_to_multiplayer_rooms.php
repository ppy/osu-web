<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToMultiplayerRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('multiplayer_rooms', function (Blueprint $table) {
            $table->enum('type', ['playlists', 'headtohead', 'teamvs'])->after('password');
            $table->index(['type', 'category', 'ends_at']);
        });

        DB::table('multiplayer_rooms')->where('category', 'realtime')->update(['type' => 'headtohead', 'category' => 'normal']);

        DB::statement("ALTER TABLE multiplayer_rooms MODIFY COLUMN category enum('normal', 'spotlight') NOT NULL DEFAULT 'normal'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE multiplayer_rooms MODIFY COLUMN category enum('normal', 'spotlight', 'realtime') NOT NULL DEFAULT 'normal'");

        DB::table('multiplayer_rooms')->whereIn('type', ['headtohead', 'teamvs'])->update(['category' => 'realtime']);

        Schema::table('multiplayer_rooms', function (Blueprint $table) {
            $table->dropIndex(['type', 'category', 'ends_at']);
            $table->dropColumn('type');
        });
    }
}
