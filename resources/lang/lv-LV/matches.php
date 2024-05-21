<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'izdzēsta bītmape',
        'failed' => '',
        'header' => '',
        'in-progress' => '(notiek mačs)',
        'in_progress_spinner_label' => 'notiek mačs',
        'loading-events' => 'Ielādē notikumus...',
        'winner' => ':team uzvar',
        'winner_by' => ':winner ar starpību :difference',

        'events' => [
            'player-left' => ':user pameta maču',
            'player-joined' => ':user pievienojās mačam',
            'player-kicked' => ':user tika izraidīts no mača',
            'match-created' => ':user izveidoja maču',
            'match-disbanded' => '',
            'host-changed' => '',

            'player-left-no-user' => 'spēlētājs pameta maču',
            'player-joined-no-user' => 'spēlētājs pievienojās mačam',
            'player-kicked-no-user' => 'spēlētājs tika izraidīts no mača',
            'match-created-no-user' => 'mačs tika izveidots',
            'match-disbanded-no-user' => '',
            'host-changed-no-user' => '',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Precizitāte',
                'combo' => '',
                'score' => '',
            ],
        ],

        'team-types' => [
            'head-to-head' => '',
            'tag-coop' => '',
            'team-vs' => '',
            'tag-team-vs' => '',
        ],

        'teams' => [
            'blue' => 'Zilā Komanda',
            'red' => 'Sarkanā Komanda',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => '',
            'accuracy' => 'Augstākā Precizitāte',
            'combo' => 'Augstākais Kombo',
            'scorev2' => '',
        ],
    ],
];
