<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'deleted beatmap',
        'failed' => 'FAILED',
        'header' => 'Multi Matches',
        'in-progress' => '(match in progress)',
        'in_progress_spinner_label' => 'match in progress',
        'loading-events' => 'Loading events...',
        'winner' => ':team wins',
        'winner_by' => ':winner by :difference',

        'events' => [
            'player-left' => ':user left the match',
            'player-joined' => ':user joined the match',
            'player-kicked' => ':user has been kicked from the match',
            'match-created' => ':user created the match',
            'match-disbanded' => 'the match was disbanded',
            'host-changed' => ':user became the host',

            'player-left-no-user' => 'a player left the match',
            'player-joined-no-user' => 'a player joined the match',
            'player-kicked-no-user' => 'a player has been kicked from the match',
            'match-created-no-user' => 'the match was created',
            'match-disbanded-no-user' => 'the match was disbanded',
            'host-changed-no-user' => 'the host was changed',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Accuracy',
                'combo' => 'Combo',
                'score' => 'Score',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Blue Team',
            'red' => 'Red Team',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Highest Score',
            'accuracy' => 'Highest Accuracy',
            'combo' => 'Highest Combo',
            'scorev2' => 'Score V2',
        ],
    ],
];
