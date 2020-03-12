<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class ChangeCostsToDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // products uses (10,2), so widen to (10,2)
        DB::connection('mysql-store')->statement('ALTER TABLE order_items MODIFY cost DECIMAL(10,2)');
        DB::connection('mysql-store')->statement('ALTER TABLE orders MODIFY shipping DECIMAL(10,2)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection('mysql-store')->statement('ALTER TABLE order_items MODIFY cost DOUBLE(8,2)');
        DB::connection('mysql-store')->statement('ALTER TABLE orders MODIFY shipping DOUBLE(8,2)');
    }
}
