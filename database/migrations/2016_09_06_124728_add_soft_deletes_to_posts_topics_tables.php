<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesToPostsTopicsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phpbb_posts', function (Blueprint $table) {
            $table->softDeletes();
            $table->index('deleted_at');
        });

        Schema::table('phpbb_topics', function (Blueprint $table) {
            $table->softDeletes();
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phpbb_posts', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
            $table->dropIndex('deleted_at_index');
        });

        Schema::table('phpbb_topics', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
            $table->dropIndex('deleted_at_index');
        });
    }
}
