<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('beatmapset_version_files', function (Blueprint $table) {
            $table->dropPrimary();
        });
        Schema::table('beatmapset_version_files', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beatmapset_version_files', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        Schema::table('beatmapset_version_files', function (Blueprint $table) {
            $table->primary(['file_id', 'version_id']);
        });
    }
};
