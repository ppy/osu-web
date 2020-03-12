<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddActionFieldToChatTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $chatTables = ['messages', 'messages_private'];

    public function up()
    {
        $builder = Schema::connection('mysql-chat');

        foreach ($this->chatTables as $table) {
            $builder->table($table, function ($table) {
                $table->boolean('is_action')->default(0)->after('content');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $builder = Schema::connection('mysql-chat');

        foreach ($this->chatTables as $table) {
            $builder->table($table, function ($table) {
                $table->dropColumn('is_action');
            });
        }
    }
}
