<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBannerSalesEndsAtToTournaments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->timestamp('banner_sales_ends_at')->nullable()->after('tournament_banner_product_id');
            $table->index(['banner_sales_ends_at']);
        });

        // give existing stuff a value.
        DB::statement('UPDATE `tournaments` SET `banner_sales_ends_at` = `end_date`');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('banner_sales_ends_at');
        });
    }
}
