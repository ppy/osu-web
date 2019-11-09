<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'match' => [
        'beatmap-deleted' => 'slettet beatmap',
        'difference' => 'med :difference',
        'failed' => 'FAILED',
        'header' => 'Multiplayer Matches',
        'in-progress' => '(match i gang)',
        'in_progress_spinner_label' => 'match i gang',
        'loading-events' => 'Indlæser begivenheder...',
        'winner' => ':team vinder',

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
