<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvatarOnUserProfileCustomizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profile_customizations', function (Blueprint $table) {
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
            $table->dropColumn('avatar_json');
        });
    }
}
