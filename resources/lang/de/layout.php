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
        'page_description' => 'osu! - Der Rhythmus ist nur einen *Klick* entfernt!  Mit Ouendan/EBA, Taiko und eigenen Spielmodi, zusätzlich zu einem voll funktionalen Leveleditor',
    ],

    'menu' => [
        'home' => [
            '_' => 'home',
            'account-edit' => 'einstellungen',
            'friends-index' => 'freunde',
            'changelog-index' => 'changelog',
            'changelog-build' => 'version',
            'getDownload' => 'download',
            'getIcons' => 'icons',
            'groups-show' => 'gruppen',
            'index' => 'dashboard',
            'legal-show' => 'informationen',
            'news-index' => 'news',
            'news-show' => 'news',
            'password-reset-index' => 'passwort zurücksetzen',
            'search' => 'suche',
            'supportTheGame' => 'Das Spiel unterstützen',
            'team' => 'team',
        ],
        'help' => [
            '_' => 'hilfe',
            'getFaq' => 'faq',
            'getRules' => 'regeln',
            'getSupport' => 'ich brauche wirklich hilfe!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'featured artists',
            'beatmap_discussion_posts-index' => 'beatmapdiskussion: posts',
            'beatmap_discussions-index' => 'beatmapdiskussion',
            'beatmapset-watches-index' => 'modding watchlist',
            'beatmapset_discussion_votes-index' => 'beatmapdiskussion: abstimmungen',
            'beatmapset_events-index' => 'beatmapset-events',
            'index' => 'auflistung',
            'packs' => 'pakete',
            'show' => 'info',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'ranglisten',
            'index' => 'performance',
            'performance' => 'performance',
            'charts' => 'charts',
            'score' => 'punkte',
            'country' => 'länder',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'community',
            'dev' => 'entwicklung',
            'getForum' => 'foren',
            'getChat' => 'chat',
            'getLive' => 'live',
            'contests' => 'wettbewerbe',
            'profile' => 'profil',
            'tournaments' => 'turniere',
            'tournaments-index' => 'turniere',
            'tournaments-show' => 'turnier-info',
            'forum-topic-watches-index' => 'abonnements',
            'forum-topics-create' => 'forum',
            'forum-topics-show' => 'forum',
            'forum-forums-index' => 'forum',
            'forum-forums-show' => 'forum',
        ],
        'multiplayer' => [
            '_' => 'mehrspieler',
            'show' => 'match',
        ],
        'error' => [
            '_' => 'error',
            '404' => 'nicht gefunden',
            '403' => 'fehlende berechtigung',
            '401' => 'nicht authorisiert',
            '405' => 'nicht gefunden',
            '500' => 'unerwarteter fehler',
            '503' => 'wartung',
        ],
        'user' => [
            '_' => 'benutzer',
            'getLogin' => 'login',
            'disabled' => 'deaktiviert',

            'register' => 'registrieren',
            'reset' => 'retten',
            'new' => 'neu',

            'messages' => 'Nachrichten',
            'settings' => 'Einstellungen',
            'logout' => 'Ausloggen',
            'help' => 'Hilfe',
            'modding-history-discussions' => 'nutzer-moddingdiskussionen',
            'modding-history-events' => 'nutzer-modding-events',
            'modding-history-index' => 'nutzer-moddingverlauf',
            'modding-history-posts' => 'nutzer-modding-posts',
            'modding-history-votesGiven' => 'vergebene modding-votes',
            'modding-history-votesReceived' => 'erhaltene modding-votes',
        ],
        'store' => [
            '_' => 'shop',
            'checkout-show' => 'kasse',
            'getListing' => 'produkte',
            'cart-show' => 'warenkorb',

            'getCheckout' => 'kasse',
            'getInvoice' => 'rechnung',
            'products-show' => 'produkt',

            'new' => 'neu',
            'home' => 'home',
            'index' => 'home',
            'thanks' => 'danke',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'forenbanner',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'bestellungen',
            'orders-show' => 'bestellung',
        ],
        'admin' => [
            '_' => 'admin',
            'beatmapsets-covers' => 'beatmapset-banner',
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
            '_' => 'Allgemein',
            'home' => 'Home',
            'changelog-index' => 'Changelog',
            'beatmaps' => 'Beatmap-Auflistung',
            'download' => 'osu! herunterladen',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Hilfe & Community',
            'faq' => '\'Frequently Asked Questions\'',
            'forum' => 'Community-Foren',
            'livestreams' => 'Livestreams',
            'report' => 'Einen Fehler melden',
        ],
        'legal' => [
            '_' => 'Rechtliches & Status',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Privatsphäre',
            'server_status' => 'Serverstatus',
            'source_code' => 'Quellcode',
            'terms' => 'Nutzungsbedingungen',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Seite fehlt',
            'description' => "Sorry, aber die angeforderte Seite existiert nicht!",
        ],
        '403' => [
            'error' => "Du solltest nicht hier sein.",
            'description' => 'Du könntest versuchen, zurückzugehen.',
        ],
        '401' => [
            'error' => "Du solltest nicht hier sein.",
            'description' => 'Du könntest versuchen, zurückzugehen. Oder dich einloggen.',
        ],
        '405' => [
            'error' => 'Seite fehlt',
            'description' => "Sorry, aber die angeforderte Seite existiert nicht!",
        ],
        '500' => [
            'error' => 'Oh nein! Irgendwas ist schief gelaufen! ;_;',
            'description' => "Wir werden automatisch über jeden Fehler benachrichtigt.",
        ],
        'fatal' => [
            'error' => 'Oh nein! Irgendwas ist extrem schief gelaufen! ;_;',
            'description' => "Wir werden automatisch über jeden Fehler benachrichtigt.",
        ],
        '503' => [
            'error' => 'Wegen Wartung nicht erreichbar!',
            'description' => "Wartungen können von 5 Sekunden bis zu 10 Minuten dauern. Sollten wir länger nicht erreichbar sein, schau bei :link für mehr Informationen.",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Nur zur Sicherheit ist hier noch ein Code, den du dem Support geben kannst!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'e-mail-adresse',
            'forgot' => "Passwort vergessen",
            'password' => 'passwort',
            'title' => 'Zum Fortfahren einloggen',

            'error' => [
                'email' => "Nutzername oder E-Mail-Adresse existiert nicht",
                'password' => 'Falsches Passwort',
            ],
        ],

        'register' => [
            'info' => "Sie brauchen einen Account, Sir. Warum besitzen Sie noch keinen?",
            'title' => "Kein Account?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Einstellungen',
            'friends' => 'Freunde',
            'logout' => 'Ausloggen',
            'profile' => 'Mein Profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Zum Suchen Text eingeben!',
        'retry' => 'Suche fehlgeschlagen. Klicke, um es erneut zu versuchen.',
    ],
];
