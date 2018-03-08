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
            'getChangelog' => 'changelog',
            'getDownload' => 'downloaden',
            'getIcons' => 'iconen',
            'getNews' => 'nieuws',
            'supportTheGame' => 'ondersteun het spel',
        ],
        'help' => [
            '_' => 'hulp',
            'getWiki' => 'wiki',
            'getFaq' => 'faq',
            'getSupport' => 'ondersteuning', //obsolete
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'show' => 'info',
            'index' => 'index',
            // 'getPacks' => 'pakketten',
            // 'getCharts' => 'grafieken',
        ],
        'beatmapsets' => [
            '_' => 'beatmapsets',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'rankings',
            'charts' => 'grafieken',
        ],
        'community' => [
            '_' => 'community',
            'getForum' => 'forum', // Base text changed to plural, please check.
            'getChat' => 'chat',
            'getLive' => 'live',
            'profile' => 'profiel',
            'tournaments' => 'toernooien',
            'tournaments-index' => 'toernooien',
            'tournaments-show' => 'toernooi info',
            'forum-topics-create' => 'forum', // Base text changed to plural, please check.
            'forum-topics-show' => 'forum', // Base text changed to plural, please check.
            'forum-forums-index' => 'forum', // Base text changed to plural, please check.
            'forum-forums-show' => 'forum', // Base text changed to plural, please check.
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
            'logout' => 'Uitloggen', // Base text changed from "Log Out" to "Sign Out", please check.
            'help' => 'Help',
        ],
        'store' => [
            '_' => 'winkel',
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
            'logs-index' => 'log',
            'beatmapsets' => [
                '_' => 'beatmapsets',
                'covers' => 'covers',
                'show' => 'detail',
            ],
        ],
    ],
    'errors' => [
        '404' => [
            'error' => 'Pagina Mist',
            'description' => 'Sorry, de pagina die je hebt opgevraagd is er niet!',
            'link' => false,
        ],
        '403' => [
            'error' => 'Jij hoort hier niet te zijn.',
            'description' => 'Je zou kunnen proberen terug te gaan.',
            'link' => false,
        ],
        '401' => [
            'error' => 'Jij hoort hier niet.',
            'description' => 'Je zou kunnen proberen terug te gaan. Of misschien zou je kunnen inloggen.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Pagina Mist',
            'description' => 'Sorry, de pagina die je hebt opgevraagd is er niet!',
            'link' => false,
        ],
        '500' => [
            'error' => 'Oh nee! Iets brak! ;_;',
            'description' => 'We worden automatisch op de hoogte gesteld van alle fouten.',
            'link' => false,
        ],
        'fatal' => [
            'error' => 'Oh nee! Iets brak (heel erg)! ;_;',
            'description' => 'We worden automatisch op de hoogte gesteld van alle fouten.',
            'link' => false,
        ],
        '503' => [
            'error' => 'Offline voor onderhoud!',
            'description' => 'Onderhoud duurt meestal ongeveer 5 seconden tot 10 minuten. Als we langer offline zijn, check :link voor meer informatie.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => 'Voor de zekerheid is hier een code die je aan het ondersteuningsteam kan geven!',
    ],
];
