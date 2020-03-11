<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangelogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('build_changelog_entry', function (Blueprint $table) {
            $table->unsignedBigInteger('build_id');
            $table->unsignedBigInteger('changelog_entry_id');
            $table->unique(['build_id', 'changelog_entry_id']);
        });

        Schema::create('changelog_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('repository', 150)->nullable()->default(null);
            $table->unsignedBigInteger('github_pull_request_id')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
            $table->string('category')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);
            $table->text('message')->nullable()->default(null);
            $table->unsignedBigInteger('github_user_id')->nullable()->default(null);
            $table->boolean('private')->default(false);
            $table->boolean('major')->default(false);
            $table->string('url')->nullable()->default(null);
            $table->nullableTimestamps();
            $table->unique(['repository', 'github_pull_request_id']);
        });

        Schema::create('github_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('canonical_id')->nullable()->default(null)->unique();
            $table->string('username')->nullable()->default(null);
            $table->unsignedMediumInteger('user_id')->nullable()->default(null);
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('build_changelog_entry');
        Schema::drop('changelog_entries');
        Schema::drop('github_users');
    }
}
