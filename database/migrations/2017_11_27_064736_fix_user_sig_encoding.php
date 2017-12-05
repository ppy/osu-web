<?php

use Illuminate\Database\Migrations\Migration;

class FixUserSigEncoding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE phpbb_users MODIFY user_sig MEDIUMTEXT NOT NULL COLLATE 'utf8mb4_bin'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE phpbb_users MODIFY user_sig MEDIUMTEXT NOT NULL COLLATE 'utf8_bin'");
    }
}
