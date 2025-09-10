<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

class RemoveKudosuRefreshVotesFromBeatmapDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        migration('2016_12_19_132350_add_kudosu_refresh_votes_to_beatmap_discussions')->down();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        migration('2016_12_19_132350_add_kudosu_refresh_votes_to_beatmap_discussions')->up();
    }
}
