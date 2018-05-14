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
        'page_description' => 'osu! - Ritme is slechts een *klik* verwijderd!  Met Ouendan/EBA, Taiko en originele spelmodi, en zelfs een volledig functionele level editor.',
    ],

    'menu' => [
        'home' => [
            '_' => 'start',
            'account-edit' => '',
            'friends-index' => '',
            'changelog-index' => '',
            'changelog-show' => '',
            'getDownload' => 'downloaden',
            'getIcons' => 'iconen',
            'groups-show' => '',
            'index' => '',
            'legal-show' => '',
            'news-index' => '',
            'news-show' => '',
            'password-reset-index' => '',
            'search' => '',
            'supportTheGame' => 'ondersteun het spel',
            'team' => '',
        ],
        'help' => [
            '_' => 'hulp',
            'getFaq' => 'faq',
            'getRules' => '',
            'getSupport' => 'ondersteuning',
            'getWiki' => 'wiki',
            'wiki-show' => '',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => '',
            'beatmap_discussion_posts-index' => '',
            'beatmap_discussions-index' => '',
            'beatmapset-watches-index' => '',
            'beatmapset_discussion_votes-index' => '',
            'beatmapset_events-index' => '',
            'index' => 'index',
            'packs' => '',
            'show' => 'info',
        ],
        'beatmapsets' => [
            '_' => 'beatmapsets',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'rankings',
            'index' => '',
            'performance' => '',
            'charts' => 'grafieken',
            'score' => '',
            'country' => '',
            'kudosu' => '',
        ],
        'community' => [
            '_' => 'community',
            'dev' => '',
            'getForum' => 'forum',
            'getChat' => 'chat',
            'getLive' => 'live',
            'contests' => '',
            'profile' => 'profiel',
            'tournaments' => 'toernooien',
            'tournaments-index' => 'toernooien',
            'tournaments-show' => 'toernooi info',
            'forum-topic-watches-index' => '',
            'forum-topics-create' => 'forum',
            'forum-topics-show' => 'forum',
            'forum-forums-index' => 'forum',
            'forum-forums-show' => 'forum',
        ],
        'multiplayer' => [
            '_' => '',
            'show' => '',
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
            'modding-history-discussions' => '',
            'modding-history-events' => '',
            'modding-history-index' => '',
            'modding-history-posts' => '',
            'modding-history-votesGiven' => '',
            'modding-history-votesReceived' => '',
        ],
        'store' => [
            '_' => 'winkel',
            'checkout-show' => '',
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
            'beatmapsets-covers' => '',
            'logs-index' => 'log',
            'root' => '',

            'beatmapsets' => [
                '_' => 'beatmapsets',
                'show' => 'detail',
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
        'support' => [
            '_' => '',
            'tags' => '',
            'merchandise' => '',
        ],
        'legal' => [
            '_' => '',
            'copyright' => '',
            'server_status' => '',
            'terms' => '',
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
