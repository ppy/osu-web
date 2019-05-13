<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddVersionToReplays extends Migration
{
    const TABLES = ['osu_replays', 'osu_replays_fruits', 'osu_replays_mania', 'osu_replays_taiko'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (static::TABLES as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->integer('version')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (static::TABLES as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('version');
            });
        }
    }
}
