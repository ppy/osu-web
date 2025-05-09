<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Lietotājs pievienots komandai.',
        ],
        'destroy' => [
            'ok' => 'Atcelts pievienošanās lūgums.',
        ],
        'reject' => [
            'ok' => 'Atteikts pievienošanās lūgums.',
        ],
        'store' => [
            'ok' => 'Pieprasīts pievienoties komandai.',
        ],
    ],

    'create' => [
        'submit' => 'Izveidot Komandu',

        'form' => [
            'name_help' => 'Jūsu komandas nosaukums. Nosaukums pašreiz ir pastāvīgs.',
            'short_name_help' => 'Maksimums 4 rakstzīmes.',
            'title' => "Izveidojam jaunu komandu",
        ],

        'intro' => [
            'description' => "Spēlē kopā ar draugiem; esošiem vai jauniem. Jūs pašlaik neesat komandā. Pievienojies jau esošai komandai ieejot komandas lapā, vai izveido savu komandu šeit.",
            'title' => '',
        ],
    ],

    'destroy' => [
        'ok' => '',
    ],

    'edit' => [
        'ok' => 'Iestatījumi veiksmīgi saglabāti.',
        'title' => 'Komandas Iestatījumi',

        'description' => [
            'label' => 'Apraksts',
            'title' => 'Komandas Apraksts',
        ],

        'flag' => [
            'label' => 'Komandas Karogs',
            'title' => 'Uzstādīt Komandas Karogu',
        ],

        'header' => [
            'label' => 'Galvenes Bilde',
            'title' => 'Uzstādīt Galvenes Bildi',
        ],

        'settings' => [
            'application_help' => 'Vai atļaut cilvēkiem pieteikties komandai',
            'default_ruleset_help' => 'Pamatlikums, kurš būs izvēlēts standarti, apmeklējot komandas lapu',
            'flag_help' => 'Maksimālais izmērs: :width×:height',
            'header_help' => 'Maksimālais izmērs: :width×:height',
            'title' => 'Komandas Iestatījumi',

            'application_state' => [
                'state_0' => 'Aizvērts',
                'state_1' => 'Atvērts',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'iestatījumi',
        'leaderboard' => '',
        'show' => '',

        'members' => [
            'index' => 'pārvaldīt biedrus',
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
                'accept_confirm' => '',
                'created_at' => '',
                'empty' => 'Pašreiz nav pieprasījumi pievienoties.',
                'empty_slots' => 'Brīvās vietas',
                'empty_slots_overflow' => '',
                'reject_confirm' => '',
                'title' => '',
            ],

            'table' => [
                'joined_at' => 'Pievienošanās Datums',
                'remove' => 'Noņemt',
                'remove_confirm' => '',
                'set_leader' => '',
                'set_leader_confirm' => '',
                'status' => 'Status ',
                'title' => 'Dalībnieku Patreizējais Skaits',
            ],

            'status' => [
                'status_0' => 'Neaktīvi',
                'status_1' => 'Aktīvi',
            ],
        ],

        'set_leader' => [
            'success' => '',
        ],
    ],

    'part' => [
        'ok' => 'Komanda pamesta ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => 'Pamest komandu',
        ],

        'info' => [
            'created' => 'Izveidoti',
        ],

        'members' => [
            'members' => 'Komandas Dalībnieki',
            'owner' => 'Komandas Vadonis',
        ],

        'sections' => [
            'about' => '',
            'info' => 'Info',
            'members' => 'Dalībnieki',
        ],

        'statistics' => [
            'rank' => '',
            'leader' => '',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];
