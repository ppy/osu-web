<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProviderReferenceToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-store')->table('orders', function (Blueprint $table) {
            $table->string('provider', 50)->nullable();
            $table->string('reference', 255)->nullable();
            $table->index(['provider', 'reference']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-store')('orders', function (Blueprint $table) {
            $table->dropColumn('provider');
            $table->dropColumn('reference');
            $table->dropIndex(['provider', 'reference']);
        });
    }
}
