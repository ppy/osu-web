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
            $table->text('avatar_json');
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
            $table->dropColumn(['tablet_model', 'tablet_brand', 'tablet_surface', 'avatar_json']);
        });
    }
}
