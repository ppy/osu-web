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
        'page_description' => 'osu! - Rytmen är bara ett *klick* bort!  Med Ouendan/EBA, Taiko och originala spel lägen, och en full funktionell nivå redigerare.',
    ],

    'header' => [
        'admin' => [
            '_' => '',
            'beatmapset' => '',
            'beatmapset_covers' => '',
            'contest' => '',
            'contests' => '',
            'root' => '',
            'store_orders' => '',
        ],

        'artists' => [
            '_' => '',
            'index' => '',
        ],

        'beatmapsets' => [
            '_' => '',
            'discussions' => '',
            'index' => '',
            'show' => '',
            'packs' => '',
        ],

        'changelog' => [
            '_' => '',
            'index' => '',
        ],

        'community' => [
            '_' => '',
            'comments' => '',
            'contests' => '',
            'forum' => '',
            'livestream' => '',
        ],

        'error' => [
            '_' => '',
        ],

        'help' => [
            '_' => '',
            'index' => '',
        ],

        'home' => [
            '_' => '',
            'password_reset' => '',
        ],

        'matches' => [
            '_' => '',
        ],

        'notice' => [
            '_' => '',
        ],

        'notifications' => [
            '_' => '',
            'index' => '',
        ],

        'rankings' => [
            '_' => '',
        ],

        'store' => [
            '_' => '',
            'cart' => '',
            'order' => '',
            'orders' => '',
            'product' => '',
            'products' => '',
        ],

        'tournaments' => [
            '_' => '',
            'index' => '',
        ],

        'users' => [
            '_' => '',
            'forum_posts' => '',
            'modding' => '',
            'show' => '',
        ],
    ],

    'gallery' => [
        'close' => '',
        'fullscreen' => '',
        'zoom' => '',
        'previous' => '',
        'next' => '',
    ],

    'menu' => [
        'home' => [
            '_' => 'hem',
            'account-edit' => 'inställningar',
            'account-verifyLink' => '',
            'beatmapset-watches-index' => '',
            'changelog-build' => 'bygget',
            'changelog-index' => 'ändringslogg',
            'client_verifications-create' => '',
            'forum-topic-watches-index' => '',
            'friends-index' => 'vänner',
            'getDownload' => 'ladda ner',
            'getIcons' => 'ikoner',
            'groups-show' => 'grupper',
            'index' => 'kontrollpanel',
            'legal-show' => 'information',
            'messages-index' => '',
            'news-index' => 'nyheter',
            'news-show' => 'nyheter',
            'password-reset-index' => 'återställ lösenord',
            'search' => 'sök',
            'supportTheGame' => 'stötta spelet',
            'team' => 'lag',
            'testflight' => '',
        ],
        'profile' => [
            '_' => '',
            'friends' => '',
            'settings' => '',
        ],
        'help' => [
            '_' => 'hjälp',
            'getFaq' => 'faq',
            'getRules' => 'regler',
            'getSupport' => 'support',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'utvalda artister',
            'beatmap_discussion_posts-index' => 'beatmapdiskussionsinlägg',
            'beatmap_discussions-index' => 'beatmapdiskussioner',
            'beatmapset_discussion_votes-index' => 'beatmapdiskussionsröster',
            'beatmapset_events-index' => 'beatmapset händelser',
            'index' => 'listning',
            'packs' => 'samling',
            'show' => 'info',
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
            'chat' => '',
            'chat-index' => '',
            'dev' => 'utveckling',
            'getForum' => 'forum',
            'getLive' => 'live',
            'comments-index' => '',
            'comments-show' => '',
            'contests' => 'tävlingar',
            'profile' => 'profil',
            'tournaments' => 'turneringar',
            'tournaments-index' => 'turneringar',
            'tournaments-show' => 'turnering info',
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

            'help' => 'Hjälp',
            'logout' => 'Logga Ut',
            'messages' => 'Meddelanden',
            'modding-history-discussions' => 'användarmoddingsdiskussioner',
            'modding-history-events' => 'användarmoddningsinlägg',
            'modding-history-index' => 'användarmoddingshistorik',
            'modding-history-posts' => 'användarmoddingsinlägg',
            'modding-history-votesGiven' => 'användarmoddingsröster givna',
            'modding-history-votesReceived' => 'användarmoddningsröster givna',
            'notifications-index' => '',
            'oauth_login' => '',
            'oauth_request' => '',
            'settings' => 'Inställningar',
        ],
        'store' => [
            '_' => 'butik',
            'checkout-show' => 'checka ut',
            'getListing' => 'listning',
            'cart-show' => 'kundvagn',

            'getCheckout' => 'checka ut',
            'getInvoice' => 'faktura',
            'orders-index' => '',
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
            'beatmapsets-covers' => '',
            'logs-index' => 'logg',
            'root' => 'index',

            'beatmapsets' => [
                '_' => 'beatmap samlingar',
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
        'legal' => [
            '_' => 'Juridik & Status',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Sekretess',
            'server_status' => 'Server Status',
            'source_code' => 'Källkod',
            'terms' => 'Användarvillkor',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Sida saknas',
            'description' => "Förlåt, men sidan du frågade efter finns inte här!",
        ],
        '403' => [
            'error' => "Du bör inte vara här",
            'description' => 'Du kan däremot försöka gå tillbaka.',
        ],
        '401' => [
            'error' => "Du bör inte vara här",
            'description' => 'Du kan däremot försöka gå tillbaka. Eller kanske logga in.',
        ],
        '405' => [
            'error' => 'Sida saknas',
            'description' => "Förlåt, men sidan du frågade efter finns inte här!",
        ],
        '500' => [
            'error' => 'Oh nej! Något gick isönder! ;_;',
            'description' => "Vi blir automatiskt notifierade av varje fel",
        ],
        'fatal' => [
            'error' => 'Oh nej! Något gick verkligen isönder! ;_;',
            'description' => "Vi blir automatiskt notifierade av varje fel",
        ],
        '503' => [
            'error' => 'Nere för underhåll!',
            'description' => "Underhåll brukar oftast ta från 5 sekunder till 10 minuter. Om vi är nere längre, se :link för mer information.",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Bara ifall att, här är en kod du kan ge till support!",
    ],

    'popup_login' => [
        'login' => [
            'forgot' => "Jag har glömt mina detaljer",
            'password' => 'lösenord',
            'title' => 'Logga In För Att Fortsätta',
            'username' => '',

            'error' => [
                'email' => "Användarnamn eller email adress finns inte",
                'password' => 'Inkorrekt lösenord',
            ],
        ],

        'register' => [
            'download' => '',
            'info' => 'Herrn, du behöver ett konto. Varför har du inte ett redan?',
            'title' => "Har du inte ett konto?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Inställningar',
            'friends' => 'Vänner',
            'logout' => 'Logga Ut',
            'profile' => 'Min Profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Skriv för att söka!',
        'retry' => 'Sökning misslyckades. Klicka för att försöka igen.',
    ],
];
