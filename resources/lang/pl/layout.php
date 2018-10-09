<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
        'page_description' => 'osu! - rytm jest tylko o *klik* stąd! Z Ouendanem/EBA, Taiko i oryginalnymi trybami gry, a także w pełni funkcjonalnym edytorem!',
    ],

    'menu' => [
        'home' => [
            '_' => 'strona główna',
            'account-edit' => 'ustawienia',
            'friends-index' => 'znajomi',
            'changelog-index' => 'zmiany',
            'changelog-build' => 'kompilacja',
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
            'team' => 'zespół',
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
            'beatmapset_events-index' => 'historia zdarzeń zestawów beatmap',
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
            'dev' => 'rozwój',
            'getForum' => 'forum',
            'getChat' => 'czat',
            'getLive' => 'na żywo',
            'contests' => 'konkursy',
            'profile' => 'profil',
            'tournaments' => 'turnieje',
            'tournaments-index' => 'turnieje',
            'tournaments-show' => 'informacje o turnieju',
            'forum-topic-watches-index' => 'subskrybcje',
            'forum-topics-create' => 'forum',
            'forum-topics-show' => 'forum',
            'forum-forums-index' => 'forum',
            'forum-forums-show' => 'forum',
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
            '503' => 'przerwa techniczna',
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
            'logout' => 'Wyloguj się',
            'help' => 'Pomoc',
            'modding-history-discussions' => 'dyskusje',
            'modding-history-events' => 'historia zdarzeń',
            'modding-history-index' => 'historia użytkownika',
            'modding-history-posts' => 'historia postów',
            'modding-history-votesGiven' => 'głosy oddane',
            'modding-history-votesReceived' => 'głosy otrzymane',
        ],
        'store' => [
            '_' => 'sklep',
            'checkout-show' => 'kasa',
            'getListing' => 'przedmioty',
            'cart-show' => 'koszyk',

            'getCheckout' => 'płatność',
            'getInvoice' => 'paragon',
            'products-show' => 'produkt',

            'new' => 'nowy',
            'home' => 'strona główna',
            'index' => 'strona główna',
            'thanks' => 'dzięki',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'tła forum',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'zamówienia',
            'orders-show' => 'zamówienie',
        ],
        'admin' => [
            '_' => 'admin',
            'beatmapsets-covers' => 'tła zestawu beatmap',
            'logs-index' => 'logi',
            'root' => 'strona główna',

            'beatmapsets' => [
                '_' => 'zestawy beatmap',
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
            '_' => 'Pomoc i społeczność',
            'faq' => 'Często zadawane pytania',
            'forum' => 'Forum',
            'livestreams' => 'Na żywo',
            'report' => 'Zgłoś problem',
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
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Na wszelki wypadek, tutaj jest kod, który możesz przekazać osobom z pomocy technicznej!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'adres e-mail',
            'forgot' => "Nie pamiętam swoich danych logowania",
            'password' => 'hasło',
            'title' => 'Zaloguj się, aby przejść dalej',

            'error' => [
                'email' => "Nazwa użytkownika bądź adres e-mail nie istnieją",
                'password' => 'Nieprawidłowe hasło',
            ],
        ],

        'register' => [
            'info' => "Potrzebujesz konta. Dlaczego by takiego nie stworzyć?",
            'title' => "Nie posiadasz konta?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Ustawienia',
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
