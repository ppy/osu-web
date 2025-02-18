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

    'destroy' => [
        'ok' => '',
    ],

    'edit' => [
        'saved' => 'Nastavení bylo úspěšně uloženo',
        'title' => 'Nastavení týmu',

        'description' => [
            'label' => 'Popis',
            'title' => 'Popis týmu',
        ],

        'header' => [
            'label' => 'Obrázek záhlaví',
            'title' => 'Nastavit obrázek záhlaví',
        ],

        'logo' => [
            'label' => 'Vlajka týmu',
            'title' => 'Nastavit vlajku týmu',
        ],

        'settings' => [
            'application' => 'Přihláška do týmu',
            'application_help' => 'Zdali umožnit lidem, aby mohli podávat přihlášky do týmu',
            'default_ruleset' => 'Výchozí ruleset',
            'default_ruleset_help' => 'Ruleset, který má být automaticky vybrán při návštěvě stránky týmu',
            'title' => 'Nastavení týmu',
            'url' => 'URL',

            'application_state' => [
                'state_0' => 'Uzavřená',
                'state_1' => 'Otevřená',
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
        'performance' => '',
        'total_score' => '',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Člen týmu byl odebrán',
        ],

        'index' => [
            'title' => 'Spravovat členy',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
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
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => '',
        ],

        'info' => [
            'created' => 'Založen',
            'website' => 'Webové stránky',
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
];
