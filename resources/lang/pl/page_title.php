<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        '_' => 'admin',
    ],
    'error' => [
        'error' => [
            '400' => 'nieprawidłowe żądanie',
            '404' => 'nie znaleziono',
            '403' => 'brak dostępu',
            '401' => 'odmowa dostępu',
            '401-verification' => 'weryfikacja konta',
            '405' => 'nie znaleziono',
            '422' => 'nieprawidłowe żądanie',
            '429' => 'zbyt wiele żądań',
            '500' => 'coś się popsuło',
            '503' => 'przerwa techniczna',
        ],
    ],
    'forum' => [
        '_' => 'forum',
        'topic_logs_controller' => [
            'index' => 'historia zdarzeń wątku',
        ],
    ],
    'main' => [
        'account_controller' => [
            'verify_link' => 'weryfikacja konta',
        ],
        'artists_controller' => [
            '_' => 'wyróżnieni artyści',
        ],
        'beatmap_discussion_posts_controller' => [
            '_' => 'posty w dyskusji beatmapy',
        ],
        'beatmap_discussions_controller' => [
            '_' => 'dyskusje beatmapy',
        ],
        'beatmap_packs_controller' => [
            '_' => 'paczki beatmap',
        ],
        'beatmapset_discussion_votes_controller' => [
            '_' => 'głosy w dyskusji beatmapy',
        ],
        'beatmapset_events_controller' => [
            '_' => 'historia beatmap',
        ],
        'beatmapsets_controller' => [
            'discussion' => 'dyskusja beatmapy',
            'index' => 'lista beatmap',
            'show' => 'informacje o beatmapie',
            'versions' => 'historia beatmapy',
        ],
        'changelog_controller' => [
            '_' => 'zmiany',
        ],
        'chat_controller' => [
            '_' => 'czat',
        ],
        'comments_controller' => [
            '_' => 'komentarze',
        ],
        'contest_entries_controller' => [
            'judge_results' => 'wyniki oceny prac konkursowych',
        ],
        'contests_controller' => [
            '_' => 'konkursy',
            'judge' => 'ocena prac konkursowych',
        ],
        'group_history_controller' => [
            '_' => 'historia grupy',
        ],
        'groups_controller' => [
            'show' => 'grupy',
        ],
        'home_controller' => [
            'get_download' => 'pobierz',
            'index' => 'strona główna',
            'search' => 'wyszukiwarka',
            'support_the_game' => 'wspomóż grę',
            'testflight' => 'testflight',
        ],
        'legacy_matches_controller' => [
            '_' => 'mecze',
        ],
        'legal_controller' => [
            '_' => 'informacje',
        ],
        'livestreams_controller' => [
            '_' => 'na żywo',
        ],
        'news_controller' => [
            '_' => 'aktualności',
        ],
        'notifications_controller' => [
            '_' => 'historia powiadomień',
        ],
        'password_reset_controller' => [
            '_' => 'resetowanie hasła',
        ],
        'ranking_controller' => [
            '_' => 'rankingi',
        ],
        'scores_controller' => [
            '_' => 'wynik',
        ],
        'seasons_controller' => [
            '_' => 'rankingi',
        ],
        'teams_controller' => [
            '_' => 'zespoły',
            'create' => 'utwórz zespół',
            'edit' => 'ustawienia zespołu',
            'leaderboard' => 'ranking zespołu',
            'show' => 'informacje o zespole',
        ],
        'tournaments_controller' => [
            '_' => 'turnieje',
        ],
        'user_cover_presets_controller' => [
            '_' => 'konfiguracja domyślnych teł profili',
        ],
        'user_totp_controller' => [
            '_' => 'aplikacja uwierzytelniająca',
        ],
        'users_controller' => [
            '_' => 'informacje o użytkowniku',
            'create' => 'rejestracja',
            'disabled' => 'powiadomienie',
        ],
        'wiki_controller' => [
            '_' => 'wiki',
        ],
    ],
    'multiplayer' => [
        'rooms_controller' => [
            'events' => 'historia meczu',
        ],
    ],
    'passport' => [
        'authorization_controller' => [
            '_' => 'autoryzuj aplikację',
        ],
    ],
    'store' => [
        '_' => 'sklep',
    ],
    'teams' => [
        'members_controller' => [
            'index' => 'członkowie zespołu',
        ],
    ],
    'users' => [
        'modding_history_controller' => [
            '_' => 'informacje o modowaniu',
        ],
        'multiplayer_controller' => [
            '_' => 'historia gier w trybie wieloosobowym',
        ],
    ],
];
