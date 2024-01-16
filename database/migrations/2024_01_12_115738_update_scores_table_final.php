<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
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
        Schema::drop('solo_scores');
        DB::statement("CREATE TABLE `solo_scores` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT,
            `user_id` int unsigned NOT NULL,
            `ruleset_id` smallint unsigned NOT NULL,
            `beatmap_id` mediumint unsigned NOT NULL,
            `has_replay` tinyint NOT NULL DEFAULT '0',
            `preserve` tinyint NOT NULL DEFAULT '0',
            `ranked` tinyint NOT NULL DEFAULT '1',
            `rank` char(2) NOT NULL DEFAULT '',
            `passed` tinyint NOT NULL DEFAULT '0',
            `accuracy` float NOT NULL DEFAULT '0',
            `max_combo` int unsigned NOT NULL DEFAULT '0',
            `total_score` int unsigned NOT NULL DEFAULT '0',
            `data` json NOT NULL,
            `pp` float DEFAULT NULL,
            `legacy_score_id` bigint unsigned DEFAULT NULL,
            `legacy_total_score` int unsigned NOT NULL DEFAULT '0',
            `started_at` timestamp NULL DEFAULT NULL,
            `ended_at` timestamp NOT NULL,
            `unix_updated_at` int unsigned NOT NULL DEFAULT (unix_timestamp()),
            `build_id` smallint unsigned DEFAULT NULL,
            PRIMARY KEY (`id`,`preserve`,`unix_updated_at`),
            KEY `user_ruleset_index` (`user_id`,`ruleset_id`),
            KEY `beatmap_user_index` (`beatmap_id`,`user_id`),
            KEY `legacy_score_lookup` (`ruleset_id`,`legacy_score_id`)
        )");

        DB::statement('DROP VIEW score_legacy_id_map');
        Schema::drop('solo_scores_legacy_id_map');

        DB::statement('DROP VIEW score_performance');
        Schema::drop('solo_scores_performance');

        static::resetView();
    }

    public function down(): void
    {
        Schema::drop('solo_scores');
        DB::statement("CREATE TABLE `solo_scores` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT,
            `user_id` int unsigned NOT NULL,
            `beatmap_id` mediumint unsigned NOT NULL,
            `ruleset_id` smallint unsigned NOT NULL,
            `data` json NOT NULL,
            `has_replay` tinyint DEFAULT '0',
            `preserve` tinyint NOT NULL DEFAULT '0',
            `ranked` tinyint NOT NULL DEFAULT '1',
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `unix_updated_at` int unsigned NOT NULL DEFAULT (unix_timestamp()),
            PRIMARY KEY (`id`,`preserve`,`unix_updated_at`),
            KEY `user_ruleset_index` (`user_id`,`ruleset_id`),
            KEY `beatmap_user_index` (`beatmap_id`,`user_id`)
        )");

        DB::statement('CREATE TABLE `solo_scores_legacy_id_map` (
            `ruleset_id` smallint unsigned NOT NULL,
            `old_score_id` bigint unsigned NOT NULL,
            `score_id` bigint unsigned NOT NULL,
            PRIMARY KEY (`ruleset_id`,`old_score_id`)
        )');
        DB::statement('CREATE VIEW score_legacy_id_map AS SELECT * FROM solo_scores_legacy_id_map');

        DB::statement('CREATE TABLE `solo_scores_performance` (
            `score_id` bigint unsigned NOT NULL,
            `pp` float DEFAULT NULL,
            PRIMARY KEY (`score_id`)
        )');
        DB::statement('CREATE VIEW score_performance AS SELECT * FROM solo_scores_performance');

        static::resetView();
    }
};
