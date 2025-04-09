<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const RULESET_TABLE_SUFFIXES = ['', '_fruits', '_mania', '_mania_4k', '_mania_7k', '_taiko'];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('artist_tracks', function (Blueprint $table) {
            $table->string('licence_text')->nullable()->after('genre');
            $table->string('cover_url', 512)->nullable()->change();
            $table->string('preview', 512)->nullable(false)->change();
            $table->string('osz', 512)->nullable(false)->change();
        });
        Schema::table('artists', function (Blueprint $table) {
            $table->string('alternative_name')->nullable()->after('name');
            $table->boolean('use_for_linking')->nullable(false)->default(true)->after('header_url');
        });
        Schema::table('osu_banchostats', function (Blueprint $table) {
            $table->mediumInteger('users_osu')->change();
        });
        Schema::table('osu_beatmaps', function (Blueprint $table) {
            $columns = ['countTotal', 'countNormal', 'countSlider', 'countSpinner'];
            foreach ($columns as $column) {
                $table->unsignedMediumInteger($column)->default(0)->change();
            }

            $table->dropColumn('orphaned');
        });
        DB::statement('ALTER TABLE osu_beatmaps MODIFY bpm float NOT NULL DEFAULT 60');
        Schema::table('osu_beatmapsets', function (Blueprint $table) {
            $table->tinyInteger('comment_locked')->nullable()->default(0)->change();
        });
        Schema::table('osu_kudos_exchange', function (Blueprint $table) {
            $table->unsignedInteger('giver_id')->nullable()->change();
            $table->unsignedInteger('receiver_id')->nullable(false)->change();
        });
        Schema::table('osu_user_achievements', function (Blueprint $table) {
            $table->index('achievement_id', 'achievement_id');
        });
        foreach (static::RULESET_TABLE_SUFFIXES as $suffix) {
            DB::statement("ALTER TABLE osu_user_stats{$suffix} MODIFY rank_score_exp float unsigned NOT NULL DEFAULT 0");
        }
        Schema::table('phpbb_users', function (Blueprint $table) {
            $table->dropColumn('user_lastfm');
            $table->dropColumn('user_lastfm_session');
        });
        Schema::table('solo_scores', function (Blueprint $table) {
            $table->boolean('has_replay')->nullable()->default(false)->change();
            $table->datetime('created_at')->nullable(false)->change();
        });
        Schema::table('score_pins', function (Blueprint $table) {
            $table->index('score_type', 'score_type');
        });

        DB::connection('mysql-chat')->statement('ALTER TABLE messages MODIFY message_id bigint unsigned NOT NULL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artist_tracks', function (Blueprint $table) {
            $table->dropColumn('licence_text');
            $table->string('cover_url')->nullable()->change();
            $table->string('preview')->nullable(false)->change();
            $table->string('osz')->nullable(false)->change();
        });
        Schema::table('artists', function (Blueprint $table) {
            $table->dropColumn('alternative_name');
            $table->dropColumn('use_for_linking');
        });
        Schema::table('osu_kudos_exchange', function (Blueprint $table) {
            $table->unsignedMediumInteger('giver_id')->nullable()->change();
            $table->unsignedMediumInteger('receiver_id')->nullable(false)->change();
        });
        Schema::table('osu_beatmapsets', function (Blueprint $table) {
            $table->tinyInteger('comment_locked')->nullable(false)->default(0)->change();
        });
        Schema::table('osu_beatmaps', function (Blueprint $table) {
            $columns = ['countTotal', 'countNormal', 'countSlider', 'countSpinner'];
            foreach ($columns as $column) {
                $table->unsignedSmallInteger($column)->default(0)->change();
            }
            $table->tinyInteger('orphaned')->default(0)->after('passcount');
            $table->double('bpm')->nullable(false)->default(60)->change();
        });
        Schema::table('osu_banchostats', function (Blueprint $table) {
            $table->smallInteger('users_osu')->change();
        });
        Schema::table('osu_user_achievements', function (Blueprint $table) {
            $table->dropIndex('achievement_id');
        });
        foreach (static::RULESET_TABLE_SUFFIXES as $suffix) {
            Schema::table("osu_user_stats{$suffix}", function (Blueprint $table) {
                $table->double('rank_score_exp')->nullable(false)->default(0)->change();
            });
        }
        Schema::table('phpbb_users', function (Blueprint $table) {
            $table->string('user_lastfm')->default('')->after('user_from');
            $table->string('user_lastfm_session')->default('')->after('user_lastfm');
        });
        Schema::table('score_pins', function (Blueprint $table) {
            $table->dropIndex('score_type');
        });
        Schema::table('solo_scores', function (Blueprint $table) {
            $table->boolean('has_replay')->nullable(false)->default(false)->change();
            $table->timestamp('created_at')->nullable()->change();
        });

        DB::connection('mysql-chat')->statement('ALTER TABLE messages MODIFY message_id int unsigned NOT NULL AUTO_INCREMENT');
    }
};
