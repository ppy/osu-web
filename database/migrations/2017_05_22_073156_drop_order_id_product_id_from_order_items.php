<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropOrderIdProductIdFromOrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-store')->table('order_items', function (Blueprint $table) {
            // MySQL needs the FK to be recreated when dropping the unique constraint.
            // https://bugs.mysql.com/bug.php?id=37910
            $table->dropForeign('FK_order_items_orders');
            $table->dropUnique('order_id_product_id');
            $table->foreign('order_id', 'FK_order_items_orders')->references('order_id')->on('orders')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-store')->table('order_items', function (Blueprint $table) {
            $table->unique(['order_id', 'product_id'], 'order_id_product_id');
        });
    }
}
