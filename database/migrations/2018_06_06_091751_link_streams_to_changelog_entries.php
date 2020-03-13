<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class LinkStreamsToChangelogEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repositories', function ($table) {
            $table->bigIncrements('id');
            $table->string('name', 150)->default(null);
            $table->unsignedInteger('stream_id')->default(null);
            $table->nullableTimestamps();

            $table->unique('name');
            $table->unique(['name', 'stream_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('repositories');
    }
}
