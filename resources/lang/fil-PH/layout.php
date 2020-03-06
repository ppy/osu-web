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
        'page_description' => 'osu! - Ang ritmo ay isang *click* nalang! Merong Oudendan/EBA, Taiko at orihinal na mga gameplay mode, at isang maayos na level editor.',
    ],

    'header' => [
        'admin' => [
            '_' => 'admin',
            'beatmapset' => '',
            'beatmapset_covers' => '',
            'contest' => 'paligsahan',
            'contests' => 'mga paligsahan',
            'root' => 'console',
            'store_orders' => '',
        ],

        'artists' => [
            '_' => 'mga itinatampok na artista',
            'index' => 'listahan',
        ],

        'beatmapsets' => [
            '_' => 'beatmap',
            'discussions' => 'talakayan',
            'index' => 'listahan',
            'show' => 'info',
            'packs' => 'mga pack',
        ],

        'changelog' => [
            '_' => 'listahan ng pagbabago',
            'index' => 'listahan',
        ],

        'community' => [
            '_' => '',
            'comments' => 'mga komento',
            'contests' => '',
            'forum' => '',
            'livestream' => 'mga live stream',
        ],

        'error' => [
            '_' => 'error',
        ],

        'help' => [
            '_' => 'wiki',
            'index' => 'indeks',
        ],

        'home' => [
            '_' => 'home',
            'password_reset' => 'i-reset ang password',
        ],

        'matches' => [
            '_' => '',
        ],

        'notice' => [
            '_' => 'abiso',
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
            '_' => 'mga pagligsahan',
            'index' => 'listahan',
        ],

        'users' => [
            '_' => 'manlalaro',
            'forum_posts' => 'mga forum posts',
            'modding' => 'modding',
            'show' => 'info',
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
            '_' => 'home',
            'account-edit' => 'mga setting',
            'account-verifyLink' => '',
            'beatmapset-watches-index' => 'mga pinapanood na mods',
            'changelog-build' => 'build',
            'changelog-index' => 'listahan ng pagbabago',
            'client_verifications-create' => '',
            'forum-topic-watches-index' => 'mga suskripsyon sa forum',
            'friends-index' => 'mga kaibigan',
            'getDownload' => 'download',
            'getIcons' => 'mga icon',
            'groups-show' => 'mga grupo',
            'index' => 'dashboard',
            'legal-show' => 'impormasyon',
            'messages-index' => '',
            'news-index' => 'balita',
            'news-show' => 'balita',
            'password-reset-index' => 'i-reset ang password',
            'search' => 'hanapin',
            'supportTheGame' => 'suportahan ang laro',
            'team' => 'koponan',
            'testflight' => 'testflight',
        ],
        'profile' => [
            '_' => '',
            'friends' => '',
            'settings' => '',
        ],
        'help' => [
            '_' => 'tulong',
            'getFaq' => 'faq',
            'getRules' => 'mga patakaran',
            'getSupport' => 'hindi, kailangan ko talaga ng tulong!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'mga beatmap',
            'artists' => 'mga itinatampok na artista',
            'beatmap_discussion_posts-index' => '',
            'beatmap_discussions-index' => '',
            'beatmapset_discussion_votes-index' => '',
            'beatmapset_events-index' => '',
            'index' => 'listahan',
            'packs' => '',
            'show' => 'info',
        ],
        'beatmapsets' => [
            '_' => 'mga beatmap',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'kataasan',
            'index' => '',
            'performance' => '',
            'charts' => 'mga spotlight',
            'score' => 'iskor',
            'country' => 'bansa',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'komunidad',
            'chat' => '',
            'chat-index' => '',
            'dev' => 'development',
            'getForum' => 'mga forum',
            'getLive' => 'live',
            'comments-index' => '',
            'comments-show' => '',
            'contests' => 'mga paligsahan',
            'profile' => 'profile',
            'tournaments' => 'mga torneo',
            'tournaments-index' => '',
            'tournaments-show' => '',
            'forum-topics-create' => 'mga forum',
            'forum-topics-show' => 'mga forum',
            'forum-forums-index' => 'mga forum',
            'forum-forums-show' => 'mga forum',
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
            'show' => 'laban',
        ],
        'error' => [
            '_' => 'error',
            '404' => 'nawawala',
            '403' => 'bawal',
            '401' => 'hindi awtorisado',
            '405' => 'nawawala',
            '500' => 'may nasira',
            '503' => 'pagpapanatili',
        ],
        'user' => [
            '_' => 'user',
            'getLogin' => 'mag-sign in',
            'disabled' => '',

            'register' => 'magrehistro',
            'reset' => 'bawiin',
            'new' => '',

            'help' => 'Tulong',
            'logout' => 'Mag-sign Out',
            'messages' => 'Mga Mensahe',
            'modding-history-discussions' => '',
            'modding-history-events' => '',
            'modding-history-index' => '',
            'modding-history-posts' => '',
            'modding-history-votesGiven' => '',
            'modding-history-votesReceived' => '',
            'notifications-index' => '',
            'oauth_login' => '',
            'oauth_request' => '',
            'settings' => 'Mga Setting',
        ],
        'store' => [
            '_' => 'tindahan',
            'checkout-show' => 'checkout',
            'getListing' => 'listahan',
            'cart-show' => 'karetela',

            'getCheckout' => 'checkout',
            'getInvoice' => 'invoice',
            'orders-index' => '',
            'products-show' => 'produkto',

            'new' => '',
            'home' => 'home',
            'index' => 'home',
            'thanks' => 'salamat',
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
            '_' => 'General',
            'home' => 'Home',
            'changelog-index' => 'Listahan ng Pagbabago',
            'beatmaps' => 'Listahan ng mga Beatmap',
            'download' => 'I-download ang osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Tulong & Komunidad',
            'faq' => 'Mga Madalas na Tinatanong',
            'forum' => 'Mga Forum ng Komunidad',
            'livestreams' => 'Live Streams',
            'report' => 'Mag-ulat ng Isyu',
        ],
        'legal' => [
            '_' => 'Legal & Status',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Palihim',
            'server_status' => 'Katayuan ng server',
            'source_code' => 'Source Code',
            'terms' => 'Terms',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Nawawala ang Pahina',
            'description' => "Sori, pero wala dito ang hinihiling mong pahina!",
        ],
        '403' => [
            'error' => "Hindi ka dapat dito.",
            'description' => 'Pero maaari kang bumalik.',
        ],
        '401' => [
            'error' => "Hindi ka dapat dito.",
            'description' => 'Pero maaari kang bumalik. O pwedeng mag-sign in.',
        ],
        '405' => [
            'error' => 'Nawawala ang Pahina',
            'description' => "Sori, pero wala dito ang hinihiling mong pahina!",
        ],
        '500' => [
            'error' => 'Naku! May nasira! ;_;',
            'description' => "",
        ],
        'fatal' => [
            'error' => 'Naku! May (talagang) nasira! ;_;',
            'description' => "",
        ],
        '503' => [
            'error' => 'May inaayos!',
            'description' => "Ang pagpapanatili ay karaniwang tumatagal mula sa 5 segundo hanggang sa 10 minuto. Kung mas matagal pa, tingnan :link para sa mga karagdagang impormasyon.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Kung sakali, dito ay isang code na mabibigay mo sa support!",
    ],

    'popup_login' => [
        'login' => [
            'forgot' => "Nalimutan ko ang aking mga detalye",
            'password' => 'password',
            'title' => 'Mag-sign In Upang Tumuloy',
            'username' => '',

            'error' => [
                'email' => "Hindi umiiral ang username o email address",
                'password' => 'Maling password',
            ],
        ],

        'register' => [
            'download' => '',
            'info' => 'Kailangan mo ng account, sir. Bakit wala ka pa?',
            'title' => "Walang account?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Mga Setting',
            'friends' => 'Mga Kaibigan',
            'logout' => 'Mag-sign Out',
            'profile' => 'Aking Profile',
        ],
    ],

    'popup_search' => [
        'initial' => 'Mag-type para maghanap!',
        'retry' => 'Nabigo ang paghahanap. I-click upang subukan muli.',
    ],
];
