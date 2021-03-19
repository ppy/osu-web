<?php

use Illuminate\Database\Migrations\Migration;

class AddExternalContestType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE contests CHANGE type type ENUM(
            'art',
            'beatmap',
            'music',
            'external'
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE contests CHANGE type type ENUM(
            'art',
            'beatmap',
            'music'
        )");
    }
}
