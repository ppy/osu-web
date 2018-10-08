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
            'account-edit' => 'instellingen',
            'friends-index' => 'vrienden',
            'changelog-index' => 'changelog',
            'changelog-build' => 'versie',
            'getDownload' => 'downloaden',
            'getIcons' => 'iconen',
            'groups-show' => 'groepen',
            'index' => 'dashboard',
            'legal-show' => 'informatie',
            'news-index' => 'nieuws',
            'news-show' => 'nieuws',
            'password-reset-index' => 'wachtwoord resetten',
            'search' => 'zoeken',
            'supportTheGame' => 'ondersteun het spel',
            'team' => 'team',
        ],
        'help' => [
            '_' => 'hulp',
            'getFaq' => 'faq',
            'getRules' => 'regels',
            'getSupport' => 'ondersteuning',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'featured artists',
            'beatmap_discussion_posts-index' => 'beatmap discussie berichten',
            'beatmap_discussions-index' => 'beatmap discussies',
            'beatmapset-watches-index' => 'modding volglijst',
            'beatmapset_discussion_votes-index' => 'beatmap discussie stemmen',
            'beatmapset_events-index' => 'beatmapset evenementen',
            'index' => 'index',
            'packs' => 'pakketten',
            'show' => 'info',
        ],
        'beatmapsets' => [
            '_' => 'beatmapsets',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'rankings',
            'index' => 'prestaties',
            'performance' => 'prestatie',
            'charts' => 'grafieken',
            'score' => 'score',
            'country' => 'land',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'community',
            'dev' => 'ontwikkeling',
            'getForum' => 'forum',
            'getChat' => 'chat',
            'getLive' => 'live',
            'contests' => 'wedstrijden',
            'profile' => 'profiel',
            'tournaments' => 'toernooien',
            'tournaments-index' => 'toernooien',
            'tournaments-show' => 'toernooi info',
            'forum-topic-watches-index' => 'abonnementen',
            'forum-topics-create' => 'forum',
            'forum-topics-show' => 'forum',
            'forum-forums-index' => 'forum',
            'forum-forums-show' => 'forum',
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
            'show' => 'spel',
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
            'modding-history-discussions' => 'gebruiker mod discussie',
            'modding-history-events' => 'gebruiker mod evenementen',
            'modding-history-index' => 'gebruiker mod geschiedenis',
            'modding-history-posts' => 'gebruiker mod post',
            'modding-history-votesGiven' => 'gebruiker mod stemmen gegeven',
            'modding-history-votesReceived' => 'gebruiker mod stemmen ontvangen',
        ],
        'store' => [
            '_' => 'winkel',
            'checkout-show' => 'afrekenen',
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
            '_' => 'Algemeen',
            'home' => 'Startpagina',
            'changelog-index' => 'Changelog',
            'beatmaps' => 'Beatmap Lijst',
            'download' => 'Download osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Help & Community',
            'faq' => 'Veelgestelde Vragen',
            'forum' => 'Community Forums',
            'livestreams' => 'Livestreams',
            'report' => 'Een Probleem Melden',
        ],
        'legal' => [
            '_' => 'Juridisch & Status',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Privacy',
            'server_status' => 'Server Status',
            'source_code' => 'Broncode',
            'terms' => 'Gebruikersvoorwaarden',
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
            'email' => 'emailadres',
            'forgot' => "Ik ben mij gegevens vergeten",
            'password' => 'wachtwoord',
            'title' => 'Log In Om Verder Te Gaan',

            'error' => [
                'email' => "Gebruikersnaam of emailadres bestaat niet",
                'password' => 'Incorrect wachtwoord',
            ],
        ],

        'register' => [
            'info' => "Je hebt een account nodig, meneer. Waarom heeft u er niet al eentje?",
            'title' => "Heb je geen account?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Instellingen',
            'friends' => 'Vrienden',
            'logout' => 'Log Uit',
            'profile' => 'Mijn Profiel',
        ],
    ],

    'popup_search' => [
        'initial' => 'Type om te zoeken!',
        'retry' => 'Zoekopdracht mislukt. Klik om opnieuw te proberen.',
    ],
];
