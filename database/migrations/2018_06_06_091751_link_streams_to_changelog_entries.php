<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class LinkStreamsToChangelogEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-updates')->table('streams', function ($table) {
            $table->string('repository', 150)->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-updates')->table('streams', function ($table) {
            $table->dropColumn('repository');
        });
    }
}
