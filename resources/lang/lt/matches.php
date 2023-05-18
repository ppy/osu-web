<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'bitmapas ištrintas',
        'failed' => 'NEPRAĖJO',
        'header' => 'Keli Mačai',
        'in-progress' => '(vyksta mačas)',
        'in_progress_spinner_label' => 'vyksta mačas',
        'loading-events' => 'Įvykiai keliami...',
        'winner' => ':team laimėjo',
        'winner_by' => '',

        'events' => [
            'player-left' => ':user išėjo iš mačo',
            'player-joined' => ':user prisijungė prie mačo',
            'player-kicked' => ':user buvo išmestas iš mačo',
            'match-created' => ':user sukūrė mačą',
            'match-disbanded' => 'mačas buvo sustabdytas',
            'host-changed' => ':user tapo šeimininku',

            'player-left-no-user' => 'žaidėjas išėjo iš mačo',
            'player-joined-no-user' => 'žaidėjas prisijungė prie mačo',
            'player-kicked-no-user' => 'žaidėjas buvo išmestas iš mačo',
            'match-created-no-user' => 'mačas buvo sukurtas',
            'match-disbanded-no-user' => 'mačas buvo sustabdytas',
            'host-changed-no-user' => 'pasikeitė šeimininkas',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Tikslumas',
                'combo' => 'Kombo',
                'score' => 'Taškai',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Kiekvienas už save',
            'tag-coop' => 'Pakaitinis Ko-op',
            'team-vs' => 'Komandinis',
            'tag-team-vs' => 'Komandinis Pakaitinis',
        ],

        'teams' => [
            'blue' => 'Mėlyna Komanda',
            'red' => 'Raudona Komanda',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Daugiausiai Taškų',
            'accuracy' => 'Didžiausias Tikslumas',
            'combo' => 'Didžiausias Kombo',
            'scorev2' => 'Taškai V2',
        ],
    ],
];
