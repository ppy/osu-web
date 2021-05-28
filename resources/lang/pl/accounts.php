<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'ustawienia konta',
        'username' => 'nazwa użytkownika',

        'avatar' => [
            'title' => 'Awatar',
            'rules' => 'Upewnij się, że twój awatar jest zgodny z :link.<br/>Oznacza to, że musi być <strong>stosowny dla wszystkich grup wiekowych</strong> i nie może ukazywać nagości, wulgarności ani sugestywnej zawartości.',
            'rules_link' => 'zasadami społeczności',
        ],

        'email' => [
            'current' => 'obecny e-mail',
            'new' => 'nowy e-mail',
            'new_confirmation' => 'potwierdź e-mail',
            'title' => 'E-mail',
        ],

        'password' => [
            'current' => 'obecne hasło',
            'new' => 'nowe hasło',
            'new_confirmation' => 'potwierdź hasło',
            'title' => 'Hasło',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => '',
                'user_from' => 'obecna lokalizacja',
                'user_interests' => 'zainteresowania',
                'user_occ' => 'zajęcia',
                'user_twitter' => '',
                'user_website' => 'strona internetowa',
            ],
        ],

        'signature' => [
            'title' => 'Sygnatura',
            'update' => 'zaktualizuj',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'otrzymuj powiadomienia o nowych problemach z zakwalifikowanymi beatmapami dla następujących trybów',
        'beatmapset_disqualify' => 'otrzymuj powiadomienia o dyskwalifikacjach beatmap następujących trybów',
        'comment_reply' => 'otrzymuj powiadomienia o odpowiedziach do twoich komentarzy',
        'title' => 'Powiadomienia',
        'topic_auto_subscribe' => 'automatycznie włączaj powiadomienia dla twoich wątków na forum',

        'options' => [
            '_' => 'opcje wysyłania',
            'beatmap_owner_change' => '',
            'beatmapset:modding' => 'dyskusje beatmap',
            'channel_message' => 'wiadomości prywatne na czacie',
            'comment_new' => 'nowe komentarze',
            'forum_topic_reply' => 'odpowiedzi do wątków',
            'mail' => 'e-mail',
            'mapping' => 'twórca',
            'push' => 'push',
            'user_achievement_unlock' => 'odblokowanie medalu',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autoryzowane klienty',
        'own_clients' => 'moje klienty',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'ukryj ostrzeżenia o treściach dla pełnoletnich w beatmapach',
        'beatmapset_title_show_original' => 'pokaż metadane beatmapy w oryginalnym języku',
        'title' => 'Ustawienia strony',

        'beatmapset_download' => [
            '_' => 'domyślny sposób pobierania beatmap',
            'all' => 'z wideo, jeżeli jest ono dostępne',
            'direct' => 'otwórz w osu!direct',
            'no_video' => 'bez wideo',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'klawiatura',
        'mouse' => 'myszka',
        'tablet' => 'tablet',
        'title' => 'Style gry',
        'touch' => 'ekran dotykowy',
    ],

    'privacy' => [
        'friends_only' => 'blokuj prywatne wiadomości od osób spoza listy znajomych',
        'hide_online' => 'ukryj swoją obecność online',
        'title' => 'Prywatność',
    ],

    'security' => [
        'current_session' => 'obecna',
        'end_session' => 'Zakończ sesję',
        'end_session_confirmation' => 'Ta czynność natychmiastowo zakończy sesję na tym urządzeniu. Czy na pewno chcesz to zrobić?',
        'last_active' => 'Ostatnio aktywna:',
        'title' => 'Bezpieczeństwo',
        'web_sessions' => 'sesje internetowe',
    ],

    'update_email' => [
        'update' => 'zaktualizuj',
    ],

    'update_password' => [
        'update' => 'zaktualizuj',
    ],

    'verification_completed' => [
        'text' => 'Możesz zamknąć to okno',
        'title' => 'Weryfikacja została zakończona',
    ],

    'verification_invalid' => [
        'title' => 'Nieprawidłowy lub przedawniony link weryfikacyjny',
    ],
];
