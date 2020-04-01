<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryCodeToPayments extends Migration
{
    public function up()
    {
        Schema::connection('mysql-store')->table('payments', function (Blueprint $table) {
            $table->string('country_code')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::connection('mysql-store')->table('payments', function (Blueprint $table) {
            $table->dropColumn('country_code');
        });
    }
}
