<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class LinkChangelogEntriesToRepositories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('changelog_entries', function ($table) {
            $table->unsignedBigInteger('repository_id')->nullable()->default(null)->after('repository');
            $table->unique(['repository_id', 'github_pull_request_id']);
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
            $table->dropUnique(['repository_id', 'github_pull_request_id']);
            $table->dropColumn('repository_id');
        });
    }
}
