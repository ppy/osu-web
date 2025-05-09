<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Zaloguj się, aby edytować post.',
            'system_generated' => 'Nie możesz edytować automatycznie wygenerowanych postów.',
            'wrong_user' => 'Tylko autor posta może go edytować.',
        ],
    ],

    'events' => [
        'empty' => 'Nic się nie wydarzyło... jeszcze.',
    ],

    'index' => [
        'deleted_beatmap' => 'usunięta',
        'none_found' => 'Nie znaleziono dyskusji pasujących do podanych kryteriów wyszukiwania.',
        'title' => 'dyskusje beatmap',

        'form' => [
            '_' => 'Szukaj',
            'deleted' => 'Uwzględnij usunięte dyskusje',
            'mode' => 'Tryb gry',
            'only_unresolved' => 'Pokaż tylko nierozwiązane dyskusje',
            'show_review_embeds' => 'Pokaż recenzje',
            'types' => 'Rodzaj wiadomości',
            'username' => 'Nazwa użytkownika',

            'beatmapset_status' => [
                '_' => 'Status beatmapy',
                'all' => 'Wszystkie',
                'disqualified' => 'Zdyskwalifikowana',
                'never_qualified' => 'Nigdy nie zakwalifikowana',
                'qualified' => 'Zakwalifikowana',
                'ranked' => 'Rankingowa',
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
        'confirm' => 'Żaden z postów nie odnosi się do moich uwag',
        'notice' => 'Istnieją posty dotyczące :timestamp (:existing_timestamps). Sprawdź je przed opublikowaniem posta.',
        'unsaved' => ':count w tej recenzji',
    ],

    'owner_editor' => [
        'button' => 'Twórca poziomu trudności',
        'reset_confirm' => 'Zresetować twórcę dla tego poziomu trudności?',
        'user' => 'Twórca',
        'version' => 'Poziom trudności',
    ],

    'refresh' => [
        'checking' => 'Sprawdzanie dostępności aktualizacji...',
        'has_updates' => 'Pojawiły się nowe aktualizacje - kliknij, aby odświeżyć.',
        'no_updates' => 'Brak aktualizacji.',
        'updating' => 'Aktualizowanie...',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Zaloguj się, aby odpowiedzieć',
            'user' => 'Odpowiedz',
        ],
    ],

    'review' => [
        'block_count' => 'użyto :used z :max bloków',
        'go_to_parent' => 'Przejdź do recenzji',
        'go_to_child' => 'Przejdź do dyskusji',
        'validation' => [
            'block_too_large' => 'każdy blok może zawierać do :limit znaków',
            'external_references' => 'recenzja zawiera odniesienia do problemów, które do niej nie należą',
            'invalid_block_type' => 'nieprawidłowy typ bloku',
            'invalid_document' => 'nieprawidłowa recenzja',
            'invalid_discussion_type' => 'nieprawidłowy rodzaj dyskusji',
            'minimum_issues' => 'recenzja musi zawierać przynajmniej :count problem|recenzja musi zawierać przynajmniej :count problemy|recenzja musi zawierać przynajmniej :count problemów',
            'missing_text' => 'blok nie zawiera tekstu',
            'too_many_blocks' => 'recenzje mogą zawierać wyłącznie :count akapit/problem|recenzje mogą zawierać do :count akapitów/problemów|recenzje mogą zawierać do :count akapitów/problemów',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Oznaczone jako rozwiązane przez :user',
            'false' => 'Otworzone ponownie przez :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'główne',
        'general_all' => 'główne (wszystkie)',
    ],

    'user_filter' => [
        'everyone' => 'Wszyscy',
        'label' => 'Filtruj według użytkownika',
    ],
];
