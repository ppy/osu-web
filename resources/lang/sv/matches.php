<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'raderad beatmap',
        'difference' => 'med :difference',
        'failed' => 'MISSLYCKADES',
        'header' => 'Flerspelarmatcher',
        'in-progress' => '(pågående match)',
        'in_progress_spinner_label' => 'matchen är pågående',
        'loading-events' => 'Laddar händelser...',
        'winner' => ':team vann',

        'events' => [
            'player-left' => ':user lämnade matchen',
            'player-joined' => ':user gick med i matchen',
            'player-kicked' => ':user har blivit kickad från matchen',
            'match-created' => ':user skapade matchen',
            'match-disbanded' => 'matchen upplöstes',
            'host-changed' => ':user blev värd',

            'player-left-no-user' => 'en spelare lämnade matchen',
            'player-joined-no-user' => 'en spelare gick med i matchen',
            'player-kicked-no-user' => 'en spelare har blivit kickad från matchen',
            'match-created-no-user' => 'matchen skapades',
            'match-disbanded-no-user' => 'matchen upplöstes',
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
            'head-to-head' => 'Alla mot alla',
            'tag-coop' => 'Tag co-op',
            'team-vs' => 'Lag mot lag',
            'tag-team-vs' => 'Tag-lag VS',
        ],

        'teams' => [
            'blue' => 'Blått lag',
            'red' => 'Rött lag',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Högsta poäng',
            'accuracy' => 'Högsta precision',
            'combo' => 'Högsta kombo',
            'scorev2' => 'Poäng V2',
        ],
    ],
];
