<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Musisz się zalogować, aby zedytować post.',
            'system_generated' => 'Nie możesz edytować automatycznie wygenerowanych postów.',
            'wrong_user' => 'Tylko autor posta może go zedytować.',
        ],
    ],

    'events' => [
        'empty' => 'Nic się nie wydarzyło... jeszcze.',
    ],

    'index' => [
        'deleted_beatmap' => 'usunięta',
        'title' => 'Dyskusje',

        'form' => [
            '_' => 'Szukaj',
            'deleted' => 'Uwzględnij usunięte dyskusje',
            'only_unresolved' => '',
            'types' => 'Rodzaj wiadomości',
            'username' => 'Nazwa użytkownika',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Użytkownik',
                'overview' => 'Całokształt aktywności',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Data utworzenia',
        'deleted_at' => 'Data usunięcia',
        'message_type' => 'Typ',
        'permalink' => 'Odnośnik bezpośredni',
    ],

    'nearby_posts' => [
        'confirm' => 'Żaden z tych postów nie jest istotny',
        'notice' => 'Istnieją posty dotyczące :timestamp (:existing_timestamps). Sprawdź je przed opublikowaniem posta.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Zaloguj się, aby odpowiedzieć',
            'user' => 'Odpowiedz',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Oznaczone jako gotowe przez :user',
            'false' => 'Otworzone ponownie przez :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Wszyscy',
        'label' => 'Filtruj według użytkownika',
    ],
];
