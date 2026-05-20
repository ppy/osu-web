<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'borttagen beatmap',
        'failed' => 'MISSLYCKADES',
        'header' => 'Flerspelarmatcher',
        'in-progress' => '(pågående match)',
        'in_progress_spinner_label' => 'matchen är pågående',
        'loading-events' => 'Laddar händelser...',
        'winner' => ':team vann',
        'winner_by' => ':winner med :difference',

        'events' => [
            'game_aborted' => 'spelet avbröts',
            'game_aborted_no_user' => 'spelet avbröts',
            'game_completed' => 'spelet har avslutats',
            'game_completed_no_user' => 'spelet har avslutats',
            'host_changed' => ':user blev värd',
            'host_changed_no_user' => 'värden ändrades',
            'player_joined' => ':user gick med i matchen',
            'player_joined_no_user' => 'en spelare gick med i matchen',
            'player_kicked' => ':user har sparkats från matchen',
            'player_kicked_no_user' => 'en spelare har sparkats från matchen',
            'player_left' => ':user lämnade matchen',
            'player_left_no_user' => 'en spelare lämnade matchen',
            'room_created' => ':user skapade matchen',
            'room_created_no_user' => 'matchen skapades',
            'room_disbanded' => 'matchen upplöstes',
            'room_disbanded_no_user' => 'matchen upplöstes',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Precision',
                'combo' => 'Kombo',
                'score' => 'Poäng',
            ],
        ],

        'team_types' => [
            'head_to_head' => 'Huvud-mot-huvud',
            'tag_coop' => 'Lag samspel',
            'tag_team_versus' => 'Lag spel VS',
            'team_versus' => 'Lag VS',
        ],

        'teams' => [
            'blue' => 'Blått lag',
            'red' => 'Rött lag',
        ],
    ],
    'game' => [
        'freestyle' => 'Fristil',

        'scoring-type' => [
            'score' => 'Högsta poäng',
            'accuracy' => 'Högsta precision',
            'combo' => 'Högsta kombo',
            'scorev2' => 'Poäng V2',
        ],
    ],
];
