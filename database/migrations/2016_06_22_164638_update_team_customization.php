<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTeamCustomization extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_profile_customizations', function ($table) {
            $table->text('info')->nullable();
            $table->string('website')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_profile_customizations', function ($table) {
            $table->dropColumn('info');
            $table->dropColumn('website');
        });
    }
}
