<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Uživatel byl přidán do týmu.',
        ],
        'destroy' => [
            'ok' => 'Žádost o připojení byla zrušena.',
        ],
        'reject' => [
            'ok' => 'Žádost o připojení byla zamítnuta.',
        ],
        'store' => [
            'ok' => 'Požádáno o připojení k týmu.',
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
        'ok' => 'Tým odebrán',
    ],

    'edit' => [
        'ok' => '',
        'title' => 'Nastavení týmu',

        'description' => [
            'label' => 'Popis',
            'title' => 'Popis týmu',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Obrázek záhlaví',
            'title' => 'Nastavit obrázek záhlaví',
        ],

        'settings' => [
            'application_help' => 'Zdali umožnit lidem, aby mohli podávat přihlášky do týmu',
            'default_ruleset_help' => 'Ruleset, který má být automaticky vybrán při návštěvě stránky týmu',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Nastavení týmu',

            'application_state' => [
                'state_0' => 'Zavřené',
                'state_1' => 'Otevřené',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'nastavení',
        'leaderboard' => 'žebříček',
        'show' => 'info',

        'members' => [
            'index' => 'spravovat členy',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Globální umístění',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Člen týmu byl odebrán',
        ],

        'index' => [
            'title' => 'Spravovat členy',

            'applications' => [
                'empty' => 'Momentálně nemáte žádné žádosti o připojení.',
                'empty_slots' => 'Dostupná místa',
                'title' => 'Žádosti o připojení',
                'created_at' => 'Žádost vytvořena',
            ],

            'table' => [
                'status' => 'Stav',
                'joined_at' => 'Členem od',
                'remove' => 'Odebrat',
                'title' => 'Aktuální členové',
            ],

            'status' => [
                'status_0' => 'Neaktivní',
                'status_1' => 'Aktivní',
            ],
        ],
    ],

    'part' => [
        'ok' => 'Opustil jsi tento tým ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => 'Rozpustit tým',
            'join' => 'Požádat o připojení',
            'join_cancel' => 'Zrušit žádost',
            'part' => 'Opustit tým',
        ],

        'info' => [
            'created' => 'Založen',
        ],

        'members' => [
            'members' => 'Členové týmu',
            'owner' => 'Vedoucí týmu',
        ],

        'sections' => [
            'info' => 'Info',
            'members' => 'Členové',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];
