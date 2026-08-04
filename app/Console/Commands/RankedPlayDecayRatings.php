<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RankedPlayDecayRatings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ranked-play:decay-ratings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Applies rating decay to all users in active pools.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::statement('UPDATE matchmaking_user_stats SET elo_data = JSON_SET(elo_data, \'$.approximate_posterior.sig\', elo_data->\'$.approximate_posterior.sig\' + 1) WHERE pool_id IN (SELECT id FROM matchmaking_pools WHERE active = 1);');
    }
}
