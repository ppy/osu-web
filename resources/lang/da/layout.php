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
        'page_description' => 'osu! - Rytmen er kun et *klik* away!  Med Ouendan/EBA, Taiko og originale spiltilstande, såvel som en fuld funktionel beatmap-editor.',
    ],

    'menu' => [
        'home' => [
            '_' => 'hjem',
            'account-edit' => 'indstillinger',
            'friends' => 'venner',
            'friends-index' => 'venner',
            'changelog-index' => 'changelog',
            'changelog-show' => 'build',
            'getDownload' => 'download',
            'getIcons' => 'ikoner',
            'groups-show' => 'grupper',
            'index' => 'osu!',
            'legal-show' => 'information',
            'news-index' => 'nyheder',
            'news-show' => 'nyheder',
            'password-reset-index' => 'nulstil adgangskode',
            'search' => 'søg',
            'supportTheGame' => 'støt spillet',
        ],
        'help' => [
            '_' => 'hjælp',
            'getFaq' => 'faq',
            'getSupport' => 'support',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'show' => 'info',
            'index' => 'liste',
            'artists' => 'fremhævede artister',
            'packs' => 'pakker',
            'beatmapset-watches-index' => 'modding watchlist',
            // 'getCharts' => 'charts',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'rangering',
            'index' => 'præstation',
            'performance' => 'præstation',
            'charts' => 'diagrammer',
            'score' => 'score',
            'country' => 'land',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'fællesskab',
            'dev' => 'osu!dev',
            'getForum' => 'forum',
            'getChat' => 'chat',
            'getSupport' => 'support',
            'getLive' => 'live',
            'contests' => 'konkurrencer',
            'profile' => 'profil',
            'tournaments' => 'turneringer',
            'tournaments-index' => 'turneringer',
            'tournaments-show' => 'turneringsinfo',
            'forum-topic-watches-index' => 'abonnementer',
            'forum-topics-create' => 'forum',
            'forum-topics-show' => 'forum',
            'forum-forums-index' => 'forum',
            'forum-forums-show' => 'forum',
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
            'show' => 'match',
        ],
        'error' => [
            '_' => 'fejl',
            '404' => 'mangler',
            '403' => 'nægtet',
            '401' => 'uautoriseret',
            '405' => 'mangler',
            '500' => 'noget er galt',
            '503' => 'vedligeholdelse',
        ],
        'user' => [
            '_' => 'bruger',
            'getLogin' => 'log ind',
            'disabled' => 'deaktiveret',

            'register' => 'registrer',
            'reset' => 'genvind',
            'new' => 'ny',

            'messages' => 'Beskeder',
            'settings' => 'Indstillinger',
            'logout' => 'Log Ud',
            'help' => 'Hjælp',
        ],
        'store' => [
            '_' => 'butik',
            'checkout-index' => 'betaling',
            'getListing' => 'katalog',
            'getCart' => 'indkøbskurv',

            'getCheckout' => 'betaling',
            'getInvoice' => 'faktura',
            'products-show' => 'produkt',

            'new' => 'ny',
            'home' => 'hjem',
            'index' => 'hjem',
            'thanks' => 'tak',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'forum covers',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'ordrer',
            'orders-show' => 'ordre',
        ],
        'admin' => [
            '_' => 'admin',
            'beatmapsets-covers' => 'beatmapset covers',
            'root' => 'index',
            'logs-index' => 'log',
            'beatmapsets' => [
                '_' => 'beatmapsets',
                'show' => 'detalje',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Generelt',
            'home' => 'Hjem',
            'changelog-index' => 'Changelog',
            'beatmaps' => 'Beatmap Lister',
            'download' => 'Download osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Hjælp og Fællesskab',
            'faq' => 'Ofte Stillede Spørgsmål',
            'forum' => 'Fællesskabsforummer',
            'livestreams' => 'Live Streams',
            'report' => 'Rapportér en Fejl',
        ],
        'support' => [
            '_' => 'Støt osu!',
            'tags' => 'Supporter Tags',
            'merchandise' => 'Merchandise',
        ],
        'legal' => [
            '_' => 'Legal & Status',
            'copyright' => 'Copyright (DMCA)',
            'osu_status' => '@osustatus',
            'server_status' => 'Server Status',
            'terms' => 'Betingelser for Brug',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Siden findes ikke',
            'description' => 'Beklager, men siden, du forsøger at finde, eksisterer ikke!',
            'link' => false,
        ],
        '403' => [
            'error' => 'Du burde ikke være her.',
            'description' => 'Du kunne prøve at gå tilbage igen, okay?',
            'link' => false,
        ],
        '401' => [
            'error' => 'Du burde ikke være her.',
            'description' => 'Du kunne prøve at gå tilbage igen, okay? Eller bare logge ind måske.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Siden findes ikke',
            'description' => 'Beklager, men siden, du forsøger at finde, eksisterer ikke!!',
            'link' => false,
        ],
        '500' => [
            'error' => 'Åh nej! Der er noget galt! ;_;',
            'description' => 'Vi er blevet informeret om fejlen.',
            'link' => false,
        ],
        'fatal' => [
            'error' => 'Åh nej! Der er noget galt! ;_;',
            'description' => 'Vi er blevet informeret om fejlen.',
            'link' => false,
        ],
        '503' => [
            'error' => 'Under Vedligeholdelse!',
            'description' => 'Vedligeholdelse tager som regel mellem 5 sekunder og 10 minutter. Hvis siden er nede i længere tid, se :link for mere information.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => 'Her er en kode, som du kan sige videre til support, hvis du vil!',
    ],

    'popup_login' => [
        'login' => [
            'email' => 'email-adresse',
            'forgot' => 'Jeg har glemt min login-info',
            'password' => 'adgangskode',
            'title' => 'Log ind for at fortsætte',

            'error' => [
                'email' => 'Brugernavn eller adgangskode eksisterer ikke',
                'password' => 'Forkert adgangskode',
            ],
        ],

        'register' => [
            'info' => 'Du skal have en konto, min gode mand! Hvor har du ikke én endnu?',
            'title' => 'Har du ikke en konto?',
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Indstillinger',
            'friends' => 'Venner',
            'logout' => 'Log ud',
            'profile' => 'Min Profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Skriv for at søge!',
        'retry' => 'Søgningen fejlede. Prøv igen.',
    ],
];
