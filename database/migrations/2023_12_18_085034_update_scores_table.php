<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private static function resetView(): void
    {
        DB::statement('DROP VIEW scores');
        DB::statement('CREATE VIEW scores AS SELECT * FROM solo_scores');
    }

    public function up(): void
    {
        Schema::table('solo_scores', function (Blueprint $table) {
            $table->dropColumn('updated_at');

            $table->dropIndex('solo_scores_beatmap_id_index');
            $table->dropIndex('solo_scores_preserve_index');
            $table->dropIndex('user_ruleset_id_index');

            $table->boolean('ranked')->default(true)->after('preserve');
            $table->unsignedInteger('unix_updated_at')->default(DB::raw('(unix_timestamp())'));
            $table->timestamp('created_at')->useCurrent()->change();

            $table->index(['user_id', 'ruleset_id'], 'user_ruleset_index');
            $table->index(['beatmap_id', 'user_id'], 'beatmap_user_index');
        });

        DB::statement('ALTER TABLE solo_scores MODIFY id bigint unsigned NOT NULL');
        DB::statement('ALTER TABLE solo_scores DROP PRIMARY KEY');
        DB::statement('ALTER TABLE solo_scores ADD PRIMARY KEY (id, preserve, unix_updated_at)');
        DB::statement('ALTER TABLE solo_scores MODIFY id bigint unsigned NOT NULL AUTO_INCREMENT');

        static::resetView();
    }

    public function down(): void
    {
        Schema::table('solo_scores', function (Blueprint $table) {
            $table->dropColumn('unix_updated_at');
            $table->dropColumn('ranked');

            $table->dropIndex('user_ruleset_index');
            $table->dropIndex('beatmap_user_index');

            $table->datetime('created_at')->change();
            $table->timestamp('updated_at')->nullable(true);

            $table->index('preserve', 'solo_scores_preserve_index');
            $table->index('beatmap_id', 'solo_scores_beatmap_id_index');
            $table->index(['user_id', 'ruleset_id', DB::raw('id DESC')], 'user_ruleset_id_index');
        });

        DB::statement('ALTER TABLE solo_scores MODIFY id bigint unsigned NOT NULL');
        DB::statement('ALTER TABLE solo_scores DROP PRIMARY KEY');
        DB::statement('ALTER TABLE solo_scores ADD PRIMARY KEY (id)');
        DB::statement('ALTER TABLE solo_scores MODIFY id bigint unsigned NOT NULL AUTO_INCREMENT');

        static::resetView();
    }
};
