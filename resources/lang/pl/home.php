<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'landing' => [
        'download' => 'Pobierz teraz',
        'online' => '<strong>:players</strong> użytkowników jest obecnie online w <strong>:games</strong> meczach',
        'peak' => ':count użytkowników online',
        'players' => '<strong>:count</strong> zarejestrowanych użytkowników',

        'slogan' => [
            'main' => 'darmowa gra rytmiczna',
            'sub' => 'rytm jest tylko o klik stąd!',
        ],
    ],
    'search' => [
        'advanced_link' => 'Zaawansowane wyszukiwanie',
        'button' => 'Szukaj',
        'empty_result' => 'Nie znaleziono!',
        'missing_query' => 'Wyszukiwane hasło musi mieć minimalnie :n znaki',
        'title' => 'Wyniki wyszukiwania',
        'beatmapset' => [
            'more' => 'Zobacz więcej wyszukanych beatmap: :count',
            'more_simple' => 'Zobacz więcej wyszukanych beatmap',
            'title' => 'Beatmapy',
        ],
        'forum_post' => [
            'all' => 'Wszystkie fora',
            'link' => 'Przeszukaj forum',
            'more_simple' => 'Zobacz więcej znalezionych wątków na forum',
            'title' => 'Forum',
            'label' => [
                'forum' => 'przeszukaj fora',
                'forum_children' => 'uwzględnij subfora',
                'topic_id' => 'wątek #',
                'username' => 'autor',
            ],
        ],
        'mode' => [
            'all' => 'wszystkie',
            'beatmapset' => 'beatmapa',
            'forum_post' => 'forum',
            'user' => 'użytkownik',
            'wiki_page' => 'wiki',
        ],
        'user' => [
            'more' => 'Zobacz więcej wyszukanych użytkowników: :count',
            'more_simple' => 'Zobacz więcej wyszukanych użytkowników',
            'more_hidden' => 'Wyniki wyszukiwania są ograniczone do :max graczy. Spróbuj zmienić wyszukiwaną frazę.',
            'title' => 'Użytkownicy',
        ],
        'wiki_page' => [
            'link' => 'Przeszukaj wiki',
            'more_simple' => 'Zobacz więcej wyszukanych artykułów na wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => 'rozpocznij swoją<br>przygodę z osu!',
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
            'title' => 'Wiadomości',
            'error' => 'Wystąpił błąd, spróbuj odświeżyć stronę.',
        ],
        'header' => [
            'welcome' => 'Witaj, <strong>:username</strong>!',
            'messages' => 'Masz 1 nową wiadomość|Masz :count nowe wiadomości|Masz :count nowych wiadomości',
            'stats' => [
                'friends' => 'Znajomi online',
                'games' => 'Mecze',
                'online' => 'Użytkownicy online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nowe rankingowe beatmapy',
            'popular' => 'Popularne beatmapy',
            'by' => 'stworzona przez',
            'plays' => ':count zagrań',
        ],
        'buttons' => [
            'download' => 'Pobierz osu!',
            'support' => 'Wesprzyj osu!',
            'store' => 'Sklep osu!',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Wygląda na to, że dobrze się bawisz! :D',
        'body' => [
            'part-1' => 'Czy wiesz, że osu! nie zawiera reklam i jest utrzymywane dzięki wsparciu graczy?',
            'part-2' => 'Czy wiesz, że wspierając osu! otrzymasz wiele przydatnych funkcji takich jak <strong>automatyczne pobieranie beatmap</strong> podczas gier wieloosobowych, oraz oglądania innych graczy?',
        ],
        'find-out-more' => 'Kliknij tutaj, aby dowiedzieć się więcej!',
        'download-starting' => 'A, i nie martw się - pobieranie już się rozpoczęło ;)',
    ],
];
