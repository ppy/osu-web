<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class BaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('osu_achievements', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumIncrements('achievement_id');
            $table->string('name', 40);
            $table->string('image', 50);
            $table->string('grouping', 30)->default('-');
            $table->unsignedTinyInteger('ordering');
            $table->unsignedTinyInteger('progression');
            $table->tinyInteger('quest_ordering')->nullable();
            $table->text('quest_instructions')->nullable();

            $table->index(['grouping', 'ordering'], 'display_order');
            $table->index('quest_ordering', 'quest_ordering');
        });
        $this->setRowFormat('osu_achievements', 'DYNAMIC');

        Schema::create('osu_apikeys', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('key');
            $table->unsignedInteger('user_id');
            $table->string('app_name', 100)->default('');
            $table->string('app_url', 100)->default('');
            $table->string('api_key', 52)->default('');
            $table->boolean('enabled')->default(true);
            $table->UnsignedBigInteger('hit_count')->default(0);
            $table->UnsignedInteger('miss_count')->default(0);
            $table->tinyInteger('revoked')->default(0);

            $table->unique('api_key', 'api_key');
        });
        $this->setRowFormat('osu_apikeys', 'DYNAMIC');

        Schema::create('osu_badges', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->unsignedMediumInteger('user_id');
            $table->string('image', 255);
            $table->string('description', 255);
            $table->timestamp('awarded')->nullable()->useCurrent();
            $table->primary(['user_id', 'image']);
        });
        $this->setRowFormat('osu_badges', 'DYNAMIC');

        Schema::create('osu_beatmap_difficulty', function (Blueprint $table) {
            $table->charset = 'utf8mb4';

            $table->unsignedInteger('beatmap_id');
            $table->tinyInteger('mode')->default(0);
            $table->unsignedInteger('mods');
            $table->float('diff_unified', null, null); // creates a double instead of float.
            $table->timestamp('last_update')->useCurrent();

            $table->primary(['beatmap_id', 'mode', 'mods'], 'osu_beatmap_difficulty_primary');
            $table->index(['mode', 'mods', 'diff_unified'], 'diff_sort');
        });

        Schema::create('osu_beatmap_difficulty_attribs', function (Blueprint $table) {
            $table->unsignedMediumInteger('beatmap_id');
            $table->unsignedTinyInteger('mode');
            $table->unsignedInteger('mods');
            $table->unsignedTinyInteger('attrib_id')->comment('see osu_difficulty_attribs table');

            $table->primary(['beatmap_id', 'mode', 'mods', 'attrib_id'], 'attribs_primary');
        });

        DB::statement('ALTER TABLE osu_beatmap_difficulty_attribs ADD value float null');

        Schema::create('osu_beatmaps', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumIncrements('beatmap_id');
            $table->unsignedMediumInteger('beatmapset_id')->nullable();
            $table->unsignedMediumInteger('user_id')->default('0');
            $column = $table->string('filename', 150)->nullable();
            $column->collation = 'utf8_bin';
            $column = $table->string('checksum', 32)->nullable();
            $column->charset = 'utf8';
            $column = $table->string('version', 80)->default('');
            $column->charset = 'latin1';
            $table->UnsignedMediumInteger('total_length')->default(0);
            $table->UnsignedMediumInteger('hit_length')->default(0);
            $table->UnsignedSmallInteger('countTotal')->default(0);
            $table->UnsignedSmallInteger('countNormal')->default(0);
            $table->UnsignedSmallInteger('countSlider')->default(0);
            $table->UnsignedSmallInteger('countSpinner')->default(0);
            $table->float('diff_drain')->unsigned()->default(0);
            $table->float('diff_size')->unsigned()->default(0);
            $table->float('diff_overall')->unsigned()->default(0);
            $table->float('diff_approach')->unsigned()->default(0);
            $table->UnsignedTinyInteger('playmode')->default(0);
            $table->TinyInteger('approved')->default(0);
            $table->timestamp('last_update')->useCurrent();
            $table->float('difficultyrating')->default(0);
            $table->UnsignedMediumInteger('playcount')->default(0);
            $table->UnsignedMediumInteger('passcount')->default(0);
            $table->boolean('orphaned')->default(false);
            $column = $table->string('youtube_preview', 50)->nullable();
            $column->collation = 'utf8_bin';

            $table->index('beatmapset_id', 'beatmapset_id');
            $table->index('filename', 'filename');
            $table->index('checksum', 'checksum');
            $table->index('user_id', 'user_id');
        });

        $this->setRowFormat('osu_beatmaps', 'DYNAMIC');

        Schema::create('osu_beatmapsets', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumIncrements('beatmapset_id');
            $table->mediumInteger('user_id')->unsigned()->default(0);
            $table->mediumInteger('thread_id')->unsigned()->default(0);
            $table->string('artist', 80)->default('');
            $table->string('artist_unicode', 80)->nullable();
            $table->string('title', 80)->default('');
            $table->string('title_unicode', 80)->nullable();
            $table->string('creator', 80)->default('');
            $table->string('source', 200)->default('');
            $table->string('tags', 1000)->default('');
            $table->boolean('video')->default(0);
            $table->boolean('storyboard')->default(0);
            $table->boolean('epilepsy')->default(0);
            $table->float('bpm')->default(0);
            $table->boolean('versions_available')->unsigned()->default(1);
            $table->boolean('approved')->default(0);
            $table->mediumInteger('approvedby_id')->unsigned()->nullable();
            $table->dateTime('approved_date')->nullable();
            $table->dateTime('submit_date')->nullable();
            $table->timestamp('last_update')->useCurrent();
            $column = $table->string('filename', 120)->nullable()->index('filename');
            $column->charset = 'utf8';
            $column->collation = 'utf8_bin';
            $table->boolean('active')->default(1);
            $table->float('rating')->unsigned()->default(0);
            $table->smallInteger('offset')->default(0);
            $table->string('displaytitle', 200)->default('');
            $table->smallInteger('genre_id')->unsigned()->default(1);
            $table->smallInteger('language_id')->unsigned()->default(1);
            $table->smallInteger('star_priority')->default(0);
            $table->bigInteger('filesize')->default(0);
            $table->bigInteger('filesize_novideo')->nullable();
            // $table->binary('body_hash', 16)->nullable();
            // $table->binary('header_hash', 16)->nullable();
            // $table->binary('osz2_hash', 16)->nullable();
            $table->boolean('download_disabled')->unsigned()->default(0);
            $column = $table->string('download_disabled_url', 100)->nullable();
            $column->charset = 'utf8';
            $column->collation = 'utf8_bin';
            $table->dateTime('thread_icon_date')->nullable();
            $table->mediumInteger('favourite_count')->unsigned()->default(0);
            $table->mediumInteger('play_count')->unsigned()->default(0);
            $table->string('difficulty_names', 1024)->nullable();
            $table->index('user_id', 'user_id');
            $table->index('thread_id', 'thread_id');
            $table->index('genre_id', 'genre_id');
            $table->index(['approved', 'star_priority'], 'approved_2');
            $table->index(['approved', 'active', 'approved_date'], 'approved');
            $table->index('favourite_count', 'favourite_count');
            $table->index(['approved', 'active', 'last_update'], 'approved_3');
        });
        $this->addBinary('osu_beatmapsets', 'body_hash', 16, true, 'filesize_novideo');
        $this->addBinary('osu_beatmapsets', 'header_hash', 16, true, 'body_hash');
        $this->addBinary('osu_beatmapsets', 'osz2_hash', 16, true, 'header_hash');
        $this->setRowFormat('osu_beatmapsets', 'DYNAMIC');

        Schema::create('osu_user_beatmapset_ratings', function (Blueprint $table) {
            $table->unsignedMediumInteger('user_id');
            $table->unsignedMediumInteger('beatmapset_id');
            $table->unsignedTinyInteger('rating');
            $table->timestamp('date')->useCurrent();

            $table->primary(['user_id', 'beatmapset_id']);
            $table->index(['beatmapset_id', 'rating'], 'split_ratings');
        });
        $this->setRowFormat('osu_user_beatmapset_ratings', 'COMPRESSED');

        Schema::create('osu_changelog', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumIncrements('changelog_id');
            $table->mediumInteger('user_id')->unsigned();
            $table->char('prefix', 1)->default('*');
            $table->string('category', 50)->default('');
            $table->string('message', 8000)->default('');
            $table->string('checksum', 40)->default('');
            $table->timestamp('date')->useCurrent();
            $table->boolean('private')->default(0);
            $table->boolean('major')->default(0);
            $table->boolean('tweet')->default(0);
            $table->string('build', 50)->nullable();
            $table->integer('thread_id')->unsigned()->nullable();
            $table->string('url', 1024)->nullable();
            $table->boolean('stream_id')->unsigned()->nullable()->index('stream_id');
            $table->unique('checksum', 'unique_checksum');
            $table->index('date', 'time');
            $table->index(['build', 'date'], 'major_release');
            $table->index(['category', 'changelog_id'], 'category');
        });
        $this->setRowFormat('osu_changelog', 'DYNAMIC');

        Schema::create('osu_charts', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->unsignedSmallInteger('chart_id', true);
            $table->string('acronym', 10)->default('');
            $table->string('name', 50)->default('');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('mode_specific')->default(0);
            $table->string('type', 50)->default('monthly');
            $table->boolean('active')->default(1);
            $table->date('chart_month')->nullable();
            $table->unique('acronym', 'acronym');
            $table->index('end_date', 'enddate');
            $table->index(['type', 'chart_month'], 'type');
        });
        $this->setRowFormat('osu_charts', 'DYNAMIC');

        Schema::create('osu_builds', function ($table) {
            $table->mediumIncrements('build_id');
            $table->string('version', 40)->nullable();
            $table->timestamp('date')->useCurrent();
            $table->tinyInteger('allow_ranking')->default(1);
            $table->tinyInteger('allow_bancho')->default(1);
            $table->tinyInteger('test_build')->default(0);
            $table->string('comments', 200)->nullable();
            $table->unsignedMediumInteger('users')->default(0);
            $table->unsignedTinyInteger('stream_id')->nullable();
        });
        DB::statement('ALTER TABLE osu_builds ADD hash BINARY(16)');
        DB::statement('ALTER TABLE osu_builds ADD last_hash BINARY(16)');

        Schema::create('osu_countries', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->char('acronym', 2)->primary();
            $table->string('name', 150);
            $table->bigInteger('rankedscore');
            $table->bigInteger('playcount');
            $table->bigInteger('usercount')->default(0);
            $table->bigInteger('pp')->default(0);
            $table->boolean('display')->default(1);
            $table->float('shipping_rate')->default(1);
            $table->index('rankedscore', 'rankedscore');
            $table->index('playcount', 'playcount');
            $table->index(['display', 'name'], 'display');
        });
        $this->setRowFormat('osu_countries', 'DYNAMIC');

        Schema::create('osu_counts', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->string('name', 200)->primary();
            $table->bigInteger('count')->unsigned();
        });
        $this->setRowFormat('osu_counts', 'DYNAMIC');

        Schema::create('osu_downloads', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->unsignedMediumInteger('user_id');
            $table->integer('timestamp');
            $table->mediumInteger('beatmapset_id');
            $table->tinyInteger('fulfilled')->default(0);
            $table->unsignedTinyInteger('mirror_id')->default(0);

            $table->index(['user_id', 'timestamp', 'beatmapset_id'], 'user_id');
        });
        $this->setRowFormat('osu_downloads', 'DYNAMIC');

        Schema::create('osu_events', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('event_id');
            $table->string('text', 1000);
            $table->string('text_clean', 8000)->nullable();
            $table->mediumInteger('beatmap_id')->unsigned()->nullable();
            $table->mediumInteger('beatmapset_id')->unsigned()->nullable();
            $table->mediumInteger('user_id')->unsigned()->nullable();
            $table->timestamp('date')->useCurrent();
            $table->boolean('epicfactor')->unsigned()->default(0);
            $table->boolean('private')->unsigned()->default(0);
            // $table->primary(['event_id', 'date']);
            $table->index(['user_id', 'event_id'], 'user_id');
        });
        DB::statement('ALTER TABLE `osu_events` DROP PRIMARY KEY, ADD PRIMARY KEY (`event_id`, `date`)');
        $this->comment('osu_events', 'holds events up to one month in the past');
        $this->setRowFormat('osu_events', 'COMPRESSED');

        Schema::create('osu_favouritemaps', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumInteger('user_id')->unsigned();
            $table->mediumInteger('beatmapset_id')->unsigned()->index('beatmapset_id');
            $table->timestamp('dateadded')->useCurrent();
            $table->primary(['user_id', 'beatmapset_id']);
        });
        $this->setRowFormat('osu_favouritemaps', 'DYNAMIC');

        Schema::create('osu_genres', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->smallIncrements('genre_id');
            $table->string('name', 200);
        });
        $this->setRowFormat('osu_genres', 'DYNAMIC');

        Schema::create('osu_kudos_exchange', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumIncrements('exchange_id');
            $table->mediumInteger('giver_id')->unsigned();
            $table->mediumInteger('receiver_id')->unsigned();
            $table->mediumInteger('post_id')->unsigned();
            $table->enum('action', ['give', 'revoke', 'reset']);
            $table->boolean('amount')->default(1);
            $table->timestamp('date')->useCurrent();
            $table->unique(['receiver_id', 'exchange_id'], 'history_display');
            $table->index('giver_id', 'giver_id');
            $table->index(['receiver_id', 'date'], 'receiver_id');
        });
        $this->setRowFormat('osu_kudos_exchange', 'COMPRESSED');

        Schema::create('osu_languages', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->integer('language_id', true);
            $table->string('name', 50);
            $table->boolean('display_order')->default(0)->index('order');
        });
        $this->setRowFormat('osu_languages', 'DYNAMIC');

        Schema::create('osu_leaders_fruits', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumInteger('beatmap_id')->unsigned()->primary();
            $table->mediumInteger('user_id')->unsigned();
            $table->integer('score_id')->nullable();
            $table->index(['user_id', 'score_id'], 'user_id');
        });
        $this->setRowFormat('osu_leaders_fruits', 'DYNAMIC');

        Schema::create('osu_leaders_mania', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumInteger('beatmap_id')->unsigned()->primary();
            $table->mediumInteger('user_id')->unsigned();
            $table->integer('score_id')->nullable();
            $table->index(['user_id', 'score_id'], 'user_id');
        });
        $this->setRowFormat('osu_leaders_mania', 'DYNAMIC');

        Schema::create('osu_leaders', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumInteger('beatmap_id')->unsigned()->primary();
            $table->mediumInteger('user_id')->unsigned();
            $table->integer('score_id')->nullable();
            $table->index(['user_id', 'score_id'], 'user_id');
        });
        $this->setRowFormat('osu_leaders', 'DYNAMIC');

        Schema::create('osu_leaders_taiko', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumInteger('beatmap_id')->unsigned()->primary();
            $table->mediumInteger('user_id')->unsigned();
            $table->integer('score_id')->nullable();
            $table->index(['user_id', 'score_id'], 'user_id');
        });
        $this->setRowFormat('osu_leaders_taiko', 'DYNAMIC');

        Schema::create('osu_login_attempts', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->string('ip', 128)->primary();
            $table->mediumInteger('failed_attempts')->unsigned()->default(1);
            $table->smallInteger('total_attempts')->unsigned()->default(1);
            $table->smallInteger('unique_ids')->unsigned()->default(1);
            $table->text('failed_ids', 65535);
            $table->timestamp('last_attempt')->nullable()->useCurrent()->index('last_attempt');
            $table->timestamp('created_date')->useCurrent();
        });
        $this->setRowFormat('osu_login_attempts', 'DYNAMIC');

        Schema::create('osu_scores_fruits', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->unsignedInteger('score_id'); // autoincrement is set!
            // $table->binary('scorechecksum', 16)->index('scorechecksum');
            $table->mediumInteger('beatmap_id')->unsigned()->default(0);
            $table->mediumInteger('beatmapset_id')->unsigned()->default(0)->index('beatmapset_id');
            $table->mediumInteger('user_id')->default(0);
            $table->integer('score')->default(0);
            $table->smallInteger('maxcombo')->unsigned()->default(0);
            $table->enum('rank', ['0', 'A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH', 'F'])->default('F');
            $table->smallInteger('count50')->unsigned()->default(0);
            $table->smallInteger('count100')->unsigned()->default(0);
            $table->smallInteger('count300')->unsigned()->default(0);
            $table->smallInteger('countmiss')->unsigned()->default(0);
            $table->smallInteger('countgeki')->unsigned()->default(0);
            $table->smallInteger('countkatu')->unsigned()->default(0);
            $table->boolean('perfect')->default(0);
            $table->smallInteger('enabled_mods')->unsigned()->default(0);
            $table->boolean('pass')->default(0);
            $table->timestamp('date')->useCurrent();
            $table->bigInteger('high_score_id')->unsigned()->nullable();
            $table->primary(['score_id', 'date']);
            // $table->index(['user_id','date'], 'user_id');
        });
        // can't create sized blob directly in the migration
        DB::statement('ALTER TABLE `osu_scores_fruits` ADD `scorechecksum` BINARY(16) NOT NULL AFTER `score_id`');
        DB::statement('ALTER TABLE `osu_scores_fruits` ADD KEY (`scorechecksum`)');
        DB::statement('ALTER TABLE `osu_scores_fruits` ADD KEY `user_id` (`user_id`, `date`)');
        DB::statement('ALTER TABLE `osu_scores_fruits` MODIFY COLUMN `score_id` INT UNSIGNED AUTO_INCREMENT');

        Schema::create('osu_mirrors', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->tinyIncrements('mirror_id');
            $table->string('base_url', 255);
            $table->bigInteger('traffic_used')->default(0);
            $table->bigInteger('traffic_limit')->default(0);
            $table->string('secret_key', 50)->default('');
            $table->integer('provider_user_id');
            $table->tinyInteger('enabled')->default(1);
            $table->decimal('version', 4, 2)->nullable();
            $table->string('pending_purge', 8192)->default('');
            $table->tinyInteger('pending_updates')->default(1);
            $table->string('regions', 8192)->nullable();
            $table->bigInteger('disk_space_free')->nullable();
        });
        $this->setRowFormat('osu_mirrors', 'DYNAMIC');

        Schema::create('osu_replays', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->unsignedInteger('score_id')->default(0)->primary();
            $table->unsignedInteger('play_count')->default(0);
            $table->integer('version')->nullable();
        });
        $this->setRowFormat('osu_replays', 'DYNAMIC');

        Schema::create('osu_replays_fruits', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->unsignedInteger('score_id')->default(0)->primary();
            $table->unsignedInteger('play_count')->default(0);
            $table->integer('version')->nullable();
        });
        $this->setRowFormat('osu_replays_fruits', 'DYNAMIC');

        Schema::create('osu_replays_mania', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->unsignedInteger('score_id')->default(0)->primary();
            $table->unsignedInteger('play_count')->default(0);
            $table->integer('version')->nullable();
        });
        $this->setRowFormat('osu_replays_mania', 'DYNAMIC');

        Schema::create('osu_replays_taiko', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->unsignedInteger('score_id')->default(0)->primary();
            $table->unsignedInteger('play_count')->default(0);
            $table->integer('version')->nullable();
        });
        $this->setRowFormat('osu_replays_taiko', 'DYNAMIC');

        Schema::create('osu_scores_fruits_high', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('score_id');
            $table->mediumInteger('beatmap_id')->unsigned()->default(0);
            $table->mediumInteger('beatmapset_id')->unsigned()->default(0);
            $table->mediumInteger('user_id')->default(0);
            $table->integer('score')->default(0);
            $table->smallInteger('maxcombo')->unsigned()->default(0);
            $table->enum('rank', ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH']);
            $table->smallInteger('count50')->unsigned()->default(0);
            $table->smallInteger('count100')->unsigned()->default(0);
            $table->smallInteger('count300')->unsigned()->default(0);
            $table->smallInteger('countmiss')->unsigned()->default(0);
            $table->smallInteger('countgeki')->unsigned()->default(0);
            $table->smallInteger('countkatu')->unsigned()->default(0);
            $table->boolean('perfect')->default(0);
            $table->smallInteger('enabled_mods')->unsigned()->default(0);
            $table->timestamp('date')->useCurrent();
            $table->float('pp')->nullable();
            $table->boolean('replay')->unsigned()->default(0);
            $table->index(['beatmap_id', 'score', 'user_id'], 'beatmap_score_lookup');
            $table->index(['user_id', 'beatmap_id', 'rank'], 'user_beatmap_rank');
        });
        $this->setRowFormat('osu_scores_fruits_high', 'DYNAMIC');
        $this->setRowFormat('osu_scores_fruits', 'DYNAMIC');

        Schema::create('osu_scores_high', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('score_id');
            $table->mediumInteger('beatmap_id')->unsigned()->default(0);
            $table->mediumInteger('beatmapset_id')->unsigned()->default(0);
            $table->mediumInteger('user_id')->default(0);
            $table->integer('score')->default(0);
            $table->smallInteger('maxcombo')->unsigned()->default(0);
            $table->enum('rank', ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH']);
            $table->smallInteger('count50')->unsigned()->default(0);
            $table->smallInteger('count100')->unsigned()->default(0);
            $table->smallInteger('count300')->unsigned()->default(0);
            $table->smallInteger('countmiss')->unsigned()->default(0);
            $table->smallInteger('countgeki')->unsigned()->default(0);
            $table->smallInteger('countkatu')->unsigned()->default(0);
            $table->boolean('perfect')->default(0);
            $table->smallInteger('enabled_mods')->unsigned()->default(0);
            $table->timestamp('date')->useCurrent();
            $table->float('pp')->nullable();
            $table->boolean('replay')->unsigned()->default(0);
            $table->index(['beatmap_id', 'score', 'user_id'], 'beatmap_score_lookup');
            $table->index(['user_id', 'beatmap_id', 'rank'], 'user_beatmap_rank');
        });
        $this->setRowFormat('osu_scores_high', 'DYNAMIC');

        Schema::create('osu_scores_mania_high', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('score_id');
            $table->mediumInteger('beatmap_id')->unsigned()->default(0);
            $table->mediumInteger('beatmapset_id')->unsigned()->default(0);
            $table->mediumInteger('user_id')->default(0);
            $table->integer('score')->default(0);
            $table->smallInteger('maxcombo')->unsigned()->default(0);
            $table->enum('rank', ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH']);
            $table->smallInteger('count50')->unsigned()->default(0);
            $table->smallInteger('count100')->unsigned()->default(0);
            $table->smallInteger('count300')->unsigned()->default(0);
            $table->smallInteger('countmiss')->unsigned()->default(0);
            $table->smallInteger('countgeki')->unsigned()->default(0);
            $table->smallInteger('countkatu')->unsigned()->default(0);
            $table->boolean('perfect')->default(0);
            $table->integer('enabled_mods')->unsigned()->default(0);
            $table->timestamp('date')->useCurrent();
            $table->float('pp')->nullable();
            $table->boolean('replay')->unsigned()->default(0);
            $table->index(['beatmap_id', 'score', 'user_id'], 'beatmap_score_lookup');
            $table->index(['user_id', 'beatmap_id', 'rank'], 'user_beatmap_rank');
        });
        $this->setRowFormat('osu_scores_mania_high', 'DYNAMIC');

        Schema::create('osu_scores_mania', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->integer('score_id', false, true);
            // $table->binary('scorechecksum', 16)->index('scorechecksum');
            $table->mediumInteger('beatmap_id')->unsigned()->default(0);
            $table->mediumInteger('beatmapset_id')->unsigned()->default(0)->index('beatmapset_id');
            $table->mediumInteger('user_id')->default(0);
            $table->integer('score')->default(0);
            $table->smallInteger('maxcombo')->unsigned()->default(0);
            $table->enum('rank', ['0', 'A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH', 'F'])->default('F');
            $table->smallInteger('count50')->unsigned()->default(0);
            $table->smallInteger('count100')->unsigned()->default(0);
            $table->smallInteger('count300')->unsigned()->default(0);
            $table->smallInteger('countmiss')->unsigned()->default(0);
            $table->smallInteger('countgeki')->unsigned()->default(0);
            $table->smallInteger('countkatu')->unsigned()->default(0);
            $table->boolean('perfect')->default(0);
            $table->integer('enabled_mods')->unsigned()->default(0);
            $table->boolean('pass')->default(0);
            $table->timestamp('date')->useCurrent();
            $table->bigInteger('high_score_id')->unsigned()->nullable();
            $table->primary(['score_id', 'date']);
            // $table->index(['user_id','date'], 'user_id');
        });
        DB::statement('ALTER TABLE `osu_scores_mania` ADD `scorechecksum` BINARY(16) NOT NULL AFTER `score_id`');
        DB::statement('ALTER TABLE `osu_scores_mania` ADD KEY (`scorechecksum`)');
        DB::statement('ALTER TABLE `osu_scores_mania` ADD KEY `user_id` (`user_id`, `date`)');
        DB::statement('ALTER TABLE `osu_scores_mania` MODIFY COLUMN `score_id` INT UNSIGNED AUTO_INCREMENT');
        $this->setRowFormat('osu_scores_mania', 'DYNAMIC');

        Schema::create('osu_scores', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->unsignedInteger('score_id');
            // $table->binary('scorechecksum', 16)->index('scorechecksum');
            $table->mediumInteger('beatmap_id')->unsigned()->default(0);
            $table->mediumInteger('beatmapset_id')->unsigned()->default(0);
            $table->mediumInteger('user_id')->default(0);
            $table->integer('score')->default(0);
            $table->smallInteger('maxcombo')->unsigned()->default(0);
            $table->enum('rank', ['0', 'A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH', 'F'])->default('F');
            $table->smallInteger('count50')->unsigned()->default(0);
            $table->smallInteger('count100')->unsigned()->default(0);
            $table->smallInteger('count300')->unsigned()->default(0);
            $table->smallInteger('countmiss')->unsigned()->default(0);
            $table->smallInteger('countgeki')->unsigned()->default(0);
            $table->smallInteger('countkatu')->unsigned()->default(0);
            $table->boolean('perfect')->default(0);
            $table->smallInteger('enabled_mods')->unsigned()->default(0);
            $table->boolean('pass')->default(0);
            $table->timestamp('date')->useCurrent();
            $table->bigInteger('high_score_id')->unsigned()->nullable();
            $table->primary(['score_id', 'date']);
            // $table->index(['user_id','date'], 'user_id');
        });
        DB::statement('ALTER TABLE `osu_scores` ADD `scorechecksum` BINARY(16) NOT NULL AFTER `score_id`');
        DB::statement('ALTER TABLE `osu_scores` ADD KEY (`scorechecksum`)');
        DB::statement('ALTER TABLE `osu_scores` MODIFY COLUMN `score_id` INT UNSIGNED AUTO_INCREMENT');
        DB::statement('ALTER TABLE `osu_scores` ADD KEY `user_id` (`user_id`, `date`)');
        DB::statement('ALTER TABLE `osu_scores` ADD KEY (`beatmapset_id`)');
        $this->setRowFormat('osu_scores', 'DYNAMIC');

        Schema::create('osu_scores_taiko_high', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('score_id');
            $table->mediumInteger('beatmap_id')->unsigned()->default(0);
            $table->mediumInteger('beatmapset_id')->unsigned()->default(0);
            $table->mediumInteger('user_id')->default(0);
            $table->integer('score')->default(0);
            $table->smallInteger('maxcombo')->unsigned()->default(0);
            $table->enum('rank', ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH']);
            $table->smallInteger('count50')->unsigned()->default(0);
            $table->smallInteger('count100')->unsigned()->default(0);
            $table->smallInteger('count300')->unsigned()->default(0);
            $table->smallInteger('countmiss')->unsigned()->default(0);
            $table->smallInteger('countgeki')->unsigned()->default(0);
            $table->smallInteger('countkatu')->unsigned()->default(0);
            $table->boolean('perfect')->default(0);
            $table->smallInteger('enabled_mods')->unsigned()->default(0);
            $table->timestamp('date')->useCurrent();
            $table->float('pp')->nullable();
            $table->boolean('replay')->unsigned()->default(0);
            $table->index(['beatmap_id', 'score', 'user_id'], 'beatmap_score_lookup');
            $table->index(['user_id', 'beatmap_id', 'rank'], 'user_beatmap_rank');
        });
        $this->setRowFormat('osu_scores_taiko_high', 'DYNAMIC');

        Schema::create('osu_scores_taiko', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';

            $table->integer('score_id', false, true);
            // $table->binary('scorechecksum', 16)->index('scorechecksum');
            $table->mediumInteger('beatmap_id')->unsigned()->default(0);
            $table->mediumInteger('beatmapset_id')->unsigned()->default(0)->index('beatmapset_id');
            $table->mediumInteger('user_id')->default(0);
            $table->integer('score')->default(0);
            $table->smallInteger('maxcombo')->unsigned()->default(0);
            $table->enum('rank', ['0', 'A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH', 'F'])->default('F');
            $table->smallInteger('count50')->unsigned()->default(0);
            $table->smallInteger('count100')->unsigned()->default(0);
            $table->smallInteger('count300')->unsigned()->default(0);
            $table->smallInteger('countmiss')->unsigned()->default(0);
            $table->smallInteger('countgeki')->unsigned()->default(0);
            $table->smallInteger('countkatu')->unsigned()->default(0);
            $table->boolean('perfect')->default(0);
            $table->smallInteger('enabled_mods')->unsigned()->default(0);
            $table->boolean('pass')->default(0);
            $table->timestamp('date')->useCurrent();
            $table->bigInteger('high_score_id')->unsigned()->nullable();
            $table->primary(['score_id', 'date']);
            // $table->index(['user_id','date'], 'user_id');
        });
        DB::statement('ALTER TABLE `osu_scores_taiko` ADD `scorechecksum` BINARY(16) NOT NULL AFTER `score_id`');
        DB::statement('ALTER TABLE `osu_scores_taiko` ADD KEY (`scorechecksum`)');
        DB::statement('ALTER TABLE `osu_scores_taiko` ADD KEY `user_id` (`user_id`, `date`)');
        DB::statement('ALTER TABLE `osu_scores_taiko` MODIFY COLUMN `score_id` INT UNSIGNED AUTO_INCREMENT');
        $this->setRowFormat('osu_scores_taiko', 'DYNAMIC');

        Schema::create('osu_user_achievements', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumInteger('user_id');
            $table->mediumInteger('achievement_id');
            $table->timestamp('date')->useCurrent();
            $table->mediumInteger('beatmap_id')->nullable();
            $table->primary(['user_id', 'achievement_id']);
            $table->index(['user_id', 'date'], 'user_id');
        });
        $this->setRowFormat('osu_user_achievements', 'DYNAMIC');

        Schema::create('osu_user_banhistory', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('ban_id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('reason', 8000)->nullable()->default('Blanket Cheating Action');
            $table->string('supporting_url')->nullable();
            $table->boolean('ban_status')->nullable()->default(1);
            $table->integer('period')->unsigned()->default(0);
            $table->timestamp('timestamp')->nullable()->useCurrent();
            $table->integer('banner_id')->unsigned()->nullable();
            $table->index(['user_id', 'timestamp'], 'user_id_2');
        });
        $this->setRowFormat('osu_user_banhistory', 'COMPRESSED');

        Schema::create('osu_user_beatmap_playcount', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumInteger('user_id')->unsigned();
            $table->mediumInteger('beatmap_id')->unsigned();
            $table->smallInteger('playcount')->unsigned();
            $table->primary(['user_id', 'beatmap_id']);
        });
        $this->setRowFormat('osu_user_beatmap_playcount', 'COMPRESSED');

        Schema::create('osu_user_donations', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumInteger('user_id')->unsigned();
            $table->string('transaction_id', 250);
            $table->mediumInteger('target_user_id')->unsigned()->default(0);
            $table->boolean('length');
            $table->smallInteger('amount');
            $table->timestamp('timestamp')->useCurrent();
            $table->boolean('cancel')->default(0);
            $table->primary(['user_id', 'transaction_id']);
            $table->index('timestamp', 'timestamp');
            $table->index('transaction_id', 'transaction_id');
        });
        $this->setRowFormat('osu_user_donations', 'DYNAMIC');

        Schema::create('osu_username_change_history', function (Blueprint $table) {
            $table->increments('change_id');
            $table->integer('user_id')->unsigned()->index('user_id'); // medium???
            $table->string('username', 30);
            $table->enum('type', ['support', 'paid', 'admin', 'revert', 'inactive']);
            $table->timestamp('timestamp')->nullable()->useCurrent();
            $table->string('username_last', 30)->nullable()->index('username_last');
        });
        $this->comment('osu_username_change_history', 'Stores historical changes to user\'\'s usernames over time.');

        Schema::create('osu_user_month_playcount', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->unsignedMediumInteger('user_id');
            $table->char('year_month', 4);
            $table->unsignedSmallInteger('playcount');

            $table->primary(['user_id', 'year_month']);
        });
        $this->setRowFormat('osu_user_month_playcount', 'COMPRESSED');

        Schema::create('osu_user_performance_rank', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->boolean('mode');
            $table->integer('r0')->default(0);
            $table->integer('r1')->default(0);
            $table->integer('r2')->default(0);
            $table->integer('r3')->default(0);
            $table->integer('r4')->default(0);
            $table->integer('r5')->default(0);
            $table->integer('r6')->default(0);
            $table->integer('r7')->default(0);
            $table->integer('r8')->default(0);
            $table->integer('r9')->default(0);
            $table->integer('r10')->default(0);
            $table->integer('r11')->default(0);
            $table->integer('r12')->default(0);
            $table->integer('r13')->default(0);
            $table->integer('r14')->default(0);
            $table->integer('r15')->default(0);
            $table->integer('r16')->default(0);
            $table->integer('r17')->default(0);
            $table->integer('r18')->default(0);
            $table->integer('r19')->default(0);
            $table->integer('r20')->default(0);
            $table->integer('r21')->default(0);
            $table->integer('r22')->default(0);
            $table->integer('r23')->default(0);
            $table->integer('r24')->default(0);
            $table->integer('r25')->default(0);
            $table->integer('r26')->default(0);
            $table->integer('r27')->default(0);
            $table->integer('r28')->default(0);
            $table->integer('r29')->default(0);
            $table->integer('r30')->default(0);
            $table->integer('r31')->default(0);
            $table->integer('r32')->default(0);
            $table->integer('r33')->default(0);
            $table->integer('r34')->default(0);
            $table->integer('r35')->default(0);
            $table->integer('r36')->default(0);
            $table->integer('r37')->default(0);
            $table->integer('r38')->default(0);
            $table->integer('r39')->default(0);
            $table->integer('r40')->default(0);
            $table->integer('r41')->default(0);
            $table->integer('r42')->default(0);
            $table->integer('r43')->default(0);
            $table->integer('r44')->default(0);
            $table->integer('r45')->default(0);
            $table->integer('r46')->default(0);
            $table->integer('r47')->default(0);
            $table->integer('r48')->default(0);
            $table->integer('r49')->default(0);
            $table->integer('r50')->default(0);
            $table->integer('r51')->default(0);
            $table->integer('r52')->default(0);
            $table->integer('r53')->default(0);
            $table->integer('r54')->default(0);
            $table->integer('r55')->default(0);
            $table->integer('r56')->default(0);
            $table->integer('r57')->default(0);
            $table->integer('r58')->default(0);
            $table->integer('r59')->default(0);
            $table->integer('r60')->default(0);
            $table->integer('r61')->default(0);
            $table->integer('r62')->default(0);
            $table->integer('r63')->default(0);
            $table->integer('r64')->default(0);
            $table->integer('r65')->default(0);
            $table->integer('r66')->default(0);
            $table->integer('r67')->default(0);
            $table->integer('r68')->default(0);
            $table->integer('r69')->default(0);
            $table->integer('r70')->default(0);
            $table->integer('r71')->default(0);
            $table->integer('r72')->default(0);
            $table->integer('r73')->default(0);
            $table->integer('r74')->default(0);
            $table->integer('r75')->default(0);
            $table->integer('r76')->default(0);
            $table->integer('r77')->default(0);
            $table->integer('r78')->default(0);
            $table->integer('r79')->default(0);
            $table->integer('r80')->default(0);
            $table->integer('r81')->default(0);
            $table->integer('r82')->default(0);
            $table->integer('r83')->default(0);
            $table->integer('r84')->default(0);
            $table->integer('r85')->default(0);
            $table->integer('r86')->default(0);
            $table->integer('r87')->default(0);
            $table->integer('r88')->default(0);
            $table->integer('r89')->default(0);
            $table->primary(['user_id', 'mode']);
        });
        $partitions = 'PARTITION p0 VALUES LESS THAN (1),';
        $partitions .= 'PARTITION p1 VALUES LESS THAN (2),';
        $partitions .= 'PARTITION p2 VALUES LESS THAN (3),';
        $partitions .= 'PARTITION p3 VALUES LESS THAN (4)';
        DB::statement("ALTER TABLE `osu_user_performance_rank` PARTITION BY RANGE (mode) ({$partitions});");
        $this->setRowFormat('osu_user_performance_rank', 'DYNAMIC');

        Schema::create('osu_user_reports', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('report_id');
            $table->integer('user_id');
            $table->unsignedInteger('score_id')->default(0);
            $table->tinyInteger('mode')->default(0);
            $table->enum('reason', ['Insults', 'Spam', 'Cheating', 'UnwantedContent', 'Nonsense', 'Other'])->default('Cheating');
            $table->integer('reporter_id');
            $table->text('comments');
            $table->timestamp('timestamp')->useCurrent();

            $table->unique(['reporter_id', 'user_id', 'mode', 'score_id'], 'unique-new');
            $table->index('timestamp', 'timestamp');
            $table->index('user_id', 'user_lookup');
        });

        $this->setRowFormat('osu_user_reports', 'DYNAMIC');

        Schema::create('osu_user_replayswatched', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->unsignedMediumInteger('user_id');
            $table->char('year_month', 4);
            $table->unsignedMediumInteger('count');

            $table->primary(['user_id', 'year_month']);
        });
        $this->setRowFormat('osu_user_replayswatched', 'COMPRESSED');

        Schema::create('osu_user_security', function (Blueprint $table) {
            $table->unsignedMediumInteger('user_id');
        });
        $this->addBinary('osu_user_security', 'osu_md5', 16, true);
        $this->addBinary('osu_user_security', 'unique_md5', 16, true);
        $this->addBinary('osu_user_security', 'disk_md5', 16, true);
        $this->addBinary('osu_user_security', 'mac_md5', 16, true);
        Schema::table('osu_user_security', function (Blueprint $table) {
            $table->timestamp('timestamp')->useCurrent();
            $table->boolean('verified')->default(false);

            $table->primary(['user_id', 'osu_md5', 'unique_md5']);
            $table->index('disk_md5', 'disk_md5');
            $table->index('unique_md5', 'unique_md5');
        });

        Schema::create('osu_user_stats_fruits', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumInteger('user_id')->primary();
            $table->integer('count300')->default(0);
            $table->integer('count100')->default(0);
            $table->integer('count50')->default(0);
            $table->integer('countMiss')->default(0);
            $table->bigInteger('accuracy_total')->unsigned();
            $table->bigInteger('accuracy_count')->unsigned();
            $table->float('accuracy');
            $table->mediumInteger('playcount');
            $table->bigInteger('total_seconds_played')->default(0);
            $table->bigInteger('ranked_score');
            $table->bigInteger('total_score');
            $table->mediumInteger('x_rank_count');
            $table->mediumInteger('s_rank_count');
            $table->mediumInteger('a_rank_count');
            $table->mediumInteger('rank');
            $table->float('level')->unsigned();
            $table->mediumInteger('replay_popularity')->unsigned()->default(0);
            $table->mediumInteger('fail_count')->unsigned()->default(0);
            $table->mediumInteger('exit_count')->unsigned()->default(0);
            $table->smallInteger('max_combo')->unsigned()->default(0);
            $table->char('country_acronym', 2)->default('');
            $table->float('rank_score')->unsigned();
            $table->integer('rank_score_index')->unsigned();
            $table->float('accuracy_new')->unsigned();
            // $table->timestamp('last_update')->useCurrent();
            $table->timestamp('last_played')->useCurrent();
            $table->index('ranked_score', 'ranked_score');
            $table->index('playcount', 'playcount');
            $table->index('rank_score', 'rank_score');
            $table->index(['country_acronym', 'rank_score'], 'country_acronym');
        });
        DB::statement('ALTER TABLE `osu_user_stats_fruits` ADD COLUMN `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `accuracy_new`');
        $this->setRowFormat('osu_user_stats_fruits', 'DYNAMIC');

        Schema::create('osu_user_stats_mania', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumInteger('user_id')->primary();
            $table->integer('count300')->default(0);
            $table->integer('count100')->default(0);
            $table->integer('count50')->default(0);
            $table->integer('countMiss')->default(0);
            $table->bigInteger('accuracy_total')->unsigned();
            $table->bigInteger('accuracy_count')->unsigned();
            $table->float('accuracy');
            $table->mediumInteger('playcount');
            $table->bigInteger('total_seconds_played')->default(0);
            $table->bigInteger('ranked_score');
            $table->bigInteger('total_score');
            $table->mediumInteger('x_rank_count');
            $table->mediumInteger('s_rank_count');
            $table->mediumInteger('a_rank_count');
            $table->mediumInteger('rank');
            $table->float('level')->unsigned();
            $table->mediumInteger('replay_popularity')->unsigned()->default(0);
            $table->mediumInteger('fail_count')->unsigned()->default(0);
            $table->mediumInteger('exit_count')->unsigned()->default(0);
            $table->smallInteger('max_combo')->unsigned()->default(0);
            $table->char('country_acronym', 2)->default('');
            $table->float('rank_score')->unsigned();
            $table->integer('rank_score_index')->unsigned();
            $table->float('accuracy_new')->unsigned();
            // $table->timestamp('last_update')->useCurrent();
            $table->timestamp('last_played')->useCurrent();
            $table->index('ranked_score', 'ranked_score');
            $table->index('rank_score', 'rank_score');
            $table->index(['country_acronym', 'rank_score'], 'country_acronym_2');
            $table->index('playcount', 'playcount');
        });
        DB::statement('ALTER TABLE `osu_user_stats_mania` ADD COLUMN `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `accuracy_new`');
        $this->setRowFormat('osu_user_stats_mania', 'DYNAMIC');

        Schema::create('osu_user_stats', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumInteger('user_id')->primary();
            $table->integer('count300')->default(0);
            $table->integer('count100')->default(0);
            $table->integer('count50')->default(0);
            $table->integer('countMiss')->default(0);
            $table->bigInteger('accuracy_total')->unsigned();
            $table->bigInteger('accuracy_count')->unsigned();
            $table->float('accuracy');
            $table->mediumInteger('playcount');
            $table->bigInteger('total_seconds_played')->default(0);
            $table->bigInteger('ranked_score');
            $table->bigInteger('total_score');
            $table->mediumInteger('x_rank_count');
            $table->mediumInteger('s_rank_count');
            $table->mediumInteger('a_rank_count');
            $table->mediumInteger('rank');
            $table->float('level')->unsigned();
            $table->mediumInteger('replay_popularity')->unsigned()->default(0);
            $table->mediumInteger('fail_count')->unsigned()->default(0);
            $table->mediumInteger('exit_count')->unsigned()->default(0);
            $table->smallInteger('max_combo')->unsigned()->default(0);
            $table->char('country_acronym', 2)->default('');
            $table->float('rank_score')->unsigned();
            $table->integer('rank_score_index')->unsigned();
            $table->float('accuracy_new')->unsigned();
            // $table->timestamp('last_update')->useCurrent();
            $table->timestamp('last_played')->useCurrent();
            $table->index('ranked_score', 'ranked_score');
            $table->index('rank_score', 'rank_score');
            $table->index(['country_acronym', 'rank_score'], 'country_acronym_2');
            $table->index('playcount', 'playcount');
        });
        DB::statement('ALTER TABLE `osu_user_stats` ADD COLUMN `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `accuracy_new`');
        $this->setRowFormat('osu_user_stats', 'DYNAMIC');

        Schema::create('osu_user_stats_taiko', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumInteger('user_id')->primary();
            $table->integer('count300')->default(0);
            $table->integer('count100')->default(0);
            $table->integer('count50')->default(0);
            $table->integer('countMiss')->default(0);
            $table->bigInteger('accuracy_total')->unsigned();
            $table->bigInteger('accuracy_count')->unsigned();
            $table->float('accuracy');
            $table->mediumInteger('playcount');
            $table->bigInteger('total_seconds_played')->default(0);
            $table->bigInteger('ranked_score');
            $table->bigInteger('total_score');
            $table->mediumInteger('x_rank_count');
            $table->mediumInteger('s_rank_count');
            $table->mediumInteger('a_rank_count');
            $table->mediumInteger('rank');
            $table->float('level')->unsigned();
            $table->mediumInteger('replay_popularity')->unsigned()->default(0);
            $table->mediumInteger('fail_count')->unsigned()->default(0);
            $table->mediumInteger('exit_count')->unsigned()->default(0);
            $table->smallInteger('max_combo')->unsigned()->default(0);
            $table->char('country_acronym', 2)->default('');
            $table->float('rank_score')->unsigned();
            $table->integer('rank_score_index')->unsigned();
            $table->float('accuracy_new')->unsigned();
            // $table->timestamp('last_update')->useCurrent();
            $table->timestamp('last_played')->useCurrent();
            $table->index('ranked_score', 'ranked_score');
            $table->index('playcount', 'playcount');
            $table->index('rank_score', 'rank_score');
            $table->index(['country_acronym', 'rank_score'], 'country_acronym');
        });
        DB::statement('ALTER TABLE `osu_user_stats_taiko` ADD COLUMN `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `accuracy_new`');
        $this->setRowFormat('osu_user_stats_taiko', 'DYNAMIC');

        Schema::create('phpbb_acl_groups', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumInteger('group_id')->unsigned()->default(0)->index('group_id');
            $table->mediumInteger('forum_id')->unsigned()->default(0);
            $table->mediumInteger('auth_option_id')->unsigned()->default(0)->index('auth_opt_id');
            $table->mediumInteger('auth_role_id')->unsigned()->default(0)->index('auth_role_id');
            $table->boolean('auth_setting')->default(0);
        });
        $this->setRowFormat('phpbb_acl_groups', 'DYNAMIC');

        Schema::create('phpbb_acl_options', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumIncrements('auth_option_id', true);

            $column = $table->string('auth_option', 50)->default('');
            $column->collation = 'utf8_bin';

            $table->unsignedTinyInteger('is_global')->default(0);
            $table->unsignedTinyInteger('is_local')->default(0);
            $table->unsignedTinyInteger('founder_only')->default(0);

            $table->index('auth_option', 'auth_option');
        });
        $this->setRowFormat('phpbb_acl_options', 'DYNAMIC');

        Schema::create('phpbb_acl_roles_data', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->unsignedMediumInteger('role_id')->default('0');
            $table->unsignedMediumInteger('auth_option_id')->default(0);
            $table->tinyInteger('auth_setting')->default(0);

            $table->primary(['role_id', 'auth_option_id']);

            $table->index('auth_option_id', 'ath_op_id');
        });
        $this->setRowFormat('phpbb_acl_roles_data', 'DYNAMIC');

        Schema::create('phpbb_disallow', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumIncrements('disallow_id');
            $column = $table->string('disallow_username')->default('');
            $column->collation = 'utf8_bin';
        });
        $this->setRowFormat('phpbb_disallow', 'DYNAMIC');

        Schema::create('phpbb_forums', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumIncrements('forum_id');
            $table->mediumInteger('parent_id')->unsigned()->default(0);
            $table->mediumInteger('left_id')->unsigned()->default(0);
            $table->mediumInteger('right_id')->unsigned()->default(0);
            $column = $table->mediumText('forum_parents');
            $column->collation = 'utf8_bin';
            $table->string('forum_name')->default('');
            $table->text('forum_desc', 65535);
            $table->string('forum_desc_bitfield')->default('');
            $table->integer('forum_desc_options')->unsigned()->default(7);
            $table->string('forum_desc_uid', 5)->default('');
            $table->string('forum_link')->default('');
            $table->string('forum_password', 40)->default('');
            $table->smallInteger('forum_style')->unsigned()->default(0);
            $table->string('forum_image')->default('');
            $table->text('forum_rules', 65535);
            $table->string('forum_rules_link')->default('');
            $table->string('forum_rules_bitfield')->default('');
            $table->integer('forum_rules_options')->unsigned()->default(7);
            $table->string('forum_rules_uid', 5)->default('');
            $table->boolean('forum_topics_per_page')->default(0);
            $table->boolean('forum_type')->default(0);
            $table->boolean('forum_status')->default(0);
            $table->mediumInteger('forum_posts')->unsigned()->default(0);
            $table->mediumInteger('forum_topics')->unsigned()->default(0);
            $table->mediumInteger('forum_topics_real')->unsigned()->default(0);
            $table->mediumInteger('forum_last_post_id')->unsigned()->default(0)->index('forum_lastpost_id');
            $table->mediumInteger('forum_last_poster_id')->unsigned()->default(0);
            $table->string('forum_last_post_subject', 100)->default('');
            $table->integer('forum_last_post_time')->unsigned()->default(0);
            $table->string('forum_last_poster_name')->default('');
            $table->string('forum_last_poster_colour', 6)->default('');
            $table->boolean('forum_flags')->default(32);
            $table->boolean('display_on_index')->unsigned()->default(1);
            $table->boolean('enable_indexing')->unsigned()->default(1);
            $table->boolean('enable_icons')->unsigned()->default(1);
            $table->boolean('enable_prune')->unsigned()->default(0);
            $table->boolean('enable_sigs')->unsigned()->default(1);
            $table->integer('prune_next')->unsigned()->default(0);
            $table->mediumInteger('prune_days')->unsigned()->default(0);
            $table->mediumInteger('prune_viewed')->unsigned()->default(0);
            $table->mediumInteger('prune_freq')->unsigned()->default(0);
            $table->index(['left_id', 'right_id'], 'left_right_id');
        });
        $this->setRowFormat('phpbb_forums', 'DYNAMIC');

        Schema::create('phpbb_forums_track', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumInteger('user_id')->unsigned()->default(0);
            $table->mediumInteger('forum_id')->unsigned()->default(0);
            $table->integer('mark_time')->unsigned()->default(0);
            $table->primary(['user_id', 'forum_id']);
        });
        $this->setRowFormat('phpbb_forums_track', 'DYNAMIC');

        Schema::create('phpbb_posts', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumIncrements('post_id');
            $table->mediumInteger('topic_id')->unsigned()->default(0);
            $table->mediumInteger('forum_id')->unsigned()->default(0);
            $table->mediumInteger('poster_id')->unsigned()->default(0);
            $table->mediumInteger('icon_id')->unsigned()->default(0);
            $column = $table->string('poster_ip', 40)->default('');
            $column->collation = 'utf8_bin';
            $table->integer('post_time')->unsigned()->default(0);
            $table->boolean('post_approved')->unsigned()->default(1);
            $table->boolean('post_reported')->unsigned()->default(0);
            $table->boolean('enable_bbcode')->unsigned()->default(1);
            $table->boolean('enable_smilies')->unsigned()->default(1);
            $table->boolean('enable_magic_url')->unsigned()->default(1);
            $table->boolean('enable_sig')->unsigned()->default(1);
            $column = $table->string('post_username')->default('');
            $column->collation = 'utf8_bin';
            $column = $table->string('post_subject', 100)->default('');
            $column->charset = 'utf8mb4';
            $column->collation = 'utf8mb4_unicode_ci';
            $column = $table->mediumText('post_text');
            $column->charset = 'utf8mb4';
            $column->collation = 'utf8mb4_unicode_ci';
            $table->boolean('post_attachment')->unsigned()->default(0);
            $table->string('bbcode_bitfield')->default('');
            $table->string('bbcode_uid', 5)->default('');
            $table->boolean('post_postcount')->unsigned()->default(1);
            $table->integer('post_edit_time')->unsigned()->default(0);
            $table->string('post_edit_reason')->default('');
            $table->mediumInteger('post_edit_user')->unsigned()->default(0);
            $table->smallInteger('post_edit_count')->unsigned()->default(0);
            $table->boolean('post_edit_locked')->unsigned()->default(0);
            $table->boolean('osu_kudosobtained')->default(0);
            $table->index('forum_id', 'forum_id');
            $table->index('topic_id', 'topic_id');
            $table->index('poster_id', 'poster_id');
            $table->index(['topic_id', 'post_time'], 'tid_post_time');
        });
        $this->setRowFormat('phpbb_posts', 'DYNAMIC');

        Schema::create('phpbb_ranks', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumIncrements('rank_id');
            $column = $table->string('rank_title')->default('');
            $column->collation = 'utf8_bin';
            $table->mediumInteger('rank_min')->unsigned()->default(0);
            $table->boolean('rank_special')->unsigned()->default(0);
            $column = $table->string('rank_image')->default('');
            $column->collation = 'utf8_bin';
        });
        $this->setRowFormat('phpbb_ranks', 'DYNAMIC');

        Schema::create('phpbb_smilies', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumIncrements('smiley_id');
            $column = $table->string('code', 50)->default('');
            $column->collation = 'utf8_bin';
            $column = $table->string('emotion', 50)->default('');
            $column->collation = 'utf8_bin';
            $column = $table->string('smiley_url', 50)->default('');
            $column->collation = 'utf8_bin';
            $table->smallInteger('smiley_width')->unsigned()->default(0);
            $table->smallInteger('smiley_height')->unsigned()->default(0);
            $table->mediumInteger('smiley_order')->unsigned()->default(0);
            $table->boolean('display_on_posting')->unsigned()->default(1)->index('display_on_post');
        });
        $this->setRowFormat('phpbb_smilies', 'DYNAMIC');

        Schema::create('phpbb_topics', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumIncrements('topic_id');
            $table->mediumInteger('forum_id')->unsigned()->default(0);
            $table->mediumInteger('icon_id')->unsigned()->default(0);
            $table->boolean('topic_attachment')->unsigned()->default(0);
            $table->boolean('topic_approved')->unsigned()->default(1);
            $table->boolean('topic_reported')->unsigned()->default(0);
            $column = $table->string('topic_title', 100)->default('');
            $column->charset = 'utf8mb4';
            $table->mediumInteger('topic_poster')->unsigned()->default(0);
            $table->integer('topic_time')->unsigned()->default(0);
            $table->integer('topic_time_limit')->unsigned()->default(0);
            $table->mediumInteger('topic_views')->unsigned()->default(0);
            $table->mediumInteger('topic_replies')->unsigned()->default(0);
            $table->mediumInteger('topic_replies_real')->unsigned()->default(0);
            $table->boolean('topic_status')->default(0);
            $table->boolean('topic_type')->default(0);
            $table->mediumInteger('topic_first_post_id')->unsigned()->default(0);
            $column = $table->string('topic_first_poster_name')->default('');
            $column->collation = 'utf8_bin';
            $column = $table->string('topic_first_poster_colour', 6)->default('');
            $column->collation = 'utf8_bin';
            $table->mediumInteger('topic_last_post_id')->unsigned()->default(0);
            $table->mediumInteger('topic_last_poster_id')->unsigned()->default(0);
            $column = $table->string('topic_last_poster_name')->default('');
            $column->collation = 'utf8_bin';
            $column = $table->string('topic_last_poster_colour', 6)->default('');
            $column->collation = 'utf8_bin';
            $column = $table->string('topic_last_post_subject', 100)->default('');
            $column->collation = 'utf8_bin';
            $table->integer('topic_last_post_time')->unsigned()->default(0);
            $table->integer('topic_last_view_time')->unsigned()->default(0);
            $table->mediumInteger('topic_moved_id')->unsigned()->default(0);
            $table->boolean('topic_bumped')->unsigned()->default(0);
            $table->mediumInteger('topic_bumper')->unsigned()->default(0);
            $table->string('poll_title')->default('');
            $table->integer('poll_start')->unsigned()->default(0);
            $table->integer('poll_length')->unsigned()->default(0);
            $table->boolean('poll_max_options')->default(1);
            $table->integer('poll_last_vote')->unsigned()->default(0);
            $table->boolean('poll_vote_change')->unsigned()->default(0);
            $table->smallInteger('osu_starpriority')->default(0);
            $table->enum('osu_lastreplytype', ['none', 'creator', 'bat'])->default('none');
            $table->index('topic_last_post_time', 'last_post_time');
            $table->index(['forum_id', 'topic_approved', 'topic_last_post_id'], 'forum_appr_last');
            $table->index(['forum_id', 'topic_last_post_time', 'topic_moved_id'], 'fid_time_moved');
            $table->index(['topic_id', 'forum_id', 'icon_id'], 'tid_fid_iconid');
            $table->index(['forum_id', 'topic_type', 'topic_last_post_time'], 'forum_id_type');
            $table->index(['forum_id', 'topic_type', 'osu_starpriority', 'topic_last_post_time'], 'star_sort');
        });
        $this->setRowFormat('phpbb_topics', 'DYNAMIC');

        Schema::create('phpbb_topics_stars', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumIncrements('star_id');
            $table->unsignedMediumInteger('topic_id');
            $table->unsignedMediumInteger('user_id');
            $table->enum('type', ['user', 'supporter']);
            $table->timestamp('date')->useCurrent();

            $table->index(['user_id'], 'user_id');
            $table->index(['topic_id', 'user_id'], 'topic_id');
        });
        $this->setRowFormat('phpbb_topics_stars', 'DYNAMIC');

        Schema::create('phpbb_topics_track', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumInteger('user_id')->unsigned()->default(0);
            $table->mediumInteger('topic_id')->unsigned()->default(0);
            $table->mediumInteger('forum_id')->unsigned()->default(0);
            $table->integer('mark_time')->unsigned()->default(0);
            $table->primary(['user_id', 'topic_id']);
            $table->index('forum_id', 'forum_id');
            $table->index('topic_id', 'topic_id');
        });
        $this->setRowFormat('phpbb_topics_track', 'DYNAMIC');

        Schema::create('phpbb_user_group', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumInteger('group_id')->unsigned()->default(0);
            $table->mediumInteger('user_id')->unsigned()->default(0)->index('user_id');
            $table->boolean('group_leader')->unsigned()->default(0);
            $table->boolean('user_pending')->unsigned()->default(1);
            $table->primary(['group_id', 'user_id']);
        });
        $this->setRowFormat('phpbb_user_group', 'DYNAMIC');

        Schema::create('phpbb_users', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumIncrements('user_id');
            $table->boolean('user_type')->default(0);
            $table->mediumInteger('group_id')->unsigned()->default(2);
            $column = $table->mediumText('user_permissions');
            $column->collation = 'utf8_bin';
            $table->mediumInteger('user_perm_from')->unsigned()->nullable()->default(0);
            $table->string('user_ip', 50)->default('');
            $table->integer('user_regdate')->unsigned()->default(0);
            $column = $table->string('username')->default('');
            $column->charset = 'utf8';
            $table->string('username_clean')->default('');
            $table->string('user_password', 64)->default('');
            $table->integer('user_passchg')->unsigned()->default(0);
            $table->string('user_email', 100)->nullable()->unique('user_email_unique');
            $table->string('user_birthday', 10)->default('');
            $table->integer('user_lastvisit')->unsigned()->default(0);
            $table->integer('user_lastmark')->unsigned()->default(0);
            $table->integer('user_lastpost_time')->unsigned()->default(0);
            $table->string('user_lastpage', 200)->default('');
            $table->string('user_last_confirm_key', 10)->default('');
            $table->integer('user_last_search')->unsigned()->default(0);
            $table->boolean('user_warnings')->default(0);
            $table->integer('user_last_warning')->unsigned()->default(0);
            $table->boolean('user_login_attempts')->default(0);
            $table->boolean('user_inactive_reason')->default(0);
            $table->integer('user_inactive_time')->unsigned()->default(0);
            $table->mediumInteger('user_posts')->unsigned()->default(0);
            $table->string('user_lang', 30)->default('');
            $table->decimal('user_timezone', 5)->default(0.00);
            $table->boolean('user_dst')->unsigned()->default(0);
            $table->string('user_dateformat', 30)->default('d M Y H:i');
            $table->smallInteger('user_style')->unsigned()->default(0);
            $table->mediumInteger('user_rank')->unsigned()->default(0);
            $table->string('user_colour', 6)->default('');
            $table->smallInteger('user_new_privmsg')->default(0);
            $table->smallInteger('user_unread_privmsg')->default(0);
            $table->integer('user_last_privmsg')->unsigned()->default(0);
            $table->boolean('user_message_rules')->unsigned()->default(0);
            $table->integer('user_full_folder')->default(-3);
            $table->integer('user_emailtime')->unsigned()->default(0);
            $table->smallInteger('user_topic_show_days')->unsigned()->default(0);
            $table->char('user_topic_sortby_type', 1)->default('t');
            $table->char('user_topic_sortby_dir', 1)->default('d');
            $table->smallInteger('user_post_show_days')->unsigned()->default(0);
            $table->char('user_post_sortby_type', 1)->default('t');
            $table->char('user_post_sortby_dir', 1)->default('a');
            $table->boolean('user_notify')->unsigned()->default(0);
            $table->boolean('user_notify_pm')->unsigned()->default(1);
            $table->boolean('user_notify_type')->default(0);
            $table->boolean('user_allow_pm')->unsigned()->default(1);
            $table->boolean('user_allow_viewonline')->unsigned()->default(1);
            $table->boolean('user_allow_viewemail')->unsigned()->default(1);
            $table->boolean('user_allow_massemail')->unsigned()->default(1);
            $table->integer('user_options')->unsigned()->default(895);
            $table->string('user_avatar')->default('');
            $table->boolean('user_avatar_type')->default(0);
            $table->smallInteger('user_avatar_width')->unsigned()->default(0);
            $table->smallInteger('user_avatar_height')->unsigned()->default(0);
            $column = $table->mediumText('user_sig');
            $column->collation = 'utf8_bin';
            $table->string('user_sig_bbcode_uid', 5)->default('');
            $table->string('user_sig_bbcode_bitfield')->default('');
            $table->string('user_from', 100)->default('');
            $table->string('user_lastfm')->default('');
            $table->string('user_lastfm_session')->default('');
            $table->string('user_twitter')->default('');
            $table->string('user_msnm')->default('');
            $table->string('user_jabber')->default('');
            $table->string('user_website', 200)->default('');
            $table->text('user_occ', 65535);
            $table->text('user_interests', 65535);
            $table->string('user_actkey', 32)->default('');
            $table->string('user_newpasswd', 32)->default('');
            $table->float('osu_mapperrank')->default(0)->index('osu_mapperrank');
            $table->boolean('osu_testversion')->default(0);
            $table->boolean('osu_subscriber')->default(0);
            $table->date('osu_subscriptionexpiry')->nullable();
            $table->smallInteger('osu_kudosavailable')->default(0);
            $table->smallInteger('osu_kudosdenied')->unsigned()->default(0);
            $table->smallInteger('osu_kudostotal')->default(0)->index('osu_kudostotal');
            $table->char('country_acronym', 2)->default('')->index('country_acronym');
            $table->mediumInteger('userpage_post_id')->unsigned()->nullable();
            $table->string('username_previous', 1024)->nullable();
            $table->smallInteger('osu_featurevotes')->unsigned()->default(0);
            $table->tinyInteger('osu_playstyle')->unsigned()->default(0);
            $table->tinyInteger('osu_playmode')->default(0);
            $table->string('remember_token', 100)->nullable();
            $table->unique('username_clean', 'username_clean');
            $table->unique(['username', 'user_id'], 'username_id');
        });
        $this->setRowFormat('phpbb_users', 'DYNAMIC');

        Schema::create('phpbb_groups', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumIncrements('group_id');
            $table->tinyInteger('group_type')->default(1);
            $table->unsignedTinyInteger('group_founder_manage')->default(0);

            $column = $table->string('group_name', 255)->default('');
            $column->collation = 'utf8_bin';

            $column = $table->text('group_desc');
            $column->collation = 'utf8_bin';

            $column = $table->string('group_desc_bitfield', 255)->default('');
            $column->collation = 'utf8_bin';

            $table->unsignedInteger('group_desc_options')->default(7);

            $column = $table->string('group_desc_uid', 5)->default('');
            $column->collation = 'utf8_bin';

            $table->unsignedTinyInteger('group_display')->default(0);

            $column = $table->string('group_avatar', 255)->default('');
            $column->collation = 'utf8_bin';

            $table->tinyInteger('group_avatar_type')->default(0);
            $table->unsignedSmallInteger('group_avatar_width')->default(0);
            $table->unsignedSmallInteger('group_avatar_height')->default(0);
            $table->unsignedMediumInteger('group_rank')->default(0);

            $column = $table->string('group_colour', 6)->default('');
            $column->collation = 'utf8_bin';

            $table->unsignedMediumInteger('group_sig_chars')->default(0);
            $table->unsignedTinyInteger('group_receive_pm')->default(0);
            $table->unsignedMediumInteger('group_message_limit')->default(0);
            $table->unsignedTinyInteger('group_legend')->default(0);

            $table->index('group_legend', 'group_legend');
        });
        $this->setRowFormat('phpbb_groups', 'DYNAMIC');

        Schema::create('phpbb_log', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->mediumIncrements('log_id');
            $table->tinyInteger('log_type')->default(0);
            $table->unsignedMediumInteger('user_id')->default(0);
            $table->unsignedMediumInteger('forum_id')->default(0);
            $table->unsignedMediumInteger('topic_id')->default(0);
            $table->unsignedMediumInteger('reportee_id')->default(0);

            $column = $table->string('log_ip', 40)->default('');
            $column->collation = 'utf8_bin';

            $table->unsignedInteger('log_time')->default(0);

            $column = $table->text('log_operation');
            $column->collation = 'utf8_bin';

            $column = $table->mediumText('log_data');
            $column->collation = 'utf8_bin';

            $table->index('log_type', 'log_type');
            $table->index('forum_id', 'forum_id');
            $table->index('topic_id', 'topic_id');
            $table->index('reportee_id', 'reportee_id');
            $table->index('user_id', 'user_id');
        });
        $this->setRowFormat('phpbb_log', 'COMPRESSED');

        Schema::create('phpbb_topics_watch', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';

            $table->unsignedMediumInteger('user_id')->default(0);
            $table->unsignedMediumInteger('topic_id')->default(0);
            $table->unsignedTinyInteger('notify_status')->default(0);

            $table->index('topic_id', 'topic_id');
            $table->index('notify_status', 'notify_stat');
            $table->primary(['user_id', 'topic_id']);
        });
        $this->setRowFormat('phpbb_topics_watch', 'COMPRESSED');

        DB::statement('
            CREATE TABLE weak_passwords
            (hash binary(16) NOT NULL, PRIMARY KEY (hash))
            DEFAULT CHARSET=utf8mb4
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('osu_achievements');
        Schema::drop('osu_apikeys');
        Schema::drop('osu_badges');
        Schema::drop('osu_beatmap_difficulty');
        Schema::drop('osu_beatmap_difficulty_attribs');
        Schema::drop('osu_beatmaps');
        Schema::drop('osu_beatmapsets');
        Schema::drop('osu_user_beatmapset_ratings');
        Schema::drop('osu_changelog');
        Schema::drop('osu_builds');
        Schema::drop('osu_countries');
        Schema::drop('osu_counts');
        Schema::drop('osu_downloads');
        Schema::drop('osu_events');
        Schema::drop('osu_favouritemaps');
        Schema::drop('osu_genres');
        Schema::drop('osu_kudos_exchange');
        Schema::drop('osu_languages');
        Schema::drop('osu_leaders_fruits');
        Schema::drop('osu_leaders_mania');
        Schema::drop('osu_leaders');
        Schema::drop('osu_leaders_taiko');
        Schema::drop('osu_login_attempts');
        Schema::drop('osu_mirrors');
        Schema::drop('osu_replays');
        Schema::drop('osu_replays_fruits');
        Schema::drop('osu_replays_mania');
        Schema::drop('osu_replays_taiko');
        Schema::drop('osu_scores_fruits_high');
        Schema::drop('osu_scores_fruits');
        Schema::drop('osu_scores_high');
        Schema::drop('osu_scores_mania_high');
        Schema::drop('osu_scores_mania');
        Schema::drop('osu_scores');
        Schema::drop('osu_scores_taiko_high');
        Schema::drop('osu_scores_taiko');
        Schema::drop('osu_user_achievements');
        Schema::drop('osu_user_banhistory');
        Schema::drop('osu_user_beatmap_playcount');
        Schema::drop('osu_user_donations');
        Schema::drop('osu_username_change_history');
        Schema::drop('osu_user_month_playcount');
        Schema::drop('osu_user_performance_rank');
        Schema::drop('osu_user_replayswatched');
        Schema::drop('osu_user_reports');
        Schema::drop('osu_user_security');
        Schema::drop('osu_user_stats_fruits');
        Schema::drop('osu_user_stats_mania');
        Schema::drop('osu_user_stats');
        Schema::drop('osu_user_stats_taiko');
        Schema::drop('phpbb_acl_groups');
        Schema::drop('phpbb_acl_options');
        Schema::drop('phpbb_acl_roles_data');
        Schema::drop('phpbb_disallow');
        Schema::drop('phpbb_forums');
        Schema::drop('phpbb_posts');
        Schema::drop('phpbb_ranks');
        Schema::drop('phpbb_smilies');
        Schema::drop('phpbb_topics');
        Schema::drop('phpbb_topics_stars');
        Schema::drop('phpbb_topics_track');
        Schema::drop('phpbb_user_group');
        Schema::drop('phpbb_users');
        Schema::drop('phpbb_groups');
        Schema::drop('phpbb_log');
        Schema::drop('phpbb_topics_watch');
        Schema::drop('weak_passwords');
    }

    private function setRowFormat($table, $format)
    {
        DB::statement("ALTER TABLE `{$table}` ROW_FORMAT={$format};");
    }

    private function addBinary($table, $columnname, $size, $nullable = false, $after = null)
    {
        $null = $nullable ? 'NULL' : 'NOT NULL';
        $after = $after ? 'AFTER '.$after : '';
        $statement = "ALTER TABLE `{$table}` ADD `{$columnname}` BINARY({$size}) {$null} {$after};";
        DB::statement($statement);
    }

    private function comment($table, $comment)
    {
        DB::statement("ALTER TABLE `{$table}` COMMENT = '{$comment}';");
    }
}
