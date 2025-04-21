<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Dodano użytkownika do drużyny.',
        ],
        'destroy' => [
            'ok' => 'Anulowano prośbę o dołączenie.',
        ],
        'reject' => [
            'ok' => 'Odrzucono prośbę o dołączenie.',
        ],
        'store' => [
            'ok' => 'Przesłano prośbę o dołączenie do zespołu.',
        ],
    ],

    'create' => [
        'submit' => 'Stwórz Drużynę',

        'form' => [
            'name_help' => 'Nazwa twojej drużyny. Jest ona stała na tę chwilę.',
            'short_name_help' => 'Maksymalnie 4 znaki.',
            'title' => "Stwórzmy nową drużynę",
        ],

        'intro' => [
            'description' => "Graj razem z przyjaciółmi; obecnymi lub nowymi. Nie jesteś aktualnie w drużynie. Dołącz do istniejącej drużyny, odwiedzając jej stronę lub stwórz swoją własną tutaj.",
            'title' => 'Drużyna!',
        ],
    ],

    'destroy' => [
        'ok' => 'Usunięto drużynę.',
    ],

    'edit' => [
        'ok' => 'Ustawienia zostały zapisane pomyślnie.',
        'title' => 'Ustawienia zespołu',

        'description' => [
            'label' => 'Opis',
            'title' => 'Opis zespołu',
        ],

        'flag' => [
            'label' => 'Herb zespołu',
            'title' => 'Ustaw herb zespołu',
        ],

        'header' => [
            'label' => 'Tło',
            'title' => 'Ustaw tło',
        ],

        'settings' => [
            'application_help' => 'Określa, czy inni użytkownicy mogą ubiegać się o dołączenie do zespołu',
            'default_ruleset_help' => 'Określa, który tryb gry zostanie wybrany automatycznie podczas odwiedzania strony zespołu',
            'flag_help' => 'Maksymalny dopuszczalny rozmiar: :width×:height',
            'header_help' => 'Maksymalny dopuszczalny rozmiar: :width×:height',
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
                'accept_confirm' => '',
                'created_at' => 'Data przesłania',
                'empty' => 'Brak próśb o dołączenie do zespołu.',
                'empty_slots' => 'Dostępnych miejsc',
                'empty_slots_overflow' => '',
                'reject_confirm' => '',
                'title' => 'Prośby o dołączenie',
            ],

            'table' => [
                'joined_at' => 'Data dołączenia',
                'remove' => 'Usuń',
                'remove_confirm' => '',
                'set_leader' => '',
                'set_leader_confirm' => '',
                'status' => 'Status',
                'title' => 'Aktualni członkowie',
            ],

            'status' => [
                'status_0' => 'Nieaktywny',
                'status_1' => 'Aktywny',
            ],
        ],

        'set_leader' => [
            'success' => '',
        ],
    ],

    'part' => [
        'ok' => 'Opuścił drużynę ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Czat zespołu',
            'destroy' => 'Rozwiąż zespół',
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
            'about' => 'O nas',
            'info' => 'Informacje',
            'members' => 'Członkowie',
        ],

        'statistics' => [
            'rank' => 'Pozycja w rankingu',
            'leader' => 'Lider zespołu',
        ],
    ],

    'store' => [
        'ok' => 'Utworzono zespół.',
    ],
];
