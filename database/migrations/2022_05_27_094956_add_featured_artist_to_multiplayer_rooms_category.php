<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `category` ENUM(
            'normal',
            'spotlight',
            'featured_artist'
        ) NOT NULL DEFAULT 'normal'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `category` ENUM(
            'normal',
            'spotlight'
        ) NOT NULL DEFAULT 'normal'");
    }
};
