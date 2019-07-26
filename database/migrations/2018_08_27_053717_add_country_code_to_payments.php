<?php

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
