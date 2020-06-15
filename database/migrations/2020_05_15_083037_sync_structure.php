<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SyncStructure extends Migration
{
    const MODE_SUFFIXES = ['', '_fruits', '_mania', '_taiko'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artist_albums', function (Blueprint $table) {
            $table->dropForeign('artist_albums_artist_id_foreign');
            $table->foreign('artist_id')
                ->references('id')
                ->on('artists')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('artist_tracks', function (Blueprint $table) {
            $table->dropForeign('artist_tracks_artist_id_foreign');
            $table->foreign('artist_id')
                ->references('id')
                ->on('artists')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->dropForeign('artist_tracks_album_id_foreign');
            $table->foreign('album_id')
                ->references('id')
                ->on('artist_albums')
                ->onDelete('set null')
                ->onUpdate('restrict');
        });
        Schema::table('artists', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable()->change();
            $table->dropForeign('artists_label_id_foreign');
            $table->foreign('label_id')
                ->references('id')
                ->on('labels')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('beatmap_discussion_posts', function (Blueprint $table) {
            $table->dropForeign('beatmap_discussion_posts_beatmap_discussion_id_foreign');
            $table->dropForeign('beatmap_discussion_posts_deleted_by_id_foreign');
            $table->dropForeign('beatmap_discussion_posts_last_editor_id_foreign');
            $table->dropForeign('beatmap_discussion_posts_user_id_foreign');
        });
        Schema::table('beatmap_discussion_votes', function (Blueprint $table) {
            $table->dropForeign('beatmap_discussion_votes_beatmap_discussion_id_foreign');
            $table->dropForeign('beatmap_discussion_votes_user_id_foreign');
        });
        Schema::table('beatmap_discussions', function (Blueprint $table) {
            $table->dropForeign('beatmap_discussions_beatmap_id_foreign');
            $table->dropForeign('beatmap_discussions_user_id_foreign');
            $table->dropForeign('beatmap_discussions_beatmapset_id_foreign');
            $table->dropForeign('beatmap_discussions_deleted_by_id_foreign');
            $table->dropForeign('beatmap_discussions_kudosu_denied_by_id_foreign');
            $table->dropForeign('beatmap_discussions_resolver_id_foreign');
        });
        Schema::table('beatmap_discussion_posts', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
            $table->integer('last_editor_id')->unsigned()->nullable()->change();
            $table->integer('deleted_by_id')->unsigned()->nullable()->change();
        });
        Schema::table('beatmap_discussion_votes', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('beatmap_discussions', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->integer('resolver_id')->unsigned()->change();
            $table->integer('deleted_by_id')->unsigned()->change();
            $table->integer('kudosu_denied_by_id')->unsigned()->change();
        });
        DB::statement('ALTER TABLE beatmapset_events CHANGE user_id user_id int unsigned DEFAULT NULL');
        Schema::table('beatmapset_events', function (Blueprint $table) {
            $table->dropForeign('beatmapset_events_beatmapset_id_foreign');
        });
        Schema::table('beatmapset_watches', function (Blueprint $table) {
            $table->dropForeign('beatmapset_watches_beatmapset_id_foreign');
            $table->dropForeign('beatmapset_watches_user_id_foreign');
        });
        Schema::table('beatmapset_watches', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->default(0)->change();
        });
        Schema::table('changelog_entries', function (Blueprint $table) {
            $table->integer('github_user_id')->unsigned()->change();
        });
        Schema::table('comment_votes', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->default(0)->change();
        });
        DB::statement('ALTER TABLE comments CHANGE user_id user_id int unsigned DEFAULT NULL');
        DB::statement('ALTER TABLE comments CHANGE edited_by_id edited_by_id int unsigned DEFAULT NULL');
        DB::statement('ALTER TABLE comments CHANGE deleted_by_id deleted_by_id int unsigned DEFAULT NULL');
        Schema::table('contest_entries', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->dropForeign('contest_entries_contest_id_foreign');
            $table->foreign('contest_id')
                ->references('id')
                ->on('contests')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        DB::statement('ALTER TABLE contest_votes CHANGE weight weight double NOT NULL DEFAULT 1');
        Schema::table('contest_votes', function (Blueprint $table) {
            $table->dropForeign('contest_votes_user_id_foreign');
            $table->dropForeign('contest_votes_contest_entry_id_foreign');
            $table->foreign('contest_entry_id', '_contest_votes_contest_entry_id_foreign')
                ->references('id')
                ->on('contest_entries')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->dropForeign('contest_votes_contest_id_foreign');
            $table->index('contest_entry_id', 'contest_votes_contest_entry_id_foreign');
            $table->foreign('contest_id', '_contest_votes_contest_id_foreign')
                ->references('id')
                ->on('contests')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('contest_votes', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->default(0)->change();
        });
        DB::statement('ALTER TABLE contests CHANGE extra_options extra_options text');
        DB::statement('ALTER TABLE failed_jobs CHANGE failed_at failed_at timestamp NULL DEFAULT NULL');
        DB::statement('ALTER TABLE follows CHANGE user_id user_id int unsigned NOT NULL DEFAULT 0');
        Schema::table('forum_forum_covers', function (Blueprint $table) {
            $table->dropForeign('forum_forum_covers_user_id_foreign');
            $table->dropForeign('forum_forum_covers_forum_id_foreign');
        });
        Schema::table('forum_forum_covers', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
            $table->foreign('forum_id', '_forum_forum_covers_forum_id_foreign')
                ->references('forum_id')
                ->on('phpbb_forums')
                ->onDelete('set null')
                ->onUpdate('restrict');
        });
        Schema::table('forum_topic_covers', function (Blueprint $table) {
            $table->dropForeign('forum_topic_covers_topic_id_foreign');
            $table->dropForeign('forum_topic_covers_user_id_foreign');
        });
        Schema::table('forum_topic_covers', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('github_users', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->default(null)->change();
        });
        Schema::table('multiplayer_rooms', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
            $table->bigInteger('total_score')->unsigned()->nullable()->default(0)->change();
        });
        DB::statement('ALTER TABLE multiplayer_scores CHANGE user_id user_id int unsigned NOT NULL DEFAULT 0');
        Schema::table('multiplayer_scores_high', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('news_posts', function (Blueprint $table) {
            $table->dropIndex('news_posts_hash_unique');
        });
        DB::statement('ALTER TABLE notifications CHANGE source_user_id source_user_id int unsigned DEFAULT NULL');
        Schema::table('oauth_access_tokens', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->default(null)->change();
            $table->dropIndex('oauth_access_tokens_expires_at_index');
            $table->index('expires_at');
        });
        Schema::table('oauth_auth_codes', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('oauth_clients', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->default(null)->change();
        });
        Schema::table('osu_apikeys', function (Blueprint $table) {
            $table->string('app_url', 512)->nullable(false)->default('')->change();
        });
        Schema::table('osu_badges', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        DB::statement('ALTER TABLE osu_beatmap_difficulty CHANGE last_update last_update timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        DB::statement('ALTER TABLE osu_beatmap_difficulty CHANGE diff_unified diff_unified float NOT NULL');
        Schema::table('osu_beatmap_failtimes', function (Blueprint $table) {
            $table->unique(['beatmap_id', 'type'], 'beatmap_id');
            $table->dropPrimary(['beatmap_id', 'type']);
        });
        Schema::table('osu_beatmappacks', function (Blueprint $table) {
            $table->dropIndex('osu_beatmappacks_tag_unique');
            $table->unique('tag', 'tag');
        });
        Schema::table('osu_beatmappacks_items', function (Blueprint $table) {
            $table->dropIndex('osu_beatmappacks_items_pack_id_beatmapset_id_index');
            $table->dropIndex('osu_beatmappacks_items_beatmapset_id_index');
            $table->index(['pack_id', 'beatmapset_id'], 'pack_id');
            $table->index('beatmapset_id', 'set_lookup');
        });
        DB::statement('ALTER TABLE osu_beatmaps CHANGE diff_drain diff_drain float unsigned NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE osu_beatmaps CHANGE diff_size diff_size float unsigned NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE osu_beatmaps CHANGE diff_overall diff_overall float unsigned NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE osu_beatmaps CHANGE diff_approach diff_approach float unsigned NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE osu_beatmaps CHANGE difficultyrating difficultyrating float NOT NULL DEFAULT 0');
        Schema::table('osu_beatmaps', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
            $table->integer('playcount')->unsigned()->nullable(false)->default(0)->change();
            $table->integer('passcount')->unsigned()->nullable(false)->default(0)->change();
            $table->tinyInteger('score_version')->nullablee(false)->default(1)->after('youtube_preview');
        });
        DB::statement('ALTER TABLE osu_beatmapsets CHANGE bpm bpm float NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE osu_beatmapsets CHANGE rating rating float unsigned NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE osu_beatmapsets CHANGE approved approved tinyint NOT NULL DEFAULT 0');
        DB::statement('CREATE FULLTEXT INDEX fulltext_search ON osu_beatmapsets (artist, artist_unicode, title, title_unicode, creator, source, tags, difficulty_names)');
        Schema::table('osu_beatmapsets', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
            $table->integer('play_count')->unsigned()->nullable(false)->default(0)->change();
            $table->string('difficulty_names', 2048)->default(null)->change();
            $table->string('storyboard_hash', 32)->nullable();
        });
        DB::statement('ALTER TABLE osu_builds CHANGE hash hash binary(16) DEFAULT NULL AFTER version');
        DB::statement('ALTER TABLE osu_builds CHANGE last_hash last_hash binary(16) DEFAULT NULL AFTER hash');
        Schema::table('osu_builds', function (Blueprint $table) {
            $table->string('version', 40)->nullable()->change();
            $table->boolean('allow_ranking')->nullable(false)->default(true)->change();
            $table->boolean('allow_bancho')->nullable(false)->default(true)->change();
            $table->boolean('test_build')->nullable(false)->default(false)->change();
            $table->unique(['stream_id', 'version'], 'stream_id');
            $table->dropIndex('osu_builds_stream_id_index');
            $table->index('hash', 'hash');
            $table->index('version', 'version');
            $table->index('allow_bancho', 'allow_bancho');
            $table->index('stream_id');
        });
        Schema::table('osu_changelog', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
            $table->string('checksum', 50)->nullable()->default('')->change();
        });
        DB::statement('ALTER TABLE osu_countries CHANGE shipping_rate shipping_rate float NOT NULL DEFAULT 1');
        Schema::table('osu_downloads', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('osu_events', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable()->default(null)->change();
        });
        Schema::table('osu_favouritemaps', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        DB::statement('ALTER TABLE osu_ip_bans CHANGE active active tinyint unsigned NOT NULL DEFAULT 1');
        Schema::table('osu_ip_bans', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable()->default(null)->change();
            $table->dropIndex('user_id');
            $table->index('user_id', 'user_id');
        });
        foreach (static::MODE_SUFFIXES as $modeSuffix) {
            Schema::table("osu_leaders{$modeSuffix}", function (Blueprint $table) {
                $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
                $table->integer('score_id')->unsigned()->nullable()->default(null)->change();
            });
        }
        Schema::table('osu_login_attempts', function (Blueprint $table) {
            $table->longText('failed_ids')->nullable(false)->change();
        });
        DB::statement('ALTER TABLE osu_mirrors CHANGE mirror_id mirror_id tinyint NOT NULL AUTO_INCREMENT');
        Schema::table('osu_mirrors', function (Blueprint $table) {
            $table->integer('provider_user_id')->unsigned()->nullable(false)->default(0)->change();
            $table->renameColumn('pending_updates', 'perform_updates');
            $table->boolean('is_master')->nullable(false)->default(false);
        });
        DB::statement("ALTER TABLE osu_profile_banners CHANGE country_acronym country_acronym char(2) NOT NULL DEFAULT ''");
        Schema::table('osu_profile_banners', function (Blueprint $table) {
            $table->dropIndex('osu_profile_banners_user_id_tournament_id_index');
            $table->index(['user_id', 'tournament_id'], 'user_id');
        });
        DB::statement('ALTER TABLE osu_scores CHANGE score_id score_id bigint unsigned NOT NULL AUTO_INCREMENT');
        foreach (static::MODE_SUFFIXES as $modeSuffix) {
            DB::statement("ALTER TABLE osu_scores{$modeSuffix} CHANGE user_id user_id int unsigned NOT NULL");
            DB::statement("ALTER TABLE osu_scores{$modeSuffix} CHANGE enabled_mods enabled_mods int unsigned NOT NULL DEFAULT 0");

            DB::statement("ALTER TABLE osu_scores{$modeSuffix}_high CHANGE user_id user_id int unsigned NOT NULL");
            DB::statement("ALTER TABLE osu_scores{$modeSuffix}_high CHANGE pp pp float DEFAULT NULL");
            DB::statement("ALTER TABLE osu_scores{$modeSuffix}_high DROP beatmapset_id");
        }
        Schema::table('osu_user_achievements', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->change();
        });
        Schema::table('osu_user_beatmap_playcount', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('osu_user_beatmapset_ratings', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('osu_user_donations', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
            $table->integer('target_user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('osu_user_month_playcount', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('osu_user_replayswatched', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        DB::statement('ALTER TABLE osu_user_reports CHANGE user_id user_id int unsigned NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE osu_user_reports CHANGE reporter_id reporter_id int unsigned NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE osu_user_reports CHANGE comments comments text');
        DB::statement('ALTER TABLE osu_user_security CHANGE disk_md5 disk_md5 binary(16) NOT NULL');
        DB::statement("ALTER TABLE osu_user_security CHANGE mac_md5 mac_md5 binary(16) NOT NULL DEFAULT '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0' COMMENT 'this isn''t used anywhere, and can likely be deleted in the future'");
        Schema::table('osu_user_security', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        foreach (static::MODE_SUFFIXES as $modeSuffix) {
            DB::statement("ALTER TABLE osu_user_stats{$modeSuffix} CHANGE user_id user_id int unsigned NOT NULL");
            DB::statement("ALTER TABLE osu_user_stats{$modeSuffix} CHANGE accuracy accuracy float NOT NULL");
            DB::statement("ALTER TABLE osu_user_stats{$modeSuffix} CHANGE total_seconds_played total_seconds_played bigint NOT NULL DEFAULT 0 AFTER last_played");
            DB::statement("ALTER TABLE osu_user_stats{$modeSuffix} CHANGE xh_rank_count xh_rank_count mediumint DEFAULT 0");
            DB::statement("ALTER TABLE osu_user_stats{$modeSuffix} CHANGE sh_rank_count sh_rank_count mediumint DEFAULT 0");
            DB::statement("ALTER TABLE osu_user_stats{$modeSuffix} CHANGE level level float unsigned NOT NULL");
            DB::statement("ALTER TABLE osu_user_stats{$modeSuffix} CHANGE rank_score rank_score float unsigned NOT NULL");
            DB::statement("ALTER TABLE osu_user_stats{$modeSuffix} CHANGE accuracy_new accuracy_new float unsigned NOT NULL");
        }
        Schema::table('osu_user_stats_fruits', function (Blueprint $table) {
            $table->dropIndex('country_acronym');
            $table->index(['country_acronym', 'rank_score'], 'country_acronym_2');
        });
        Schema::table('osu_user_stats_taiko', function (Blueprint $table) {
            $table->dropIndex('country_acronym');
            $table->index(['country_acronym', 'rank_score'], 'country_acronym_2');
        });
        Schema::table('phpbb_forums', function (Blueprint $table) {
            $table->integer('forum_last_poster_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('phpbb_forums_track', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        DB::statement('ALTER TABLE phpbb_groups CHANGE group_legend group_legend tinyint unsigned NOT NULL DEFAULT 1');
        Schema::table('phpbb_log', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('phpbb_poll_votes', function (Blueprint $table) {
            $table->integer('vote_user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('phpbb_posts', function (Blueprint $table) {
            $table->integer('poster_id')->unsigned()->nullable(false)->default(0)->change();
            $table->integer('post_edit_user')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('phpbb_sessions', function (Blueprint $table) {
            $table->integer('session_user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        DB::statement('ALTER TABLE phpbb_topics CHANGE topic_poster topic_poster int unsigned NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE phpbb_topics CHANGE topic_last_poster_id topic_last_poster_id int unsigned NOT NULL DEFAULT 0');
        DB::statement('CREATE INDEX phpbb_topics_topic_moved_id_index ON phpbb_topics (topic_moved_id)');
        DB::statement('CREATE INDEX phpbb_topics_topic_poster_index ON phpbb_topics (topic_poster)');
        DB::statement('CREATE INDEX phpbb_topics_topic_last_poster_id_index ON phpbb_topics (topic_last_poster_id)');
        DB::statement('ALTER TABLE phpbb_topics_stars CHANGE user_id user_id int unsigned NOT NULL DEFAULT 0');
        Schema::table('phpbb_topics_track', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        DB::statement('ALTER TABLE phpbb_topics_watch CHANGE user_id user_id int unsigned NOT NULL DEFAULT 0 AFTER topic_id');
        Schema::table('phpbb_topics_watch', function (Blueprint $table) {
            $table->dropIndex('topic_id');
            $table->index('topic_id', 'topic_id');
        });
        Schema::table('phpbb_user_group', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        DB::statement('ALTER TABLE user_profile_customizations DROP FOREIGN KEY user_profile_customizations_user_id_foreign');
        DB::statement('ALTER TABLE user_profile_customizations CHANGE user_id user_id int unsigned NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE user_profile_customizations CHANGE created_at created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP');
        DB::statement('ALTER TABLE user_profile_customizations CHANGE updated_at updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP');
        DB::statement('ALTER TABLE phpbb_users CHANGE user_id user_id int unsigned NOT NULL AUTO_INCREMENT');
        Schema::table('phpbb_users', function (Blueprint $table) {
            $table->longText('user_permissions')->nullable(false)->change();
            $table->mediumText('user_occ')->nullable(false)->change();
            $table->mediumText('user_interests')->nullable(false)->change();
            $table->index('osu_subscriber', 'osu_supporter_status');
            $table->index(['user_id', 'country_acronym', 'user_warnings', 'username'], 'country_lookup');
        });
        DB::statement('ALTER TABLE phpbb_users CHANGE osu_mapperrank osu_mapperrank float NOT NULL DEFAULT 0');
        Schema::table('phpbb_zebra', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
            $table->integer('zebra_id')->unsigned()->nullable(false)->default(0)->change();
            $table->index(['zebra_id', 'friend'], 'zebra_friend');
        });
        DB::statement('ALTER TABLE score_process_queue CHANGE queue_id queue_id int unsigned NOT NULL');
        Schema::table('score_process_queue', function (Blueprint $table) {
            $table->dropPrimary('queue_id');
            $table->dropIndex('status');
            $table->dropIndex('lookup');
            $table->primary(['queue_id', 'start_time']);
            $table->index('status', 'status');
            $table->index(['mode', 'status', 'queue_id'], 'lookup_v3');
            $table->index('score_id', 'temp_pp_processor');
        });
        DB::statement('ALTER TABLE score_process_queue CHANGE queue_id queue_id int unsigned NOT NULL AUTO_INCREMENT');
        DB::statement('ALTER TABLE tournament_registrations CHANGE created_at created_at timestamp NOT NULL');
        DB::statement('ALTER TABLE tournament_registrations CHANGE updated_at updated_at timestamp NOT NULL');
        Schema::table('tournament_registrations', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });
        Schema::table('user_contest_entries', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
            $table->boolean('show_in_client')->nullable(true)->default(0)->change();
        });
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable(false)->default(0)->change();
        });

        $mp = Schema::connection('mysql-mp');

        $mp->table('events', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable()->default(null)->change();
        });
        $mp->getConnection()->statement('ALTER TABLE game_scores CHANGE user_id user_id int unsigned NOT NULL');
        $mp->table('games', function (Blueprint $table) {
            $table->dropIndex('match_lookup');
            $table->index('match_id', 'match lookup');
        });

        $chat = Schema::connection('mysql-chat');

        $chat->getConnection()->statement("ALTER TABLE channels CHANGE name name varchar(50) NOT NULL DEFAULT ''");
        $chat->getConnection()->statement("ALTER TABLE channels CHANGE description description varchar(256) NOT NULL DEFAULT ''");
        $chat->table('messages_private', function (Blueprint $table) {
            $table->dropIndex('user_id');
            $table->dropIndex('target_id');
            $table->index(['user_id', 'timestamp'], 'user_id');
            $table->index('target_id', 'target_id');
        });

        $store = Schema::connection('mysql-store');

        $store->table('payments', function (Blueprint $table) {
            $table->string('transaction_id', 255)->nullable(false)->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // no going back =)
    }
}
