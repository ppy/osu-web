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
        'saved' => 'Ustawienia zostały zapisane pomyślnie',
        'title' => 'Ustawienia zespołu',

        'description' => [
            'label' => 'Opis',
            'title' => 'Opis zespołu',
        ],

        'header' => [
            'label' => 'Tło',
            'title' => 'Ustaw tło',
        ],

        'logo' => [
            'label' => 'Herb zespołu',
            'title' => 'Ustaw herb zespołu',
        ],

        'settings' => [
            'application' => 'Dostępność zespołu',
            'application_help' => 'Określa, czy inni użytkownicy mogą ubiegać się o dołączenie do zespołu',
            'default_ruleset' => 'Domyślny tryb gry',
            'default_ruleset_help' => 'Określa, który tryb gry zostanie wybrany automatycznie podczas odwiedzania strony zespołu',
            'title' => 'Ustawienia zespołu',
            'url' => 'Adres URL',

            'application_state' => [
                'state_0' => 'Prywatny',
                'state_1' => 'Publiczny',
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
            'success' => 'Usunięto członka zespołu',
        ],

        'index' => [
            'title' => 'Zarządzaj członkami zespołu',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
            ],

            'table' => [
                'status' => 'Status',
                'joined_at' => 'Data dołączenia',
                'remove' => 'Usuń',
                'title' => 'Aktualni członkowie',
            ],

            'status' => [
                'status_0' => 'Nieaktywny',
                'status_1' => 'Aktywny',
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
            'created' => 'Data założenia',
            'website' => 'Strona internetowa',
        ],

        'members' => [
            'members' => 'Członkowie zespołu',
            'owner' => 'Lider zespołu',
        ],

        'sections' => [
            'info' => 'Informacje',
            'members' => 'Członkowie',
        ],
    ],
];
