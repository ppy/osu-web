<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => '',
        ],
        'destroy' => [
            'ok' => '',
        ],
        'reject' => [
            'ok' => '',
        ],
        'store' => [
            'ok' => '',
        ],
    ],

    'create' => [
        'submit' => '',

        'form' => [
            'name_help' => '',
            'short_name_help' => '',
            'title' => "",
        ],

        'intro' => [
            'description' => "",
            'title' => '',
        ],
    ],

    'destroy' => [
        'ok' => '',
    ],

    'edit' => [
        'ok' => '',
        'title' => 'Komandas Iestatījumi',

        'description' => [
            'label' => 'Apraksts',
            'title' => 'Komandas Apraksts',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Galvenes Bilde',
            'title' => 'Uzstādīt Galvenes Bildi',
        ],

        'settings' => [
            'application_help' => 'Vai atļaut cilvēkiem pieteikties komandai',
            'default_ruleset_help' => 'Pamatlikums, kurš būs izvēlēts standarti, apmeklējot komandas lapu',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Komandas Iestatījumi',

            'application_state' => [
                'state_0' => 'Aizvērts',
                'state_1' => 'Atvērts',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '',
        'leaderboard' => '',
        'show' => '',

        'members' => [
            'index' => '',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Komandas biedrs noņemts',
        ],

        'index' => [
            'title' => 'Menedžēt Dalībniekus',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
            ],

            'table' => [
                'status' => 'Status ',
                'joined_at' => 'Pievienošanās Datums',
                'remove' => 'Noņemt',
                'title' => 'Dalībnieku Patreizējais Skaits',
            ],

            'status' => [
                'status_0' => 'Neaktīvi',
                'status_1' => 'Aktīvi',
            ],
        ],
    ],

    'part' => [
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => '',
        ],

        'info' => [
            'created' => 'Izveidoti',
        ],

        'members' => [
            'members' => 'Komandas Dalībnieki',
            'owner' => 'Komandas Vadonis',
        ],

        'sections' => [
            'info' => 'Info',
            'members' => 'Dalībnieki',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];
