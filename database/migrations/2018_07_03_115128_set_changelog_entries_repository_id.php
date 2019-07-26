<?php

use Illuminate\Database\Migrations\Migration;

class SetChangelogEntriesRepositoryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('UPDATE changelog_entries ce
            SET repository_id = (SELECT r.id FROM repositories r WHERE r.name = ce.repository)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // emptying the column not necessary.
    }
}
