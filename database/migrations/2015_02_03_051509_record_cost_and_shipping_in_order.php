<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
use Illuminate\Database\Migrations\Migration;

class RecordCostAndShippingInOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $builder = Schema::connection('mysql-store');

        $builder->table('order_items', function ($table) {
            $table->float('cost')->nullable();
        });

        $builder->table('orders', function ($table) {
            $table->float('shipping')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $builder = Schema::connection('mysql-store');

        $builder->table('order_items', function ($table) {
            $table->dropColumn('cost');
        });

        $builder->table('orders', function ($table) {
            $table->dropColumn('shipping');
        });
    }
}
