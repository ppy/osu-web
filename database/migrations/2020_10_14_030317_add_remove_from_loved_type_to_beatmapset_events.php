<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class AddRemoveFromLovedTypeToBeatmapsetEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE beatmapset_events CHANGE type type ENUM(
            'nominate',
            'qualify',
            'disqualify',
            'approve',
            'rank',
            'kudosu_allow',
            'kudosu_deny',
            'kudosu_gain',
            'kudosu_lost',
            'issue_resolve',
            'issue_reopen',
            'discussion_delete',
            'discussion_restore',
            'discussion_post_delete',
            'discussion_post_restore',
            'kudosu_recalculate',
            'nomination_reset',
            'love',
            'discussion_lock',
            'discussion_unlock',
            'genre_edit',
            'language_edit',
            'remove_from_loved'
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE beatmapset_events CHANGE type type ENUM(
            'nominate',
            'qualify',
            'disqualify',
            'approve',
            'rank',
            'kudosu_allow',
            'kudosu_deny',
            'kudosu_gain',
            'kudosu_lost',
            'issue_resolve',
            'issue_reopen',
            'discussion_delete',
            'discussion_restore',
            'discussion_post_delete',
            'discussion_post_restore',
            'kudosu_recalculate',
            'nomination_reset',
            'love',
            'discussion_lock',
            'discussion_unlock',
            'genre_edit',
            'language_edit'
        )");
    }
}
