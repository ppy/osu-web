<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'raderad beatmap',
        'difference' => 'med :difference',
        'failed' => 'MISSLYCKADES',
        'header' => 'Multiplayer Matcher',
        'in-progress' => '(pågående match)',
        'in_progress_spinner_label' => 'matchen är pågående',
        'loading-events' => 'Laddar händelser...',
        'winner' => ':team vann',

        'events' => [
            'player-left' => ':user lämnade spelet',
            'player-joined' => ':user gick med i spelet',
            'player-kicked' => ':user har blivit kickad från spelet',
            'match-created' => ':user skapade spelet',
            'match-disbanded' => 'spelet upplöstes',
            'host-changed' => ':user blev värd',

            'player-left-no-user' => 'en spelare lämnade spelet',
            'player-joined-no-user' => 'en spelare gick med i spelet',
            'player-kicked-no-user' => 'en spelare har blivit kickad från spelet',
            'match-created-no-user' => 'spelet skapades',
            'match-disbanded-no-user' => 'spelet upplöstes',
            'host-changed-no-user' => 'värden ändrades',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Precision',
                'combo' => 'Kombo',
                'score' => 'Poäng',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Lag mot lag',
            'tag-team-vs' => 'Tag Lag VS',
        ],

        'teams' => [
            'blue' => 'Blått Lag',
            'red' => 'Rött Lag',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Högsta Poäng',
            'accuracy' => 'Högsta Precision',
            'combo' => 'Högsta Kombo',
            'scorev2' => 'Score V2',
        ],
    ],
];
