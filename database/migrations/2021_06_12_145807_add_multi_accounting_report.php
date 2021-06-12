<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
