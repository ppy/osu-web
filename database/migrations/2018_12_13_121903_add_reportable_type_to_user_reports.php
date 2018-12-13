<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportableTypeToUserReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_user_reports', function (Blueprint $table) {
            $table->enum('reportable_type', ['user', 'score', 'comment'])->nullable()->after('user_id');
            $table->unsignedInteger('reportable_id')->nullable()->after('mode');
            $table->unique(['reporter_id', 'user_id', 'reportable_type', 'mode', 'reportable_id'], 'unique-reportable');
        });

        DB::statement("UPDATE osu_user_reports SET reportable_type = 'user', reportable_id = user_id WHERE score_id = 0");
        DB::statement("UPDATE osu_user_reports SET reportable_type = 'score', reportable_id = score_id WHERE score_id <> 0");

        Schema::table('osu_user_reports', function (Blueprint $table) {
            $table->dropIndex('unique-new');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_user_reports', function (Blueprint $table) {
            $table->dropIndex('unique-reportable');
            $table->dropColumn('reportable_type');
            $table->dropColumn('reportable_id');
            $table->unique(['reporter_id', 'user_id', 'mode', 'score_id'], 'unique-new');
        });
    }
}
