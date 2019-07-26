<?php

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
