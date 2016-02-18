<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
        'page_description' => 'osu! - Rhythm is just a *click* away!  With Ouendan/EBA, Taiko and original gameplay modes, as well as a fully functional level editor.',
    ],

    'menu' => [
        'home' => [
            '_' => 'home',
            'getNews' => 'news',
            'getChangelog' => 'changelog',
            'getDownload' => 'download',
            'getIcons' => 'icons',
            'supportTheGame' => 'support the game',
        ],
        'help' => [
            '_' => 'help',
            'getWiki' => 'wiki',
            'getFaq' => 'faq',
            'getSupport' => 'support',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'getListing' => 'listing',
            'getPacks' => 'packs',
            'getCharts' => 'charts',
            'getModding' => 'modding',
            'moddingreact' => 'modding',
            'index' => 'listing',
        ],
        'ranking' => [
            '_' => 'ranking',
            'getOverall' => 'overall',
            'getCountry' => 'country',
            'getCharts' => 'charts',
            'getMapper' => 'mapper',
            'index' => 'overall',
        ],
        'community' => [
            '_' => 'community',
            'getForum' => 'forum',
            'getChat' => 'chat',
            'getSupport' => 'support',
            'getLive' => 'live',
            'profile' => 'profile',
            'tournaments' => 'tournaments',
            'tournaments-index' => 'tournaments',
            'tournaments-show' => 'tournament info',
            'forum-topics-create' => 'forum',
            'forum-topics-show' => 'forum',
            'forum-forums-index' => 'forum',
            'forum-forums-show' => 'forum',
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
            'getLogin' => 'login',
            'disabled' => 'disabled',

            'register' => 'register',
            'reset' => 'recover',
            'new' => 'new',

            'messages' => 'Messages',
            'settings' => 'Settings',
            'logout' => 'Log Out',
            'help' => 'Help',
        ],
        'store' => [
            '_' => 'store',
            'getListing' => 'listing',
            'getCart' => 'cart',

            'getCheckout' => 'checkout',
            'getInvoice' => 'invoice',
            'getProduct' => 'product',

            'new' => 'new',
            'home' => 'home',
            'index' => 'home',
            'thanks' => 'thanks',
        ],
        'storeAdmin' => [
            '_' => 'store',
            'index' => 'admin',
        ],
    ],
    'errors' => [
        '404' => [
            'error' => 'Page Missing',
            'description' => "Sorry, but the page you requested isn't here!",
            'link' => false,
        ],
        '403' => [
            'error' => "You shouldn't be here.",
            'description' => 'You could try going back, though.',
            'link' => false,
        ],
        '401' => [
            'error' => "You shouldn't be here.",
            'description' => 'You could try going back, though. Or maybe logging in.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Page Missing',
            'description' => "Sorry, but the page you requested isn't here!",
            'link' => false,
        ],
        '500' => [
            'error' => 'Oh no! Something broke! ;_;',
            'description' => "We're automatically notified of every error.",
            'link' => false,
        ],
        'fatal' => [
            'error' => 'Oh no! Something broke (badly)! ;_;',
            'description' => "We're automatically notified of every error.",
            'link' => false,
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
];
