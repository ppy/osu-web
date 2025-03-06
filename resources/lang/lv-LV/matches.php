<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'izdzēsta ritma-mape',
        'failed' => 'IZGĀZĀS',
        'header' => 'Daudzspēlētāju Mači',
        'in-progress' => '(notiek spēle)',
        'in_progress_spinner_label' => 'notiek spēle',
        'loading-events' => 'Ielādē notikumus...',
        'winner' => ':team uzvar',
        'winner_by' => ':winner ar starpību :difference',

        'events' => [
            'player-left' => ':user pameta maču',
            'player-joined' => ':user pievienojās mačam',
            'player-kicked' => ':user tika izraidīts no mača',
            'match-created' => ':user izveidoja maču',
            'match-disbanded' => 'šis mačs bija izbeigts',
            'host-changed' => ':user kļuva par vadītāju',

            'player-left-no-user' => 'spēlētājs pameta maču',
            'player-joined-no-user' => 'spēlētājs pievienojās mačam',
            'player-kicked-no-user' => 'spēlētājs tika izraidīts no mača',
            'match-created-no-user' => 'mačs tika izveidots',
            'match-disbanded-no-user' => 'šis mačs bija pamests',
            'host-changed-no-user' => 'vadītājs tika izmainīts',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Precizitāte',
                'combo' => 'Kombinācija',
                'score' => 'Rezultāts',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Visi-pret-Visiem',
            'tag-coop' => 'Stafetes ',
            'team-vs' => 'Komandas VS',
            'tag-team-vs' => 'Stafešu Komanda pret',
        ],

        'teams' => [
            'blue' => 'Zilā Komanda',
            'red' => 'Sarkanā Komanda',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Visaugstākais Rezultāts',
            'accuracy' => 'Augstākā Precizitāte',
            'combo' => 'Augstākā Kombinācija',
            'scorev2' => 'Skaitīšana V2',
        ],
    ],
];
