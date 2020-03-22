<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropRepositoryFromChangelogEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('changelog_entries', function ($table) {
            $table->dropUnique(['repository', 'github_pull_request_id']);
            $table->dropColumn('repository');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('changelog_entries', function ($table) {
            $table->string('repository', 150)->nullable()->default(null);
            $table->unique(['repository', 'github_pull_request_id']);
        });
    }
}
