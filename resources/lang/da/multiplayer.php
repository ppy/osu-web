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

return [
    'match' => [
        'beatmap-deleted' => 'slettet beatmap',
        'difference' => 'med :difference',
        'failed' => 'FEJLET',
        'header' => 'Multiplayer Kampe',
        'in-progress' => '(kamp i gang)',
        'in_progress_spinner_label' => 'kamp i gang',
        'loading-events' => 'Indlæser begivenheder...',
        'winner' => ':team vinder',

        'events' => [
            'player-left' => ':user forlod kampen',
            'player-joined' => ':user deltog i kampen',
            'player-kicked' => ':user blev smidt ud af kampen',
            'match-created' => ':user lavede kampen',
            'match-disbanded' => 'kampen blev opløst',
            'host-changed' => ':user er blevet vært',

            'player-left-no-user' => 'en spiller forlod kampen',
            'player-joined-no-user' => 'en spiller deltog i kampen',
            'player-kicked-no-user' => 'en spiller blev smidt ud af kampen',
            'match-created-no-user' => 'kampen blev lavet',
            'match-disbanded-no-user' => 'kampen blev opløst',
            'host-changed-no-user' => 'vært blev skiftet',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Præcision',
                'combo' => 'Combo',
                'score' => 'Score',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Alle mod alle',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Blåt Hold',
            'red' => 'Rødt Hold',
        ],
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
