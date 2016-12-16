<?php

use Illuminate\Database\Migrations\Migration;

class UpdateKudosExchange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            ALTER TABLE osu_kudos_exchange
            MODIFY giver_id MEDIUMINT UNSIGNED NULL,
            MODIFY post_id MEDIUMINT UNSIGNED NULL,
            ADD details TEXT NULL
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('
            ALTER TABLE osu_kudos_exchange
            MODIFY giver_id MEDIUMINT UNSIGNED NOT NULL,
            MODIFY post_id MEDIUMINT UNSIGNED NOT NULL,
            DROP details
        ');
    }
}
