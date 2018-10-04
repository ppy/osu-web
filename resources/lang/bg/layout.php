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
        'page_description' => '',
    ],

    'menu' => [
        'home' => [
            '_' => '',
            'account-edit' => '',
            'friends-index' => '',
            'changelog-index' => '',
            'changelog-build' => '',
            'getDownload' => '',
            'getIcons' => '',
            'groups-show' => '',
            'index' => '',
            'legal-show' => '',
            'news-index' => '',
            'news-show' => '',
            'password-reset-index' => '',
            'search' => '',
            'supportTheGame' => '',
            'team' => '',
        ],
        'help' => [
            '_' => '',
            'getFaq' => '',
            'getRules' => '',
            'getSupport' => '',
            'getWiki' => '',
            'wiki-show' => '',
        ],
        'beatmaps' => [
            '_' => '',
            'artists' => '',
            'beatmap_discussion_posts-index' => '',
            'beatmap_discussions-index' => '',
            'beatmapset-watches-index' => '',
            'beatmapset_discussion_votes-index' => '',
            'beatmapset_events-index' => '',
            'index' => '',
            'packs' => '',
            'show' => '',
        ],
        'beatmapsets' => [
            '_' => '',
            'discussion' => '',
        ],
        'rankings' => [
            '_' => '',
            'index' => '',
            'performance' => '',
            'charts' => '',
            'score' => '',
            'country' => '',
            'kudosu' => '',
        ],
        'community' => [
            '_' => '',
            'dev' => '',
            'getForum' => '',
            'getChat' => '',
            'getLive' => '',
            'contests' => '',
            'profile' => '',
            'tournaments' => '',
            'tournaments-index' => '',
            'tournaments-show' => '',
            'forum-topic-watches-index' => '',
            'forum-topics-create' => '',
            'forum-topics-show' => '',
            'forum-forums-index' => '',
            'forum-forums-show' => '',
        ],
        'multiplayer' => [
            '_' => '',
            'show' => '',
        ],
        'error' => [
            '_' => '',
            '404' => '',
            '403' => '',
            '401' => '',
            '405' => '',
            '500' => '',
            '503' => '',
        ],
        'user' => [
            '_' => '',
            'getLogin' => '',
            'disabled' => '',

            'register' => '',
            'reset' => '',
            'new' => '',

            'messages' => '',
            'settings' => '',
            'logout' => '',
            'help' => '',
            'modding-history-discussions' => '',
            'modding-history-events' => '',
            'modding-history-index' => '',
            'modding-history-posts' => '',
            'modding-history-votesGiven' => '',
            'modding-history-votesReceived' => '',
        ],
        'store' => [
            '_' => '',
            'checkout-show' => '',
            'getListing' => '',
            'cart-show' => '',

            'getCheckout' => '',
            'getInvoice' => '',
            'products-show' => '',

            'new' => '',
            'home' => '',
            'index' => '',
            'thanks' => '',
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
            '_' => '',
            'home' => '',
            'changelog-index' => '',
            'beatmaps' => '',
            'download' => '',
            'wiki' => '',
        ],
        'help' => [
            '_' => '',
            'faq' => '',
            'forum' => '',
            'livestreams' => '',
            'report' => '',
        ],
        'legal' => [
            '_' => '',
            'copyright' => '',
            'privacy' => '',
            'server_status' => '',
            'source_code' => '',
            'terms' => '',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => '',
            'description' => "",
        ],
        '403' => [
            'error' => "",
            'description' => '',
        ],
        '401' => [
            'error' => "",
            'description' => '',
        ],
        '405' => [
            'error' => '',
            'description' => "",
        ],
        '500' => [
            'error' => '',
            'description' => "",
        ],
        'fatal' => [
            'error' => '',
            'description' => "",
        ],
        '503' => [
            'error' => '',
            'description' => "",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "",
    ],

    'popup_login' => [
        'login' => [
            'email' => '',
            'forgot' => "",
            'password' => '',
            'title' => '',

            'error' => [
                'email' => "",
                'password' => '',
            ],
        ],

        'register' => [
            'info' => "",
            'title' => "",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '',
            'friends' => '',
            'logout' => '',
            'profile' => '',
        ],
    ],

    'popup_search' => [
        'initial' => '',
        'retry' => '',
    ],
];
