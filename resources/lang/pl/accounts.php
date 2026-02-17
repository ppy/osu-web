<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'ustawienia konta',
        'username' => 'nazwa użytkownika',

        'avatar' => [
            'title' => 'Awatar',
            'reset' => 'zresetuj',
            'rules' => 'Upewnij się, że twój awatar jest zgodny z :link.<br/>Oznacza to, że musi być <strong>stosowny dla wszystkich grup wiekowych</strong> i nie może ukazywać nagości, wulgarności ani sugestywnej zawartości.',
            'rules_link' => 'wymaganiami dot. treści wizualnych',
        ],

        'email' => [
            'new' => 'nowy e-mail',
            'new_confirmation' => 'potwierdź e-mail',
            'title' => 'E-mail',
            'locked' => [
                '_' => 'Skontaktuj się z :accounts, jeżeli chcesz zaktualizować swój adres e-mail.',
                'accounts' => 'zespołem obsługi kont',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'API wersji pierwszej',
        ],

        'password' => [
            'current' => 'obecne hasło',
            'new' => 'nowe hasło',
            'new_confirmation' => 'potwierdź hasło',
            'title' => 'Hasło',
        ],

        'profile' => [
            'country' => 'kraj',
            'title' => 'Profil',

            'country_change' => [
                '_' => "Wygląda na to, że kraj przypisany do konta nie zgadza się z twoim krajem zamieszkania. :update_link.",
                'update_link' => 'Zaktualizuj na „:country”',
            ],

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

    'github_user' => [
        'info' => "Jeśli przyczyniasz się do rozwoju otwartoźródłowych projektów osu!, połączenie konta GitHub pozwoli na powiązanie odpowiednich pozycji na liście zmian z twoim profilem osu!. Konta GitHub bez zarejestrowanego wkładu w repozytoria osu! nie będą mogły zostać połączone.",
        'link' => 'Połącz konto GitHub',
        'title' => 'GitHub',
        'unlink' => 'Rozłącz konto GitHub',

        'error' => [
            'already_linked' => 'To konto GitHub jest już połączone z innym użytkownikiem.',
            'no_contribution' => 'Nie możesz połączyć konta GitHub bez zarejestrowanego wkładu w repozytoria osu!.',
            'unverified_email' => 'Zweryfikuj swój główny adres e-mail na GitHub, a następnie spróbuj połączyć konto ponownie.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'otrzymuj powiadomienia o nowych problemach z zakwalifikowanymi beatmapami dla następujących trybów',
        'beatmapset_disqualify' => 'otrzymuj powiadomienia o dyskwalifikacjach beatmap następujących trybów',
        'comment_reply' => 'otrzymuj powiadomienia o odpowiedziach do twoich komentarzy',
        'news_post' => 'otrzymuj powiadomienia o nowych postach',
        'title' => 'Powiadomienia',
        'topic_auto_subscribe' => 'automatycznie włączaj powiadomienia dla twoich wątków na forum',

        'options' => [
            '_' => 'opcje wysyłania',
            'beatmap_owner_change' => 'gościnny poziom trudności',
            'beatmapset:modding' => 'dyskusje beatmap',
            'channel_message' => 'wiadomości prywatne na czacie',
            'channel_team' => 'wiadomości na czacie zespołu',
            'comment_new' => 'nowe komentarze',
            'forum_topic_reply' => 'odpowiedzi do wątków',
            'mail' => 'e-mail',
            'mapping' => 'twórca',
            'news_post' => 'aktualności',
            'push' => 'push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autoryzowani klienci',
        'own_clients' => 'moi klienci',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_anime_cover' => '',
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
        'mouse' => 'mysz',
        'tablet' => 'tablet',
        'title' => 'Style gry',
        'touch' => 'ekran dotykowy',
    ],

    'privacy' => [
        'friends_only' => 'blokuj wiadomości prywatne od osób spoza listy znajomych',
        'hide_online' => 'ukryj swoją obecność online',
        'hide_online_info' => 'jednoznaczne ze statusem „Nie przeszkadzać” w osu!lazer',
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

    'user_totp' => [
        'title' => 'Aplikacja uwierzytelniająca',
        'usage_note' => 'Użyj aplikacji uwierzytelniającej zamiast e-mailu, aby się zweryfikować. Weryfikacja przez e-mail będzie nadal dostępna jako opcja zapasowa.',

        'button' => [
            'remove' => 'Usuń',
            'setup' => 'Dodaj aplikację uwierzytelniającą',
        ],
        'status' => [
            'label' => 'status',
            'not_set' => 'Nie skonfigurowano',
            'set' => 'Skonfigurowano',
        ],
    ],

    'verification_completed' => [
        'text' => 'Możesz zamknąć to okno',
        'title' => 'Weryfikacja została zakończona',
    ],

    'verification_invalid' => [
        'title' => 'Nieprawidłowy lub przedawniony link weryfikacyjny',
    ],
];
