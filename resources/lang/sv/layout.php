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
        'page_description' => 'osu! - Rytmen är bara ett *klick* bort!  Med Ouendan/EBA, Taiko och originala spel lägen, och en full funktionell nivå redigerare.',
    ],

    'menu' => [
        'home' => [
            '_' => 'hem',
            'account-edit' => 'inställningar',
            'friends-index' => 'vänner',
            'changelog-index' => 'ändringslogg',
            'changelog-show' => 'build',
            'getDownload' => 'ladda ner',
            'getIcons' => 'ikoner',
            'groups-show' => 'grupper',
            'legal-show' => 'information',
            'news-index' => 'nyheter',
            'news-show' => 'nyheter',
            'password-reset-index' => 'återställ lösenord',
            'search' => 'sök',
            'supportTheGame' => 'stötta spelet',
        ],
        'help' => [
            '_' => 'hjälp',
            'getFaq' => 'faq',
            'getSupport' => 'support', //obsolete
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'show' => 'info',
            'index' => 'listning',
            'artists' => 'framhävda artister',
            'packs' => 'samling',
            'beatmapset-watches-index' => 'modding övervakningslista',
            // 'getCharts' => 'charts',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'rankning',
            'index' => 'prestanda',
            'performance' => 'prestanda',
            'charts' => 'diagram',
            'score' => 'poäng',
            'country' => 'land',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'gemenskap',
            'dev' => 'osu!dev',
            'getForum' => 'forum', // Base text changed to plural, please check.
            'getChat' => 'chatt',
            'getLive' => 'live',
            'contests' => 'tävlingar',
            'profile' => 'profil',
            'tournaments' => 'turneringar',
            'tournaments-index' => 'turneringar',
            'tournaments-show' => 'turnering info',
            'forum-topic-watches-index' => 'prenumerationer',
            'forum-topics-create' => 'forum', // Base text changed to plural, please check.
            'forum-topics-show' => 'forum', // Base text changed to plural, please check.
            'forum-forums-index' => 'forum', // Base text changed to plural, please check.
            'forum-forums-show' => 'forum', // Base text changed to plural, please check.
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
            'show' => 'match',
        ],
        'error' => [
            '_' => 'fel',
            '404' => 'saknas',
            '403' => 'förbjuds',
            '401' => 'ej autentiserad',
            '405' => 'saknas',
            '500' => 'någonting gick isönder',
            '503' => 'underhåll',
        ],
        'user' => [
            '_' => 'användare',
            'getLogin' => 'logga in',
            'disabled' => 'inaktiverad',

            'register' => 'registrera',
            'reset' => 'återhämta',
            'new' => 'ny',

            'messages' => 'Meddelanden',
            'settings' => 'Inställningar',
            'logout' => 'Logga Ut', // Base text changed from "Log Out" to "Sign Out", please check.
            'help' => 'Hjälp',
        ],
        'store' => [
            '_' => 'butik',
            'checkout-show' => 'checka ut',
            'getListing' => 'listning',
            'cart-show' => 'kundvagn',

            'getCheckout' => 'checka ut',
            'getInvoice' => 'faktura',
            'products-show' => 'produkt',

            'new' => 'ny',
            'home' => 'hem',
            'index' => 'hem',
            'thanks' => 'tack',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'forum omslag',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'orders',
            'orders-show' => 'order',
        ],
        'admin' => [
            '_' => 'admin',
            'root' => 'index',
            'logs-index' => 'logg',
            'beatmapsets' => [
                '_' => 'beatmap samlingar',
                'covers' => 'omslag',
                'show' => 'detaljer',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Allmänt',
            'home' => 'Hem',
            'changelog-index' => 'Ändringslogg',
            'beatmaps' => 'Beatmap Listningar',
            'download' => 'Ladda Ner osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Hjälp & Gemenskap',
            'faq' => 'Vanliga Frågor',
            'forum' => 'GemenskapsForum',
            'livestreams' => 'Live Strömmar',
            'report' => 'Rapportera ett Problem',
        ],
        'support' => [
            '_' => 'Stötta osu!',
            'tags' => 'Supporter Taggar',
            'merchandise' => 'Handelsvaror',
        ],
        'legal' => [
            '_' => 'Juridik & Status',
            'copyright' => 'Copyright (DMCA)',
            'osu_status' => '@osustatus',
            'server_status' => 'Server Status',
            'terms' => 'Användarvillkor',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Sida saknas',
            'description' => 'Förlåt, men sidan du frågade efter finns inte här!',
            'link' => false,
        ],
        '403' => [
            'error' => 'Du bör inte vara här',
            'description' => 'Du kan däremot försöka gå tillbaka.',
            'link' => false,
        ],
        '401' => [
            'error' => 'Du bör inte vara här',
            'description' => 'Du kan däremot försöka gå tillbaka. Eller kanske logga in.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Sida saknas',
            'description' => 'Förlåt, men sidan du frågade efter finns inte här!',
            'link' => false,
        ],
        '500' => [
            'error' => 'Oh nej! Något gick isönder! ;_;',
            'description' => 'Vi blir automatiskt notifierade av varje fel',
            'link' => false,
        ],
        'fatal' => [
            'error' => 'Oh nej! Något gick verkligen isönder! ;_;',
            'description' => 'Vi blir automatiskt notifierade av varje fel',
            'link' => false,
        ],
        '503' => [
            'error' => 'Nere för underhåll!',
            'description' => 'Underhåll brukar oftast ta från 5 sekunder till 10 minuter. Om vi är nere längre, se :link för mer information.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => 'Bara ifall att, här är en kod du kan ge till support!',
    ],

    'popup_login' => [
        'login' => [
            'email' => 'email adress',
            'forgot' => 'Jag har glömt mina detaljer',
            'password' => 'lösenord',
            'title' => 'Logga In För Att Fortsätta',

            'error' => [
                'email' => 'Användarnamn eller email adress finns inte',
                'password' => 'Inkorrekt lösenord',
            ],
        ],

        'register' => [
            'info' => 'Herrn, du behöver ett konto. Varför har du inte ett redan?',
            'title' => 'Har du inte ett konto?',
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Inställningar',
            'friends' => 'Vänner',
            'logout' => 'Logga Ut', // Base text changed from "Log Out" to "Sign Out", please check.
            'profile' => 'Min Profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Skriv för att söka!',
        'retry' => 'Sökning misslyckades. Klicka för att försöka igen.',
    ],
];
