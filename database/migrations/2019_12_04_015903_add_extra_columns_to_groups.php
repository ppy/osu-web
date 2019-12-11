<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsToGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phpbb_groups', function (Blueprint $table) {
            $table->string('identifier')->nullable();
            $table->string('short_name')->nullable();
            $table->integer('display_order')->default(0);
            $table->string('colour')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phpbb_groups', function (Blueprint $table) {
            $table->dropColumn('identifier');
            $table->dropColumn('short_name');
            $table->dropColumn('display_order');
            $table->dropColumn('colour');
        });
    }
}
