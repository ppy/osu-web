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
            'ok' => 'Przesłano prośbę o dołączenie do zespołu.',
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
        'title' => 'Ustawienia zespołu',

        'description' => [
            'label' => 'Opis',
            'title' => 'Opis zespołu',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Tło',
            'title' => 'Ustaw tło',
        ],

        'settings' => [
            'application_help' => 'Określa, czy inni użytkownicy mogą ubiegać się o dołączenie do zespołu',
            'default_ruleset_help' => 'Określa, który tryb gry zostanie wybrany automatycznie podczas odwiedzania strony zespołu',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'Ustawienia zespołu',

            'application_state' => [
                'state_0' => 'Prywatny',
                'state_1' => 'Publiczny',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'ustawienia',
        'leaderboard' => 'ranking',
        'show' => 'informacje',

        'members' => [
            'index' => 'zarządzaj członkami',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Ranking globalny',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Usunięto członka zespołu',
        ],

        'index' => [
            'title' => 'Zarządzaj członkami zespołu',

            'applications' => [
                'empty' => 'Brak próśb o dołączenie do zespołu.',
                'empty_slots' => 'Dostępnych miejsc',
                'title' => 'Prośby o dołączenie',
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
            'chat' => '',
            'destroy' => '',
            'join' => 'Poproś o dołączenie',
            'join_cancel' => 'Anuluj prośbę o dołączenie',
            'part' => 'Opuść zespół',
        ],

        'info' => [
            'created' => 'Data założenia',
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

    'store' => [
        'ok' => '',
    ],
];
