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
        'page_description' => 'osu! - Ritmul este doar la un *clic* distanță! Cu Ouendan/EBA, Taiko și moduri de joc originale,  precum și un editor de nivel complet funcțional.',
    ],

    'menu' => [
        'home' => [
            '_' => 'acasă',
            'account-edit' => 'setări',
            'friends-index' => 'prieteni',
            'changelog-index' => 'jurnalul modificărilor',
            'changelog-build' => 'versiune',
            'getDownload' => 'descarcă',
            'getIcons' => 'pictograme',
            'groups-show' => 'grupuri',
            'index' => 'tablou de bord',
            'legal-show' => 'informație',
            'messages-index' => 'mesaje',
            'news-index' => 'noutăți',
            'news-show' => 'noutăți',
            'password-reset-index' => 'resetare parolă',
            'search' => 'căutare',
            'supportTheGame' => 'sprijină jocul',
            'team' => 'echipă',
        ],
        'help' => [
            '_' => 'ajutor',
            'getFaq' => 'întrebări frecvente',
            'getRules' => 'reguli',
            'getSupport' => 'nu, de fapt, am nevoie de ajutor!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'featured artists',
            'beatmap_discussion_posts-index' => 'postări de la discuția beatmap',
            'beatmap_discussions-index' => 'discuții beatmap',
            'beatmapset-watches-index' => 'lista de urmărire a modificărilor',
            'beatmapset_discussion_votes-index' => 'voturi de la discuția beatmap',
            'beatmapset_events-index' => 'evenimente beatmapset',
            'index' => 'listare',
            'packs' => 'pachete',
            'show' => 'info',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'clasamente',
            'index' => 'performanță',
            'performance' => 'performanță',
            'charts' => 'în lumina reflectoarelor',
            'score' => 'scor',
            'country' => 'țară',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'comunitate',
            'chat' => 'chat',
            'chat-index' => 'chat',
            'dev' => 'dezvoltare',
            'getForum' => 'forumuri',
            'getLive' => 'în direct',
            'comments-index' => 'comentarii',
            'comments-show' => 'comentariu',
            'contests' => 'concursuri',
            'profile' => 'profil',
            'tournaments' => 'turnee',
            'tournaments-index' => 'turnee',
            'tournaments-show' => 'informații turneu',
            'forum-topic-watches-index' => 'abonamente',
            'forum-topics-create' => 'forumuri',
            'forum-topics-show' => 'forumuri',
            'forum-forums-index' => 'forumuri',
            'forum-forums-show' => 'forumuri',
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
            'show' => 'meci',
        ],
        'error' => [
            '_' => 'eroare',
            '404' => 'lipsește',
            '403' => 'interzis',
            '401' => 'neautorizat',
            '405' => 'lipsește',
            '500' => 'ceva s-a rupt',
            '503' => 'pauză tehnică',
        ],
        'user' => [
            '_' => 'utilizator',
            'getLogin' => 'conectează-te',
            'disabled' => 'dezactivat',

            'register' => 'înregistrează-te',
            'reset' => 'recuperează',
            'new' => 'nou',

            'help' => 'Ajutor',
            'logout' => 'Deconectare',
            'messages' => 'Mesaje',
            'modding-history-discussions' => 'discuțiile modificate ale utilizatorului',
            'modding-history-events' => 'evenimentele modificate ale utilizatorului',
            'modding-history-index' => 'isoricul modificărilor utilizatorului',
            'modding-history-posts' => 'postările modificate ale utilizatorului',
            'modding-history-votesGiven' => 'voturile modificate date ale utilizatorului',
            'modding-history-votesReceived' => 'voturile modificate primite ale utilizatorului',
            'oauth_login' => '',
            'oauth_request' => '',
            'settings' => 'Setări',
        ],
        'store' => [
            '_' => 'magazin',
            'checkout-show' => 'finalizare comandă',
            'getListing' => 'listare',
            'cart-show' => 'coș',

            'getCheckout' => 'finalizare comandă',
            'getInvoice' => 'factura',
            'orders-index' => 'istoric comenzi',
            'products-show' => 'produs',

            'new' => 'nou',
            'home' => 'acasă',
            'index' => 'acasă',
            'thanks' => 'mulțumesc',
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
            'home' => 'Acasă',
            'changelog-index' => 'Jurnalul modificărilor',
            'beatmaps' => 'Lista de beatmap',
            'download' => 'Descarcă osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Ajutor & Comunitate',
            'faq' => 'Întrebări fregvente',
            'forum' => 'Forumuri',
            'livestreams' => 'Transmisiuni în direct',
            'report' => 'Raportează o problemă',
        ],
        'legal' => [
            '_' => 'Legalitate & Statut',
            'copyright' => 'Drepturi de autor (DMCA)',
            'privacy' => 'Confidențialitate',
            'server_status' => 'Starea serverului',
            'source_code' => 'Cod sursă',
            'terms' => 'Termeni și condiții',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Pagina lipsește',
            'description' => "Ne pare rău, dar pagina solicitată nu este aici!",
        ],
        '403' => [
            'error' => "Nu ar trebui să fii aici.",
            'description' => 'Ai putea încerca să mergi înapoi, totuși.',
        ],
        '401' => [
            'error' => "Nu ar trebui să fii aici.",
            'description' => 'Ai putea să mergi înapoi, totuși. Sau poate să te conectezi.',
        ],
        '405' => [
            'error' => 'Pagina lipsește',
            'description' => "Ne pare rău, dar pagina solicitată nu este aici!",
        ],
        '500' => [
            'error' => 'Oh nu! Ceva s-a rupt! ;_;',
            'description' => "Suntem informați automat de fiecare eroare.",
        ],
        'fatal' => [
            'error' => 'Oh, nu! Ceva s-a stricat (serios)! ;_;',
            'description' => "We're automatically notified of every error.",
        ],
        '503' => [
            'error' => 'Inchis pentru mentenanță!',
            'description' => "Mentenanța durează de obicei oriunde între 5 secunde și 10 minute. Dacă durează mai mult, vezi :link pentru mai multe informații.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Pentru orice eventualitate, aici este un cod pe care îl poți oferi pentru asistență!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'adresa de e-mail',
            'forgot' => "Mi-am uitat detaliile de autentificare",
            'password' => 'parolă',
            'title' => 'Autentifică-te pentru a continua',

            'error' => [
                'email' => "Numele de utilizator sau adresa de e-mail nu există",
                'password' => 'Parolă incorectă',
            ],
        ],

        'register' => [
            'info' => "Ai nevoie de un cont, domnule. De ce nu ai unul deja?",
            'title' => "Nu ai un cont?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Setări',
            'friends' => 'Prieteni',
            'logout' => 'Deconectare',
            'profile' => 'Profilul meu',
        ],
    ],

    'popup_search' => [
        'initial' => 'Tastați pentru a căuta!',
        'retry' => 'Căutarea nu a reușit. Faceți clic pentru a reîncerca.',
    ],
];
