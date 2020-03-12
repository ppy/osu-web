<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class AddProcessingTypeToOrderStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql-store')->statement("ALTER TABLE orders MODIFY status ENUM(
            'incart',
            'checkout',
            'paid',
            'shipped',
            'cancelled',
            'delivered',
            'processing'
        ) NOT NULL DEFAULT 'incart'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection('mysql-store')->statement("ALTER TABLE orders MODIFY status ENUM(
            'incart',
            'checkout',
            'paid',
            'shipped',
            'cancelled',
            'delivered'
        ) NOT NULL DEFAULT 'incart'");
    }
}
