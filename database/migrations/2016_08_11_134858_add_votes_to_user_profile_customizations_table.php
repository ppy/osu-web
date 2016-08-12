<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesToUserProfileCustomizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profile_customizations', function (Blueprint $table) {
            $table->text('tablet_brand');
            $table->text('tablet_model');
            $table->text('tablet_surface');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profile_customizations', function (Blueprint $table) {
            $table->dropColumn('tablet_model');
            $table->dropColumn('tablet_brand');
            $table->dropColumn('tablet_surface');
        });
    }
}
