<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Pievienoji lietotāju komandai.',
        ],
        'destroy' => [
            'ok' => 'Atcēli pieprasīšanās pieprasījumu.',
        ],
        'reject' => [
            'ok' => 'Pievienošanās pieprasījums tika noliegts.',
        ],
        'store' => [
            'ok' => 'Tu pieprasīji pievienoties komandai.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited lietotājs|:count_delimited lietotāji',
    ],

    'create' => [
        'submit' => 'Izveidot Komandu',

        'form' => [
            'name_help' => 'Jūsu komandas nosaukums. Nosaukums pašreiz ir neizmaināms.',
            'short_name_help' => 'Maksimums 4 rakstzīmes.',
            'title' => "Uzstādam jaunu komandu",
        ],

        'intro' => [
            'description' => "Spēlē kopā ar draugiem; esošajiem vai jauniem. Tu pašlaik neesi komandā. Pievienojies esoša komandā, apmeklējot komandas lapu, vai izveido savu komandu šeit.",
            'title' => 'Komanda!',
        ],
    ],

    'destroy' => [
        'ok' => 'Komanda noņemta.',
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
        'leaderboard' => 'līderu saraksts',
        'show' => 'info',

        'members' => [
            'index' => 'pārvaldīt dalībniekus',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Globālais rangs',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Komandas biedrs noņemts',
        ],

        'index' => [
            'title' => 'Pārvaldīt Dalībniekus',

            'applications' => [
                'accept_confirm' => 'Pievienot lietotāju :user komandai?',
                'created_at' => 'Pieprasīts Vietnē',
                'empty' => 'Pašreiz nav jauni pieprasījumi pievienoties.',
                'empty_slots' => 'Brīvās vietas',
                'empty_slots_overflow' => ':count_delimited lietotāja pārplūde|:count_delimited lietotāju pārplūde',
                'reject_confirm' => 'Noliegt pievienošanās pieprasījumu no lietotāja :user?',
                'title' => 'Pievienošanās Pieprasījumi',
            ],

            'table' => [
                'joined_at' => 'Pievienošanās Datums',
                'remove' => 'Noņemt',
                'remove_confirm' => 'Noņemt lietotāju :user no komandas?',
                'set_leader' => 'Iedot komandas līdera pozīciju',
                'set_leader_confirm' => 'Pārslēgt komandas līdera pozīciju uz lietotāju :user?',
                'status' => 'Status ',
                'title' => 'Dalībnieku Patreizējais Skaits',
            ],

            'status' => [
                'status_0' => 'Neaktīvi',
                'status_1' => 'Aktīvi',
            ],
        ],

        'set_leader' => [
            'success' => 'Lietotājs :user tagad ir komandas līderis',
        ],
    ],

    'part' => [
        'ok' => 'Komanda pamesta ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Komandas Tērzētava',
            'destroy' => 'Izjaukt Komandu',
            'join' => 'Paprasīt Pievienoties',
            'join_cancel' => 'Atcelt Pievienošanos',
            'part' => 'Pamest Komandu',
        ],

        'info' => [
            'created' => 'Izveidoti',
        ],

        'members' => [
            'members' => 'Komandas Dalībnieki',
            'owner' => 'Komandas Vadonis',
        ],

        'sections' => [
            'about' => 'Par Mums!',
            'info' => 'Info',
            'members' => 'Dalībnieki',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited vieta brīva|:count_delimited vietas brīvas',
            'leader' => 'Komandas Līderis',
            'rank' => 'Rangs',
        ],
    ],

    'store' => [
        'ok' => 'Komanda izveidota.',
    ],
];
