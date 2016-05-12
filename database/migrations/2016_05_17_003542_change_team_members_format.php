<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTeamMembersFormat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('team_members', function (Blueprint $table) {
            $table->mediumInteger('team_id');
            $table->mediumInteger('user_id');
            $table->boolean('is_admin')->default(false);
            $table->primary(['team_id', 'user_id']);
            $table->foreign('user_id')->references('user_id')->on('phpbb_users');
            $table->foreign('team_id')->references('team_id')->on('teams');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('team_members');
    }
}
