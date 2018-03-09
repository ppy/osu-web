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
    'defaults' => [
        'page_description' => 'osu! - Rytm jest tylko *kliknięcie* stąd! Z Ouendanem/EBA, Taiko i oryginalnymi trybami gry, a także w pełni funkcjonalnym edytorem!',
    ],

    'menu' => [
        'home' => [
            '_' => 'strona główna',
            'account-edit' => 'ustawienia',
            'friends-index' => 'znajomi',
            'changelog-index' => 'zmiany',
            'changelog-show' => 'kompilacja',
            'getDownload' => 'pobierz',
            'getIcons' => 'ikony',
            'groups-show' => 'grupy',
            'index' => 'przegląd',
            'legal-show' => 'informacje',
            'news-index' => 'wiadomości',
            'news-show' => 'wiadomości',
            'password-reset-index' => 'zresetuj hasło',
            'search' => 'wyszukiwarka',
            'supportTheGame' => 'wspomóż grę',
            'team' => 'załoga',
        ],
        'help' => [
            '_' => 'pomoc',
            'getFaq' => 'faq',
            'getRules' => 'zasady',
            'getSupport' => 'pomoc techniczna',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmapy',
            'artists' => 'wyróżnieni artyści',
            'beatmap_discussion_posts-index' => 'posty w dyskusji',
            'beatmap_discussions-index' => 'dyskusje',
            'beatmapset-watches-index' => 'obserwowane dyskusje',
            'beatmapset_discussion_votes-index' => 'głosy w dyskusji',
            'beatmapset_events-index' => 'zdarzenia',
            'index' => 'lista',
            'packs' => 'paczki',
            'show' => 'informacje',
        ],
        'beatmapsets' => [
            '_' => 'beatmapy',
            'discussion' => 'modowanie',
        ],
        'rankings' => [
            '_' => 'rankingi',
            'index' => 'globalny',
            'performance' => 'globalny',
            'charts' => 'wyróżnionych',
            'score' => 'punktowy',
            'country' => 'krajowy',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'społeczność',
            'dev' => 'osu!dev',
            'getForum' => 'forum', // Base text changed to plural, please check.
            'getChat' => 'czat',
            'getLive' => 'na żywo',
            'contests' => 'konkursy',
            'profile' => 'profil',
            'tournaments' => 'turnieje',
            'tournaments-index' => 'turnieje',
            'tournaments-show' => 'informacje o turnieju',
            'forum-topic-watches-index' => 'subskrybcje',
            'forum-topics-create' => 'forum', // Base text changed to plural, please check.
            'forum-topics-show' => 'forum', // Base text changed to plural, please check.
            'forum-forums-index' => 'forum', // Base text changed to plural, please check.
            'forum-forums-show' => 'forum', // Base text changed to plural, please check.
        ],
        'multiplayer' => [
            '_' => 'tryb wieloosobowy',
            'show' => 'mecz',
        ],
        'error' => [
            '_' => 'błąd',
            '404' => 'nie znaleziono strony',
            '403' => 'brak dostępu',
            '401' => 'brak dostępu',
            '405' => 'nie znaleziono strony',
            '500' => 'coś się popsuło',
            '503' => 'konserwacja',
        ],
        'user' => [
            '_' => 'użytkownik',
            'getLogin' => 'zaloguj się',
            'disabled' => 'wyłączone',

            'register' => 'zarejestruj się',
            'reset' => 'odzyskaj dostęp',
            'new' => 'nowy',

            'messages' => 'Wiadomości',
            'settings' => 'Ustawienia',
            'logout' => 'Wyloguj się', // Base text changed from "Log Out" to "Sign Out", please check.
            'help' => 'Pomoc',
        ],
        'store' => [
            '_' => 'sklep',
            'getListing' => 'przedmioty',
            'cart-show' => 'koszyk',
            'cart-show' => 'koszyk',

            'getCheckout' => 'zapłać',
            'getInvoice' => 'paragon',
            'products-show' => 'produkt',

            'new' => 'nowy',
            'home' => 'strona główna',
            'index' => 'strona główna',
            'thanks' => 'dzięki',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'nagłówki na forum',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'zamówienia',
            'orders-show' => 'zamówienie',
        ],
        'admin' => [
            '_' => 'admin',
            'root' => 'strona główna',
            'logs-index' => 'logi',
            'beatmapsets' => [
                '_' => 'beatmapy',
                'show' => 'szczegóły',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Główne',
            'home' => 'Strona główna',
            'changelog-index' => 'Zmiany',
            'beatmaps' => 'Beatmapy',
            'download' => 'Pobierz osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Pomoc i Społeczność',
            'faq' => 'Często zadawane pytania',
            'forum' => 'Forum',
            'livestreams' => 'Na żywo',
            'report' => 'Zgłoś problem',
        ],
        'support' => [
            '_' => 'Wspomóż osu!',
            'tags' => 'Status donatora',
            'merchandise' => 'Sklep',
        ],
        'legal' => [
            '_' => 'Prawne i status',
            'copyright' => 'Prawa Autorskie (DMCA)',
            'osu_status' => '@osustatus',
            'server_status' => 'Status serwera',
            'terms' => 'Warunki świadczenia usług',
        ],
    ],
    'errors' => [
        '404' => [
            'error' => 'Nie znaleziono strony',
            'description' => 'Przepraszamy, ale żądana strona nie istnieje!',
            'link' => false,
        ],
        '403' => [
            'error' => 'Nie powinieneś tu być.',
            'description' => 'Jednakże, możesz spróbować się wrócić.',
            'link' => false,
        ],
        '401' => [
            'error' => 'Nie powinieneś tu być.',
            'description' => 'Jednakże, możesz spróbować się wrócić. Albo się zalogować',
            'link' => false,
        ],
        '405' => [
            'error' => 'Nie znaleziono strony',
            'description' => 'Przepraszamy, ale żądana strona nie istnieje!',
            'link' => false,
        ],
        '500' => [
            'error' => 'O nie! Coś się popsuło! ;_;',
            'description' => 'Jesteśmy automatycznie powiadamieni o tym problemie.',
            'link' => false,
        ],
        'fatal' => [
            'error' => 'O nie! Coś się popsuło (bardzo)! ;_;',
            'description' => 'Jesteśmy automatycznie powiadamieni o tym problemie.',
            'link' => false,
        ],
        '503' => [
            'error' => 'Konserwacja!',
            'description' => 'Konserwacja zajmuje od 5 sekund do 10 minut. Jeżeli jesteśmy niedostępni na dłużej, spojrzyj <a>:link tutaj</a>, aby dowiedzieć się więcej.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => 'Na wszelki wypadek, tutaj jest kod, który możesz przekazać osobom z pomocy technicznej!',
    ],

    'popup_login' => [
        'login' => [
            'email' => 'adres email',
            'forgot' => 'Nie pamiętam moich danych logowania!',
            'password' => 'hasło',
            'title' => 'Zaloguj się, aby przejść dalej',

            'error' => [
                'email' => 'Nazwa użytkownika bądź email nie istnieją',
                'password' => 'Niepoprawne hasło',
            ],
        ],

        'register' => [
            'info' => 'Potrzebujesz konta. Dlaczego by takiego nie stworzyć?',
            'title' => 'Nie masz konta?',
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Ustawienia',
            'friends' => 'Znajomi',
            'logout' => 'Wyloguj się', // Base text changed from "Log Out" to "Sign Out", please check.
            'profile' => 'Mój profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Napisz, aby wyszukać!',
        'retry' => 'Wyszukiwanie nieudane. Kliknij tutaj, aby spróbować ponownie.',
    ],
];
