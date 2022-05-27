<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `category` ENUM(
            'normal',
            'spotlight',
            'featured_artist'
        ) NOT NULL DEFAULT 'normal'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `category` ENUM(
            'normal',
            'spotlight'
        ) NOT NULL DEFAULT 'normal'");
    }
};
