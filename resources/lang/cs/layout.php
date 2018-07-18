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
        'page_description' => 'osu! - Rytmus je jen o klkání! Spolu s Ouendan/EBA, Taikem, originálními herními módy a plně funkčním level editorem.',
    ],

    'menu' => [
        'home' => [
            '_' => 'domů',
            'account-edit' => 'nastavení',
            'friends-index' => 'přátelé',
            'changelog-index' => 'seznam změn',
            'changelog-build' => '',
            'getDownload' => 'stáhnout',
            'getIcons' => 'ikony',
            'groups-show' => 'skupiny',
            'index' => 'nástěnka',
            'legal-show' => 'informace',
            'news-index' => 'novinky',
            'news-show' => 'novinky',
            'password-reset-index' => 'obnovit heslo',
            'search' => 'hledat',
            'supportTheGame' => 'podpoř hru',
            'team' => 'tým',
        ],
        'help' => [
            '_' => 'nápověda',
            'getFaq' => 'časté dotazy',
            'getRules' => 'pravidla',
            'getSupport' => 'ne, vážně, potřebuji pomoc!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmapy',
            'artists' => 'významní umělci',
            'beatmap_discussion_posts-index' => 'příspěvky diskuse o beatmapě',
            'beatmap_discussions-index' => 'diskuse o beatmapě',
            'beatmapset-watches-index' => '',
            'beatmapset_discussion_votes-index' => '',
            'beatmapset_events-index' => 'Eventy Beatmapsetů',
            'index' => 'Výpis',
            'packs' => 'balíčky',
            'show' => 'Informace',
        ],
        'beatmapsets' => [
            '_' => 'beatmapy',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'žebříček',
            'index' => 'výkon',
            'performance' => 'výkon',
            'charts' => '',
            'score' => 'Skóre',
            'country' => 'Země',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'komunita',
            'dev' => 'vývoj',
            'getForum' => 'Fórum',
            'getChat' => 'chat',
            'getLive' => 'živě',
            'contests' => 'soutěže',
            'profile' => 'profil',
            'tournaments' => 'turnaje',
            'tournaments-index' => 'turnaje',
            'tournaments-show' => 'Turnajové body',
            'forum-topic-watches-index' => 'Předplatné',
            'forum-topics-create' => 'fórum',
            'forum-topics-show' => 'fórum',
            'forum-forums-index' => 'fórum',
            'forum-forums-show' => 'fórum',
        ],
        'multiplayer' => [
            '_' => 'Hra pro více hráčů',
            'show' => 'zápas',
        ],
        'error' => [
            '_' => 'chyba',
            '404' => 'Chybějící',
            '403' => 'Zakázano.',
            '401' => 'Nepřihlášen',
            '405' => 'Chybějící',
            '500' => 'Něco je rozbité',
            '503' => 'Údržba',
        ],
        'user' => [
            '_' => 'uživatel',
            'getLogin' => 'Přihlásit se',
            'disabled' => 'Vypnuto',

            'register' => 'Registrace',
            'reset' => 'Obnovit',
            'new' => 'Nový',

            'messages' => 'Zprávy',
            'settings' => 'Nastavení',
            'logout' => 'Odhlásit se',
            'help' => 'Nápověda',
            'modding-history-discussions' => '',
            'modding-history-events' => '',
            'modding-history-index' => '',
            'modding-history-posts' => '',
            'modding-history-votesGiven' => '',
            'modding-history-votesReceived' => '',
        ],
        'store' => [
            '_' => 'Obchod',
            'checkout-show' => 'Objednat',
            'getListing' => 'Výpis',
            'cart-show' => 'Košík',

            'getCheckout' => 'Objednat',
            'getInvoice' => 'Faktura',
            'products-show' => 'Produkt',

            'new' => 'Nový',
            'home' => 'Domů',
            'index' => 'Domů',
            'thanks' => 'Děkuji',
        ],
        'admin-forum' => [
            '_' => '',
            'forum-covers-index' => '',
        ],
        'admin-store' => [
            '_' => '',
            'orders-index' => '',
            'orders-show' => '',
        ],
        'admin' => [
            '_' => '',
            'beatmapsets-covers' => '',
            'logs-index' => '',
            'root' => '',

            'beatmapsets' => [
                '_' => '',
                'show' => '',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Obecné',
            'home' => 'Domů',
            'changelog-index' => 'Seznam změn',
            'beatmaps' => 'Seznam Beatmap',
            'download' => 'Stáhnout osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Nápověda & Komunita',
            'faq' => 'Často kladené dotazy',
            'forum' => 'Komunitní fóra',
            'livestreams' => 'Živá vysílání',
            'report' => 'Náhlasit chybu',
        ],
        'support' => [
            '_' => 'Podpoř osu!',
            'tags' => 'Štítek podporovatele',
            'merchandise' => 'Zboží',
        ],
        'legal' => [
            '_' => 'Právní záležitosti & Stav serveru',
            'copyright' => 'Autorské právo (DMCA)',
            'privacy' => 'Soukromí',
            'server_status' => 'Stav serveru',
            'source_code' => 'Zdrojový kód',
            'terms' => 'Podmínky',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Stránka chybí',
            'description' => "Omlouvám se, ale požadovaná stránka není nalezena!",
        ],
        '403' => [
            'error' => "Tady nesmíš být.",
            'description' => 'Můžete se pokusit vrátit zpět.',
        ],
        '401' => [
            'error' => "Tady nesmíš být.",
            'description' => 'Můžete se pokusit vrátit zpět. Nebo možná se přihlásit.',
        ],
        '405' => [
            'error' => 'Stránka chybí',
            'description' => "Omlouvám se, ale požadovaná stránka není nalezena!",
        ],
        '500' => [
            'error' => 'Ale ne, něco je rozbité!',
            'description' => "Jsme automaticky oznámeni o každé chybě.",
        ],
        'fatal' => [
            'error' => 'Ale ne! Něco se pokazilo (Fatálně)! ;_;',
            'description' => "My automaticky upozorňujeme na každou chybu.",
        ],
        '503' => [
            'error' => 'Probíhá údržba!',
            'description' => "Údržby obvykle trvají 5 sekund až 10 minut. Pokud servery nefungují delší dobu, jděte na :link pro více informací.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Tady je kód, který můžeš napsat na podporu!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'e-mailová adresa',
            'forgot' => "Zapomněl jsem své údaje",
            'password' => 'heslo',
            'title' => 'Pro pokračování se přihlašte',

            'error' => [
                'email' => "Uživatelské jméno nebo emailová adresa neexistují",
                'password' => 'Nesprávné heslo',
            ],
        ],

        'register' => [
            'info' => "Potřebujete účet, pane. Proč již jeden nemáte?",
            'title' => "Nemáte účet?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Nastavení',
            'friends' => 'Přátelé',
            'logout' => 'Odhlásit se',
            'profile' => 'Můj profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Zadejte hledaný výraz!',
        'retry' => 'Hledání se nezdařilo. Klepněte na tlačítko Opakovat.',
    ],
];
