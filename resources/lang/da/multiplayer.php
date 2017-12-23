<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

return [
    'match' => [
        'header' => 'Multiplayer Matches',
        'team-types' => [
            'head-to-head' => 'Direkte',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],
        'events' => [
            'player-left' => ':user forlod matchen',
            'player-joined' => ':user deltog i matchen',
            'player-kicked' => ':user blev smidt ud af matchen',
            'match-created' => ':user lavede matchen',
            'match-disbanded' => 'matchen blev opløst',
            'host-changed' => ':user er blevet vært',

            'player-left-no-user' => 'en spiller forlod matchen',
            'player-joined-no-user' => 'en spiller deltog i matchen',
            'player-kicked-no-user' => 'en spiller blev smidt ud af matchen',
            'match-created-no-user' => 'matchen blev lavet',
            'match-disbanded-no-user' => 'matchen blev opløst',
            'host-changed-no-user' => 'vært blev skiftet',
        ],
        'in-progress' => '(match i gang)',
        'score' => [
            'stats' => [
                'accuracy' => 'Præcision',
                'combo' => 'Combo',
                'score' => 'Score',
            ],
        ],
        'failed' => 'FAILED',
        'teams' => [
            'blue' => 'Blåt Hold',
            'red' => 'Rødt Hold',
        ],
        'winner' => ':team vinder',
        'difference' => 'med :difference',
        'loading-events' => 'Indlæser begivenheder...',
        'more-events' => 'vis alle...',
        'beatmap-deleted' => 'slettet beatmap',
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Højeste Score',
            'accuracy' => 'Højeste Præcision',
            'combo' => 'Højeste Combo',
            'scorev2' => 'Score V2',
        ],
    ],
];
