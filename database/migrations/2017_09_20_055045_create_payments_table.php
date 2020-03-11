<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-store')->create('payments', function (Blueprint $table) {
            $table->increments('id'); // Set a PK so that InnoDB won't use order_id as a clustered index.
            $table->unsignedInteger('order_id');
            $table->boolean('cancelled')->default(false); // TODO: should probably record more detailed status of what happened to the transaction?
            $table->string('transaction_id', 255);
            $table->string('provider', 50);
            $table->dateTime('paid_at');

            $table->timestamps();

            $table->unique(['order_id', 'cancelled']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-store')->drop('payments');
    }
}
