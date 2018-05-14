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
        'page_description' => 'osu! - Ritme is slechts een *klik* verwijderd!  Met Ouendan/EBA, Taiko en originele spelmodi, en zelfs een volledig functionele level editor.',
    ],

    'menu' => [
        'home' => [
            '_' => 'start',
            'account-edit' => 'settings',
            'friends-index' => 'friends',
            'changelog-index' => 'changelog',
            'changelog-show' => 'build',
            'getDownload' => 'downloaden',
            'getIcons' => 'iconen',
            'groups-show' => 'groups',
            'index' => 'dashboard',
            'legal-show' => 'information',
            'news-index' => 'news',
            'news-show' => 'news',
            'password-reset-index' => 'reset password',
            'search' => 'search',
            'supportTheGame' => 'ondersteun het spel',
            'team' => 'team',
        ],
        'help' => [
            '_' => 'hulp',
            'getFaq' => 'faq',
            'getRules' => 'rules',
            'getSupport' => 'ondersteuning',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'featured artists',
            'beatmap_discussion_posts-index' => 'beatmap discussion posts',
            'beatmap_discussions-index' => 'beatmap discussions',
            'beatmapset-watches-index' => 'modding watchlist',
            'beatmapset_discussion_votes-index' => 'beatmap discussion votes',
            'beatmapset_events-index' => 'beatmapset events',
            'index' => 'index',
            'packs' => 'packs',
            'show' => 'info',
        ],
        'beatmapsets' => [
            '_' => 'beatmapsets',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'rankings',
            'index' => 'performance',
            'performance' => 'performance',
            'charts' => 'grafieken',
            'score' => 'score',
            'country' => 'country',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'community',
            'dev' => 'osu!dev',
            'getForum' => 'forum',
            'getChat' => 'chat',
            'getLive' => 'live',
            'contests' => 'contests',
            'profile' => 'profiel',
            'tournaments' => 'toernooien',
            'tournaments-index' => 'toernooien',
            'tournaments-show' => 'toernooi info',
            'forum-topic-watches-index' => 'subscriptions',
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
            '_' => 'fout',
            '404' => 'ontbreekt',
            '403' => 'verboden',
            '401' => 'onbevoegd',
            '405' => 'ontbreekt',
            '500' => 'iets brak',
            '503' => 'onderhoud',
        ],
        'user' => [
            '_' => 'gebruiker',
            'getLogin' => 'inloggen',
            'disabled' => 'inactief',

            'register' => 'registreren',
            'reset' => 'herstellen',
            'new' => 'nieuw',

            'messages' => 'Berichten',
            'settings' => 'Instellingen',
            'logout' => 'Uitloggen',
            'help' => 'Help',
            'modding-history-discussions' => 'user modding discussions',
            'modding-history-events' => 'user modding events',
            'modding-history-index' => 'user modding history',
            'modding-history-posts' => 'user modding posts',
            'modding-history-votesGiven' => 'user modding votes given',
            'modding-history-votesReceived' => 'user modding votes received',
        ],
        'store' => [
            '_' => 'winkel',
            'checkout-show' => 'checkout',
            'getListing' => 'index',
            'cart-show' => 'winkelwagen',

            'getCheckout' => 'afrekenen',
            'getInvoice' => 'factuur',
            'products-show' => 'artikel',

            'new' => 'nieuw',
            'home' => 'start',
            'index' => 'start',
            'thanks' => 'bedankt',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'forum covers',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'bestellingen',
            'orders-show' => 'bestelling',
        ],
        'admin' => [
            '_' => 'admin',
            'beatmapsets-covers' => 'beatmapset covers',
            'logs-index' => 'log',
            'root' => 'index',

            'beatmapsets' => [
                '_' => 'beatmapsets',
                'show' => 'detail',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'General',
            'home' => 'Home',
            'changelog-index' => 'Changelog',
            'beatmaps' => 'Beatmap Listing',
            'download' => 'Download osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Help & Community',
            'faq' => 'Frequently Asked Questions',
            'forum' => 'Community Forums',
            'livestreams' => 'Live Streams',
            'report' => 'Report an Issue',
        ],
        'support' => [
            '_' => 'Support osu!',
            'tags' => 'Supporter Tags',
            'merchandise' => 'Merchandise',
        ],
        'legal' => [
            '_' => 'Legal & Status',
            'copyright' => 'Copyright (DMCA)',
            'server_status' => 'Server Status',
            'terms' => 'Terms of Service',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Pagina Mist',
            'description' => "Sorry, de pagina die je hebt opgevraagd is er niet!",
        ],
        '403' => [
            'error' => "Jij hoort hier niet te zijn.",
            'description' => 'Je zou kunnen proberen terug te gaan.',
        ],
        '401' => [
            'error' => "Jij hoort hier niet.",
            'description' => 'Je zou kunnen proberen terug te gaan. Of misschien zou je kunnen inloggen.',
        ],
        '405' => [
            'error' => 'Pagina Mist',
            'description' => "Sorry, de pagina die je hebt opgevraagd is er niet!",
        ],
        '500' => [
            'error' => 'Oh nee! Iets brak! ;_;',
            'description' => "We worden automatisch op de hoogte gesteld van alle fouten.",
        ],
        'fatal' => [
            'error' => 'Oh nee! Iets brak (heel erg)! ;_;',
            'description' => "We worden automatisch op de hoogte gesteld van alle fouten.",
        ],
        '503' => [
            'error' => 'Offline voor onderhoud!',
            'description' => "Onderhoud duurt meestal ongeveer 5 seconden tot 10 minuten. Als we langer offline zijn, check :link voor meer informatie.",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Voor de zekerheid is hier een code die je aan het ondersteuningsteam kan geven!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'email address',
            'forgot' => "I've forgotten my details",
            'password' => 'password',
            'title' => 'Sign In To Proceed',

            'error' => [
                'email' => "Username or email address doesn't exist",
                'password' => 'Incorrect password',
            ],
        ],

        'register' => [
            'info' => "You need an account, sir. Why don't you have one already?",
            'title' => "Don't have an account?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Settings',
            'friends' => 'Friends',
            'logout' => 'Sign Out',
            'profile' => 'My Profile',
        ],
    ],

    'popup_search' => [
        'initial' => 'Type to search!',
        'retry' => 'Search failed. Click to retry.',
    ],
];
