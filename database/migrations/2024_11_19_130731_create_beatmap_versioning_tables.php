<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // raw statement used as laravel syntax doesn't support a fixed size BINARY column
        DB::statement('CREATE TABLE `beatmapset_files` (
            `file_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `sha2_hash` BINARY(32) NOT NULL,
            `file_size` INT UNSIGNED NOT NULL,

            UNIQUE (`sha2_hash`)
        )');

        Schema::create('beatmapset_versions', function (Blueprint $table) {
            $table->bigIncrements('version_id');
            $table->mediumInteger('beatmapset_id')->unsigned();
            $table->dateTime('created_at')->default(DB::raw('NOW()'));
            $table->bigInteger('previous_version_id')->unsigned()->nullable();

            $table->index('beatmapset_id');
            $table->index('previous_version_id');
        });

        Schema::create('beatmapset_version_files', function (Blueprint $table) {
            $table->bigInteger('file_id')->unsigned();
            $table->bigInteger('version_id')->unsigned();
            $table->string('filename', length: 500);

            $table->primary(['file_id', 'version_id']);
            $table->index('file_id');
            $table->index('version_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beatmapset_version_files');
        Schema::dropIfExists('beatmapset_versions');
        Schema::dropIfExists('beatmapset_files');
    }
};
