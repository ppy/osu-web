<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'slettet beatmap',
        'difference' => 'med :difference',
        'failed' => 'MISLYKTES',
        'header' => 'Flerspillerkamper',
        'in-progress' => '(spill pågår)',
        'in_progress_spinner_label' => 'spill pågår',
        'loading-events' => 'Laster hendelser...',
        'winner' => ':team vinner',

        'events' => [
            'player-left' => ':user forlot spillet',
            'player-joined' => ':user ble med i spillet',
            'player-kicked' => ':user har blitt sparket fra spillet',
            'match-created' => ':user opprettet spillet',
            'match-disbanded' => 'spillet ble oppløst',
            'host-changed' => ':user ble verten',

            'player-left-no-user' => 'en spiller forlot spillet',
            'player-joined-no-user' => 'en spiller ble med i spillet',
            'player-kicked-no-user' => 'en spiller har blitt sparket fra spillet',
            'match-created-no-user' => 'spillet ble opprettet',
            'match-disbanded-no-user' => 'spillet ble oppløst',
            'host-changed-no-user' => 'verten ble endret',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Presisjon',
                'combo' => 'Kombo',
                'score' => 'Poeng',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Alle-mot-alle',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Lag VS',
            'tag-team-vs' => 'Tag Lag VS',
        ],

        'teams' => [
            'blue' => 'Blått lag',
            'red' => 'Rødt lag',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Høyeste poengsum',
            'accuracy' => 'Høyeste presisjon',
            'combo' => 'Høyeste combo',
            'scorev2' => 'Poengsum V2',
        ],
    ],
];
