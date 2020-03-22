<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class JsonNewsPostPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DBAL (2.10.0) can't migrate to JSON datatype.
        // It only creates TEXT with DC2Type:json as comment.
        DB::statement('ALTER TABLE news_posts MODIFY page JSON');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DBAL (2.10.0) can't migrate from JSON datatype.
        // It explodes at unrecognized JSON datatype.
        DB::statement('ALTER TABLE news_posts MODIFY page TEXT');
    }
}
