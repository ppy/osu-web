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
        'page_description' => 'osu! - Rhythm is just a *click* away!  With Ouendan/EBA, Taiko and original gameplay modes, as well as a fully functional level editor.',
    ],

    'menu' => [
        'home' => [
            '_' => 'home',
            'account-edit' => 'settings',
            'friends-index' => 'friends',
            'changelog-index' => 'changelog',
            'changelog-build' => 'build',
            'getDownload' => 'download',
            'getIcons' => 'icons',
            'groups-show' => 'groups',
            'index' => 'dashboard',
            'legal-show' => 'information',
            'messages-index' => 'messages',
            'news-index' => 'news',
            'news-show' => 'news',
            'password-reset-index' => 'reset password',
            'search' => 'search',
            'supportTheGame' => 'support the game',
            'team' => 'team',
        ],
        'help' => [
            '_' => 'help',
            'getFaq' => 'faq',
            'getRules' => 'rules',
            'getSupport' => 'no, really, i need help!',
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
            'index' => 'listing',
            'packs' => 'packs',
            'show' => 'info',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'rankings',
            'index' => 'performance',
            'performance' => 'performance',
            'charts' => 'spotlights',
            'score' => 'score',
            'country' => 'country',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'community',
            'chat' => 'chat',
            'chat-index' => 'chat',
            'dev' => 'development',
            'getForum' => 'forums',
            'getLive' => 'live',
            'comments-index' => 'comments',
            'comments-show' => 'comment',
            'contests' => 'contests',
            'profile' => 'profile',
            'tournaments' => 'tournaments',
            'tournaments-index' => 'tournaments',
            'tournaments-show' => 'tournament info',
            'forum-topic-watches-index' => 'subscriptions',
            'forum-topics-create' => 'forums',
            'forum-topics-show' => 'forums',
            'forum-forums-index' => 'forums',
            'forum-forums-show' => 'forums',
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
            'show' => 'match',
        ],
        'error' => [
            '_' => 'error',
            '404' => 'missing',
            '403' => 'forbidden',
            '401' => 'unauthorized',
            '405' => 'missing',
            '500' => 'something broke',
            '503' => 'maintenance',
        ],
        'user' => [
            '_' => 'user',
            'getLogin' => 'sign in',
            'disabled' => 'disabled',

            'register' => 'register',
            'reset' => 'recover',
            'new' => 'new',

            'messages' => 'Messages',
            'settings' => 'Settings',
            'logout' => 'Sign Out',
            'help' => 'Help',
            'modding-history-discussions' => 'user modding discussions',
            'modding-history-events' => 'user modding events',
            'modding-history-index' => 'user modding history',
            'modding-history-posts' => 'user modding posts',
            'modding-history-votesGiven' => 'user modding votes given',
            'modding-history-votesReceived' => 'user modding votes received',
        ],
        'store' => [
            '_' => 'store',
            'checkout-show' => 'checkout',
            'getListing' => 'listing',
            'cart-show' => 'cart',

            'getCheckout' => 'checkout',
            'getInvoice' => 'invoice',
            'orders-index' => 'order history',
            'products-show' => 'product',

            'new' => 'new',
            'home' => 'home',
            'index' => 'home',
            'thanks' => 'thanks',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'forum covers',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'orders',
            'orders-show' => 'order',
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
        'legal' => [
            '_' => 'Legal & Status',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Privacy',
            'server_status' => 'Server Status',
            'source_code' => 'Source Code',
            'terms' => 'Terms',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Page Missing',
            'description' => "Sorry, but the page you requested isn't here!",
        ],
        '403' => [
            'error' => "You shouldn't be here.",
            'description' => 'You could try going back, though.',
        ],
        '401' => [
            'error' => "You shouldn't be here.",
            'description' => 'You could try going back, though. Or maybe signing in.',
        ],
        '405' => [
            'error' => 'Page Missing',
            'description' => "Sorry, but the page you requested isn't here!",
        ],
        '500' => [
            'error' => 'Oh no! Something broke! ;_;',
            'description' => "We're automatically notified of every error.",
        ],
        'fatal' => [
            'error' => 'Oh no! Something broke (badly)! ;_;',
            'description' => "We're automatically notified of every error.",
        ],
        '503' => [
            'error' => 'Down for maintenance!',
            'description' => "Maintenance usually takes anywhere from 5 seconds to 10 minutes. If we're down for longer, see :link for more information.",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Just in case, here's a code you can give to support!",
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
