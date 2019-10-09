<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
                'totalUsers' => Count::totalUsers(),
            ];
        });

        $this->onlineFriends = Auth::user() ? Auth::user()->friends()->online()->count() : 0;
        $this->currentOnline = $data['currentOnline'];
        $this->currentGames = $data['currentGames'];
        $this->graphData = $data['graphData'];
        $this->totalUsers = $data['totalUsers'];
    }
}
