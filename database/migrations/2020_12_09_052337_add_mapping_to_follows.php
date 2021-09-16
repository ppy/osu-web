<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class AddMappingToFollows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE follows
                       MODIFY COLUMN subtype
                       ENUM('comment', 'modding', 'mapping')
                       NOT NULL");
        DB::table('follows')
            ->where([
                'subtype' => 'modding',
                'notifiable_type' => 'user',
            ])->update(['subtype' => 'mapping']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('follows')
            ->where([
                'subtype' => 'mapping',
                'notifiable_type' => 'user',
            ])->update(['subtype' => 'modding']);
        DB::statement("ALTER TABLE follows
                       MODIFY COLUMN subtype
                       ENUM('comment', 'modding')");
    }
}
