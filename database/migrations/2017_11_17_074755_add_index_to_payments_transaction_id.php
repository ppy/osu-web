<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddIndexToPaymentsTransactionId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-store')->table('payments', function ($table) {
            $table->index(['provider', 'transaction_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-store')->table('payments', function ($table) {
            $table->dropIndex(['provider', 'transaction_id']);
        });
    }
}
