<?php

use Illuminate\Database\Migrations\Migration;

class AddMultiAccountingReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE osu_user_reports CHANGE reason reason ENUM(
            'Insults',
            'Spam',
            'Cheating',
            'UnwantedContent',
            'Nonsense',
            'MultiAccounting',
            'Other'
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE osu_user_reports CHANGE reason reason ENUM(
            'Insults',
            'Spam',
            'Cheating',
            'UnwantedContent',
            'Nonsense',
            'Other'
        )");
    }
}
