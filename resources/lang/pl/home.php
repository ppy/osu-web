<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'landing' => [
        'download' => 'Pobierz teraz',
        'online' => '<strong>:players</strong> użytkowników jest obecnie online w <strong>:games</strong> meczach',
        'peak' => ':count użytkowników online',
        'players' => '<strong>:count</strong> zarejestrowanych użytkowników',
        'title' => 'witaj',
        'see_more_news' => '',

        'slogan' => [
            'main' => 'darmowa gra rytmiczna',
            'sub' => 'rytm jest tylko o klik stąd',
        ],
    ],

    'search' => [
        'advanced_link' => 'Zaawansowane wyszukiwanie',
        'button' => 'Szukaj',
        'empty_result' => 'Nie znaleziono!',
        'keyword_required' => 'Wyszukiwana fraza jest wymagana',
        'placeholder' => 'wpisz, by rozpocząć wyszukiwanie',
        'title' => 'Wyszukiwarka',

        'beatmapset' => [
            'more' => 'Zobacz więcej wyszukanych beatmap: :count',
            'more_simple' => 'Zobacz więcej wyszukanych beatmap',
            'title' => 'Beatmapy',
        ],

        'forum_post' => [
            'all' => 'Całe forum',
            'link' => 'Przeszukaj forum',
            'more_simple' => 'Zobacz więcej wyszukanych wątków na forum',
            'title' => 'Forum',

            'label' => [
                'forum' => 'przeszukaj fora',
                'forum_children' => 'uwzględnij podfora',
                'topic_id' => 'wątek #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'wszystko',
            'beatmapset' => 'beatmapa',
            'forum_post' => 'forum',
            'user' => 'użytkownik',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => 'Zobacz więcej wyszukanych użytkowników: :count',
            'more_simple' => 'Zobacz więcej wyszukanych użytkowników',
            'more_hidden' => 'Wyniki wyszukiwania są ograniczone do :max użytkowników. Spróbuj zmienić wyszukiwaną frazę.',
            'title' => 'Użytkownicy',
        ],

        'wiki_page' => [
            'link' => 'Przeszukaj wiki',
            'more_simple' => 'Zobacz więcej wyszukanych artykułów na wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "rozpocznij swoją<br>przygodę z osu!",
        'action' => 'Pobierz osu!',
        'os' => [
            'windows' => 'dla systemu Windows',
            'macos' => 'dla systemu macOS',
            'linux' => 'dla systemu Linux',
        ],
        'mirror' => 'serwer lustrzany',
        'macos-fallback' => 'użytkownicy macOS',
        'steps' => [
            'register' => [
                'title' => 'utwórz konto',
                'description' => 'postępuj zgodnie z instrukcjami w grze, aby się zarejestrować bądź zalogować',
            ],
            'download' => [
                'title' => 'pobierz grę',
                'description' => 'kliknij przycisk powyżej, aby pobrać instalator, a następnie uruchom go!',
            ],
            'beatmaps' => [
                'title' => 'pobierz beatmapy',
                'description' => [
                    '_' => ':browse ogromną bibliotekę utworzonych przez społeczność beatmap i rozpocznij grę!',
                    'browse' => 'sprawdź',
                ],
            ],
        ],
        'video-guide' => 'poradnik',
    ],

    'user' => [
        'title' => 'przegląd',
        'news' => [
            'title' => 'Aktualności',
            'error' => 'Wystąpił błąd, spróbuj odświeżyć stronę.',
        ],
        'header' => [
            'welcome' => 'Witaj, <strong>:username</strong>!',
            'messages' => 'Masz :count_delimited nową wiadomość|Masz :count_delimited nowe wiadomości|Masz :count_delimited nowych wiadomości',
            'stats' => [
                'friends' => 'Znajomi online',
                'games' => 'Mecze',
                'online' => 'Użytkownicy online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nowe rankingowe beatmapy',
            'popular' => 'Popularne beatmapy',
            'by_user' => '',
        ],
        'buttons' => [
            'download' => 'Pobierz osu!',
            'support' => 'Wspomóż osu!',
            'store' => 'Sklep osu!',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Wygląda na to, że dobrze się bawisz! :D',
        'body' => [
            'part-1' => 'Czy wiesz, że osu! nie zawiera reklam i jest utrzymywane dzięki wsparciu graczy?',
            'part-2' => 'Czy wiesz, że wspierając osu! otrzymasz wiele przydatnych funkcji takich jak <strong>automatyczne pobieranie beatmap</strong> podczas gier wieloosobowych czy oglądania innych graczy?',
        ],
        'find-out-more' => 'Kliknij tutaj, aby dowiedzieć się więcej!',
        'download-starting' => "A, i nie martw się - pobieranie już się rozpoczęło ;)",
    ],
];
