<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Odtwarzaj następny utwór automatycznie',
    ],

    'defaults' => [
        'page_description' => 'osu! - rytm jest tylko o *klik* stąd! Z Ouendanem/EBA, Taiko i oryginalnymi trybami gry, a także w pełni funkcjonalnym edytorem!',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'zestaw beatmap',
            'beatmapset_covers' => 'tła zestawów beatmap',
            'contest' => 'konkurs',
            'contests' => 'konkursy',
            'root' => 'konsola',
            'store_orders' => 'administrator sklepu',
        ],

        'artists' => [
            'index' => 'lista',
        ],

        'changelog' => [
            'index' => 'lista',
        ],

        'help' => [
            'index' => 'strona główna',
            'sitemap' => 'Mapa strony',
        ],

        'store' => [
            'cart' => 'koszyk',
            'orders' => 'historia zamówień',
            'products' => 'produkty',
        ],

        'tournaments' => [
            'index' => 'lista',
        ],

        'users' => [
            'modding' => 'modowanie',
            'show' => 'informacje',
        ],
    ],

    'gallery' => [
        'close' => 'Zamknij (Esc)',
        'fullscreen' => 'Przełącz tryb pełnoekranowy',
        'zoom' => 'Przybliż/oddal',
        'previous' => 'Wstecz (strzałka w lewo)',
        'next' => 'Dalej (strzałka w prawo)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmapy',
            'artists' => 'wyróżnieni artyści',
            'index' => 'lista',
            'packs' => 'paczki',
        ],
        'community' => [
            '_' => 'społeczność',
            'chat' => 'czat',
            'contests' => 'konkursy',
            'dev' => 'rozwój',
            'forum-forums-index' => 'forum',
            'getLive' => 'na żywo',
            'tournaments' => 'turnieje',
        ],
        'help' => [
            '_' => 'pomoc',
            'getAbuse' => 'zgłoś nadużycie',
            'getFaq' => 'faq',
            'getRules' => 'zasady',
            'getSupport' => 'pomoc techniczna',
            'getWiki' => 'wiki',
        ],
        'home' => [
            '_' => 'strona główna',
            'changelog-index' => 'zmiany',
            'getDownload' => 'pobierz',
            'news-index' => 'aktualności',
            'search' => 'wyszukiwarka',
            'team' => 'zespół',
        ],
        'rankings' => [
            '_' => 'rankingi',
            'charts' => 'wyróżnionych',
            'country' => 'krajowy',
            'index' => 'globalny',
            'kudosu' => 'kudosu',
            'multiplayer' => 'wieloosobowy',
            'score' => 'punktowy',
        ],
        'store' => [
            '_' => 'sklep',
            'cart-show' => 'koszyk',
            'getListing' => 'przedmioty',
            'orders-index' => 'historia zamówień',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Główne',
            'home' => 'Strona główna',
            'changelog-index' => 'Zmiany',
            'beatmaps' => 'Beatmapy',
            'download' => 'Pobierz osu!',
        ],
        'help' => [
            '_' => 'Pomoc i społeczność',
            'faq' => 'Często zadawane pytania',
            'forum' => 'Forum',
            'livestreams' => 'Na żywo',
            'report' => 'Zgłoś problem',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Prawne i status',
            'copyright' => 'Prawa Autorskie (DMCA)',
            'privacy' => 'Prywatność',
            'server_status' => 'Status serwera',
            'source_code' => 'Kod źródłowy',
            'terms' => 'Warunki świadczenia usług',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Nieprawidłowy parametr żądania',
            'description' => '',
        ],
        '404' => [
            'error' => 'Nie znaleziono strony',
            'description' => "Przepraszamy, ale poszukiwana strona nie istnieje!",
        ],
        '403' => [
            'error' => "Nie powinno cię tu być.",
            'description' => 'Jednakże możesz spróbować się wrócić.',
        ],
        '401' => [
            'error' => "Nie powinno cię tu być.",
            'description' => 'Jednakże możesz spróbować się wrócić albo się zalogować.',
        ],
        '405' => [
            'error' => 'Nie znaleziono strony',
            'description' => "Przepraszamy, ale poszukiwana strona nie istnieje!",
        ],
        '422' => [
            'error' => 'Nieprawidłowy parametr żądania',
            'description' => '',
        ],
        '429' => [
            'error' => '',
            'description' => '',
        ],
        '500' => [
            'error' => 'O nie! Coś się popsuło! ;_;',
            'description' => "Jesteśmy automatycznie powiadamiani o każdym problemie.",
        ],
        'fatal' => [
            'error' => 'O nie! Coś się (bardzo) popsuło! ;_;',
            'description' => "Jesteśmy automatycznie powiadamiani o każdym problemie.",
        ],
        '503' => [
            'error' => 'Przerwa techniczna!',
            'description' => "Przerwa techniczna zajmuje od 5 sekund do 10 minut. Jeżeli jesteśmy niedostępni na dłużej, sprawdź :link, aby dowiedzieć się więcej.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Na wszelki wypadek, tutaj jest kod, który możesz przekazać osobom z pomocy technicznej!",
    ],

    'popup_login' => [
        'button' => 'zaloguj się / utwórz konto',

        'login' => [
            'forgot' => "Nie pamiętam swoich danych logowania",
            'password' => 'hasło',
            'title' => 'Zaloguj się, aby przejść dalej',
            'username' => 'nazwa użytkownika',

            'error' => [
                'email' => "Nazwa użytkownika bądź adres e-mail nie istnieją",
                'password' => 'Nieprawidłowe hasło',
            ],
        ],

        'register' => [
            'download' => 'Pobierz',
            'info' => 'Pobierz osu!, aby utworzyć swoje własne konto!',
            'title' => "Nie posiadasz konta?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Ustawienia',
            'follows' => 'Listy obserwowanych',
            'friends' => 'Znajomi',
            'logout' => 'Wyloguj się',
            'profile' => 'Mój profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Napisz, aby wyszukać!',
        'retry' => 'Wyszukiwanie nieudane. Kliknij tutaj, aby spróbować ponownie.',
    ],
];
