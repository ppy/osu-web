<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // raw statement used as laravel syntax doesn't support a fixed size BINARY column
        DB::statement('CREATE TABLE `osu_beatmapset_files` (
            `file_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `sha2_hash` BINARY(32) NOT NULL,
            `file_size` INT UNSIGNED NOT NULL,

            UNIQUE (`sha2_hash`)
        )');

        Schema::create('osu_beatmapset_versions', function (Blueprint $table) {
            $table->bigIncrements('version_id');
            $table->mediumInteger('beatmapset_id')->unsigned();
            $table->dateTime('created_at')->default(DB::raw('NOW()'));
            $table->bigInteger('previous_version_id')->unsigned()->nullable();

            $table->foreign('beatmapset_id')->references('beatmapset_id')->on('osu_beatmapsets');
            $table->foreign('previous_version_id')->references('version_id')->on('osu_beatmapset_versions');
        });

        Schema::create('osu_beatmapset_version_files', function (Blueprint $table) {
            $table->bigInteger('file_id')->unsigned();
            $table->bigInteger('version_id')->unsigned();
            $table->string('filename', length: 500);

            $table->primary(['file_id', 'version_id']);
            $table->foreign('file_id')->references('file_id')->on('osu_beatmapset_files');
            $table->foreign('version_id')->references('version_id')->on('osu_beatmapset_versions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osu_beatmapset_version_files');
        Schema::dropIfExists('osu_beatmapset_versions');
        Schema::dropIfExists('osu_beatmapset_files');
    }
};
