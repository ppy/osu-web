<?php
/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'page_description' => 'osu! - Rytm jest tylko *kliknięcie* stąd!  Z Ouendanem/EBA, Taiko i oryginalnymi trybami gry, a także w pełni funkcjonalnym edytorem!',
    ],
    'menu' => [
        'home' => [
            '_' => 'strona główna',
            'getChangelog' => 'zmiany',
            'getDownload' => 'pobieranie',
            'getIcons' => 'ikony',
            'getNews' => 'aktualności',
            'supportTheGame' => 'wspomóż grę',
        ],
        'help' => [
            '_' => 'pomoc',
            'getWiki' => 'wiki',
            'getFaq' => 'faq',
            'getSupport' => 'pomoc techniczna',
        ],
        'beatmaps' => [
            '_' => 'beatmapy',
            'show' => 'info',
            'index' => 'lista',
        ],
        'beatmapsets' => [
            '_' => 'mapsety',
            'discussion' => 'modowanie',
        ],
        'ranking' => [
            '_' => 'ranking',
            'getOverall' => 'ogólny',
            'getCountry' => 'krajowy',
            'getCharts' => 'charty',
            'getMapper' => 'mapper',
            'index' => 'ogólne',
        ],
        'community' => [
            '_' => 'społeczność',
            'getForum' => 'forum',
            'getChat' => 'czat',
            'getSupport' => 'pomoc techniczna',
            'getLive' => 'na żywo',
            'getSlack' => 'osu!dev',
            'profile' => 'profil',
            'tournaments' => 'turnieje',
            'tournaments-index' => 'turnieje',
            'tournaments-show' => 'informacje o turniejach',
            'forum-topics-create' => 'forum',
            'forum-topics-show' => 'forum',
            'forum-forums-index' => 'forum',
            'forum-forums-show' => 'forum',
        ],
        'error' => [
            '_' => 'błąd',
            404 => 'nie znaleziono strony',
            403 => 'brak dostępu',
            401 => 'brak dostępu',
            405 => 'nie znaleziono strony',
            500 => 'coś się popsuło',
            503 => 'konserwacja',
        ],
        'user' => [
            '_' => 'użytkownik',
            'getLogin' => 'zaloguj się',
            'disabled' => 'wyłączono',
            'register' => 'zarejestruj się',
            'reset' => 'odzyskaj dostęp',
            'new' => 'nowy',
            'messages' => 'Wiadomości',
            'settings' => 'Ustawienia',
            'logout' => 'Wyloguj się',
            'help' => 'Pomoc',
        ],
        'store' => [
            '_' => 'sklep',
            'getListing' => 'przedmioty',
            'getCart' => 'koszyk',
            'getCheckout' => 'zapłać',
            'getInvoice' => 'paragon',
            'getProduct' => 'produkt',
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
            'logs-index' => 'logi',
            'beatmapsets' => [
                '_' => 'mapsety',
                'covers' => 'nagłówki',
                'show' => 'szczegóły',
            ],
        ],
    ],
    'errors' => [
        404 => [
            'error' => 'Nie znaleziono strony',
            'description' => 'Przepraszamy, ale strona, jaką chciałeś ujrzeć, nie istnieje!',
            'link' => '',
        ],
        403 => [
            'error' => 'Nie powinieneś tu być.',
            'description' => 'Jednakże, możesz spróbować się wrócić.',
            'link' => '',
        ],
        401 => [
            'error' => 'Nie powinieneś tu być.',
            'description' => 'Jednakże, możesz spróbować się wrócić. Albo się zalogować',
            'link' => '',
        ],
        405 => [
            'error' => 'Nie znaleziono strony',
            'description' => 'Przepraszamy, ale strona, jaką chciałeś ujrzeć, nie istnieje!',
            'link' => '',
        ],
        500 => [
            'error' => 'O nie! Coś się popsuło! ;_;',
            'description' => 'Jesteśmy automatycznie powiadamieni o tym problemie.',
            'link' => '',
        ],
        'fatal' => [
            'error' => 'O nie! Coś się popsuło (bardzo)! ;_;',
            'description' => 'Jesteśmy automatycznie powiadamieni o tym problemie.',
            'link' => '',
        ],
        503 => [
            'error' => 'Konserwacja!',
            'description' => 'Konserwacja zajmuje od 5 sekund do 10 minut. Jeżeli jesteśmy niedostępni na dłużej, spojrzyj <a>:link tutaj</a>, aby dowiedzieć się więcej.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        'reference' => 'Na wszelki wypadek, tutaj jest kod który możesz dać osobom z pomocy technicznej!',
    ],
];
