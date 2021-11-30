<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\BanchoStats;
use App\Models\Count;
use Auth;
use Cache;

class CurrentStats
{
    public $currentOnline;
    public $currentGames;
    public $graphData;
    public $totalUsers;

    public function __construct()
    {
        $data = Cache::remember('current_stats:v1', 300, function () {
            $stats = BanchoStats::stats();
            $latest = array_last($stats);

            return [
                'currentOnline' => $latest['users_osu'] ?? 0,
                'currentGames' => $latest['multiplayer_games'] ?? 0,
                'graphData' => array_to_graph_json($stats, 'users_osu'),
                'totalUsers' => Count::totalUsers()->count,
            ];
        });

        $this->onlineFriends = Auth::user() ? Auth::user()->friends()->online()->count() : 0;
        $this->currentOnline = $data['currentOnline'];
        $this->currentGames = $data['currentGames'];
        $this->graphData = $data['graphData'];
        $this->totalUsers = $data['totalUsers'];
    }
}
