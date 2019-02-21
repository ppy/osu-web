<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        'page_description' => 'osu! - Rytmus je len o klikaní! Spolu s Quendan/EBA, Taikem a originálnými hernými módmi a plne funkčným level editorom.',
    ],

    'menu' => [
        'home' => [
            '_' => 'domov',
            'account-edit' => 'nastavenia',
            'friends-index' => 'priatelia',
            'changelog-index' => 'záznam zmien',
            'changelog-build' => 'budovanie',
            'getDownload' => 'stiahnúť',
            'getIcons' => 'ikony',
            'groups-show' => 'skupiny',
            'index' => 'nástenka',
            'legal-show' => 'informácie',
            'messages-index' => '',
            'news-index' => 'novinky',
            'news-show' => 'novinky',
            'password-reset-index' => 'obnoviť heslo',
            'search' => 'hľadať',
            'supportTheGame' => 'podporiť hru',
            'team' => 'tím',
        ],
        'help' => [
            '_' => 'pomoc',
            'getFaq' => 'faq',
            'getRules' => 'pravidlá',
            'getSupport' => 'nie, vážne, potrebujem pomoc!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmapy',
            'artists' => 'významní umelci',
            'beatmap_discussion_posts-index' => 'príspevky diskusie o beatmape',
            'beatmap_discussions-index' => 'diskusia o beatmape',
            'beatmapset-watches-index' => 'sledovanie moddingu',
            'beatmapset_discussion_votes-index' => 'diskusné beatmap hlasovanie',
            'beatmapset_events-index' => 'eventy beatmapestov',
            'index' => 'výpis',
            'packs' => 'balíčky',
            'show' => 'informácie',
        ],
        'beatmapsets' => [
            '_' => 'beatmapy',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'rebríčky',
            'index' => 'výkon',
            'performance' => 'výkon',
            'charts' => 'výber',
            'score' => 'skóre',
            'country' => 'krajina',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'komunita',
            'chat' => '',
            'chat-index' => '',
            'dev' => 'vývoj',
            'getForum' => 'fórum',
            'getLive' => 'naživo',
            'comments-index' => 'komentáre',
            'comments-show' => 'komentovať',
            'contests' => 'súťaže',
            'profile' => 'profil',
            'tournaments' => 'turnaje',
            'tournaments-index' => 'turnaje',
            'tournaments-show' => 'informácie o turnaji',
            'forum-topic-watches-index' => 'predplatné',
            'forum-topics-create' => 'fórum',
            'forum-topics-show' => 'fórum',
            'forum-forums-index' => 'fórum',
            'forum-forums-show' => 'fórum',
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
            'show' => 'zápas',
        ],
        'error' => [
            '_' => 'chyba',
            '404' => 'chýbajúce',
            '403' => 'zakázané',
            '401' => 'neoprávnený',
            '405' => 'chýbajúce',
            '500' => 'niečo sa pokazilo',
            '503' => 'údržba',
        ],
        'user' => [
            '_' => 'užívateľ',
            'getLogin' => 'prihlásiť sa',
            'disabled' => 'zakázane',

            'register' => 'registrácia',
            'reset' => 'obnoviť',
            'new' => 'nový',

            'messages' => 'Správy',
            'settings' => 'Nastavenia',
            'logout' => 'Odhlásiť Sa',
            'help' => 'Pomoc',
            'modding-history-discussions' => 'užívateľská modding diskusia',
            'modding-history-events' => 'užívateľské modding udalosti',
            'modding-history-index' => 'užívateľská modding história',
            'modding-history-posts' => 'užívateľské modding príspevky',
            'modding-history-votesGiven' => 'používateľské modding hlasy rozdané',
            'modding-history-votesReceived' => 'používateľské modding hlasy obdržané',
        ],
        'store' => [
            '_' => 'obchod',
            'checkout-show' => 'k pokladni',
            'getListing' => 'výpis',
            'cart-show' => 'košík',

            'getCheckout' => 'zaplatiť',
            'getInvoice' => 'faktúra',
            'orders-index' => 'história objednávok',
            'products-show' => 'produkt',

            'new' => 'nový',
            'home' => 'domov',
            'index' => 'domov',
            'thanks' => 'ďakujem',
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
            '_' => 'Všeobecné',
            'home' => 'Domov',
            'changelog-index' => 'Zoznam zmien',
            'beatmaps' => 'Zoznam beatmap',
            'download' => 'Stiahnuť osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Pomoc & Komunita',
            'faq' => 'Často Kladené Otázky',
            'forum' => 'Komunitné Fóra',
            'livestreams' => 'Živé Vysielania',
            'report' => 'Nahlásiť Chybu',
        ],
        'legal' => [
            '_' => 'Právne záležitosti & Stav serveru',
            'copyright' => 'Autorské práva (DMCA)',
            'privacy' => 'Súkromie',
            'server_status' => 'Stav Serveru',
            'source_code' => 'Zdrojový Kód',
            'terms' => 'Podmienky',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Stránka Chýba',
            'description' => "Prepáčte, ale požadovaná stránka tu nie je!",
        ],
        '403' => [
            'error' => "Tu by si nemal byť.",
            'description' => 'Môžete sa pokúsiť vrátiť späť.',
        ],
        '401' => [
            'error' => "Tu by si nemal byť.",
            'description' => 'Môžete sa pokúsiť vrátiť späť. Alebo sa možno prihlásiť.',
        ],
        '405' => [
            'error' => 'Stránka Chýba',
            'description' => "Prepáčte, ale požadovaná stránka tu nie je!",
        ],
        '500' => [
            'error' => 'Ale nie! Niečo sa pokazilo! ;_;',
            'description' => "Sme automaticky oznámení o každej chybe.",
        ],
        'fatal' => [
            'error' => 'Ale nie! Niečo sa pokazilo (vážne)! ;_;',
            'description' => "Sme automaticky oznámení o každej chybe.",
        ],
        '503' => [
            'error' => 'Vypnuté kvôli údržbe!',
            'description' => "Údržby zvyčajne trvajú 5 sekúnd až 10 minút. Pokiaľ servery nefungujú dlhšie, choďte :link pre viacej informácií.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Tu je kód, ktorý môžeš napísať na podporu!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'e-mailová adresa',
            'forgot' => "Zabudol som svoje údaje",
            'password' => 'heslo',
            'title' => 'Pre pokračovanie sa prihláste',

            'error' => [
                'email' => "Užívateľské meno alebo e-mailová adresa neexistuje",
                'password' => 'Nesprávne heslo',
            ],
        ],

        'register' => [
            'info' => "Potrebujete účet, pane. Prečo teda jeden nemáte?",
            'title' => "Nemáte účet?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Nastavenia',
            'friends' => 'Priatelia',
            'logout' => 'Odhlásiť Sa',
            'profile' => 'Môj Profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Zadaj hladaný výraz!',
        'retry' => 'Hľadanie sa nepodarilo. Kliknite na Opakovať.',
    ],
];
