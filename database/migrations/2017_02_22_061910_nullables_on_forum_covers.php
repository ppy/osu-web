<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class NullablesOnForumCovers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_forum_covers', function ($table) {
            $table->datetime('created_at')->nullable()->default(null)->change();
            $table->datetime('updated_at')->nullable()->default(null)->change();
            $table->string('hash')->nullable()->change();
            $table->string('ext')->nullable()->change();
        });

        Schema::table('forum_topic_covers', function ($table) {
            $table->datetime('created_at')->nullable()->default(null)->change();
            $table->datetime('updated_at')->nullable()->default(null)->change();
            $table->string('hash')->nullable()->change();
            $table->string('ext')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_forum_covers', function ($table) {
            $table->datetime('created_at')->nullable(false)->change();
            $table->datetime('updated_at')->nullable(false)->change();
            $table->string('hash')->nullable(false)->change();
            $table->string('ext')->nullable(false)->change();
        });

        Schema::table('forum_topic_covers', function ($table) {
            $table->datetime('created_at')->nullable(false)->change();
            $table->datetime('updated_at')->nullable(false)->change();
            $table->string('hash')->nullable(false)->change();
            $table->string('ext')->nullable(false)->change();
        });
    }
}
