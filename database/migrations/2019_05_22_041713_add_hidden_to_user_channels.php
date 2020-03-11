<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddHiddenToUserChannels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $builder = Schema::connection('mysql-chat');

        $builder->table('user_channels', function ($table) {
            $table->boolean('hidden')->default(0)->after('channel_id');
            $table->index('hidden');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $builder = Schema::connection('mysql-chat');

        $builder->table('user_channels', function ($table) {
            $table->dropColumn('hidden');
        });
    }
}
