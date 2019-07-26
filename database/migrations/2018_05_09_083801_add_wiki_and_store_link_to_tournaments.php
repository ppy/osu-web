<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddWikiAndStoreLinkToTournaments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function ($table) {
            $table->unsignedInteger('tournament_banner_product_id')->nullable()->default(null);
            $table->string('info_url')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournaments', function ($table) {
            $table->dropColumn('tournament_banner_product_id');
            $table->dropColumn('info_url');
        });
    }
}
