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
        'page_description' => 'osu! - Il ritmo è ad un *click* di distanza!  Con Ouendan/EBA, Taiko e originali modalità di gameplay, oltre che un editor di livelli completamente funzionale.',
    ],

    'menu' => [
        'home' => [
            '_' => 'home',
            'getChangelog' => 'changelog',
            'getDownload' => 'download',
            'getIcons' => 'icone',
            'supportTheGame' => 'sostieni il gioco',
        ],
        'help' => [
            '_' => 'aiuto',
            'getWiki' => 'wiki',
            'getFaq' => 'domande comuni',
            'getSupport' => 'supporto', //obsolete
        ],
        'beatmaps' => [
            '_' => 'beatmap',
            'show' => 'informazioni',
            'index' => 'lista',
            'artists' => 'artisti in primo piano',
            // 'getPacks' => 'pacchi',
            // 'getCharts' => 'chart', //could be "classifiche" but the user would mistake as a leaderboard and not the monthly chart
        ],
        'beatmapsets' => [
            '_' => 'beatmapsets',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'rank',
            'charts' => 'charts',
        ],
        'community' => [
            '_' => 'comunità',
            'getForum' => 'forum', // Base text changed to plural, please check.
            'getChat' => 'chat',
            'getLive' => 'dirette',
            'contests' => 'concorsi',
            'profile' => 'profilo',
            'tournaments' => 'tornei',
            'tournaments-index' => 'tornei',
            'tournaments-show' => 'informazioni sul torneo',
            'forum-topic-watches-index' => 'Iscrizioni ai Topic',
            'forum-topics-create' => 'forum', // Base text changed to plural, please check.
            'forum-topics-show' => 'forum', // Base text changed to plural, please check.
            'forum-forums-index' => 'forum', // Base text changed to plural, please check.
            'forum-forums-show' => 'forum', // Base text changed to plural, please check.
        ],
        'multiplayer' => [
            '_' => 'multigiocatore',
            'show' => 'match',
        ],
        'error' => [
            '_' => 'errore',
            '404' => 'mancante',
            '403' => 'proibito',
            '401' => 'non autorizzato',
            '405' => 'mancante',
            '500' => 'qualcosa si è rotto',
            '503' => 'mantenimento',
        ],
        'user' => [
            '_' => 'utente',
            'getLogin' => 'login',
            'disabled' => 'disabilitato',

            'register' => 'registra',
            'reset' => 'recupera',
            'new' => 'nuovo',

            'messages' => 'Messaggi',
            'settings' => 'Impostazioni',
            'logout' => 'Disconnettiti', // Base text changed from "Log Out" to "Sign Out", please check.
            'help' => 'Aiuto',
        ],
        'store' => [
            '_' => 'negozio',
            'getListing' => 'lista',
            'cart-show' => 'carrello',

            'getCheckout' => 'cassa',
            'getInvoice' => 'fattura',
            'products-show' => 'prodotto',

            'new' => 'nuovo',
            'home' => 'home',
            'index' => 'home',
            'thanks' => 'grazie',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'copertine del forum',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'ordini',
            'orders-show' => 'ordine',
        ],
        'admin' => [
            '_' => 'admministratori',
            'logs-index' => 'log',
            'beatmapsets' => [
                '_' => 'beatmapsets',
                'covers' => 'copertine',
                'show' => 'dettagli',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Generale',
            'home' => 'Home',
            'changelog' => 'Changelog',
            'beatmaps' => 'Lista Beatmap',
            'download' => 'Scarica osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Aiuto e Comunità',
            'faq' => 'Domande Comunii',
            'forum' => 'Forum della Comunità',
            'livestreams' => 'Dirette',
            'report' => 'Segnala un problema',
        ],
        'support' => [
            '_' => 'Sostieni osu!',
            'tags' => 'Tag Supporter',
            'merchandise' => 'Merchandise', // ?
        ],
        'legal' => [
            '_' => 'Legale e Status',
            'copyright' => 'Copyright (DMCA)',
            'osu_status' => '@osustatus',
            'server_status' => 'Stato del Server',
            'terms' => 'Termini di Servizio',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Pagina Mancante',
            'description' => 'Mi spiace, ma la pagina che hai richiesto non è qui!',
            'link' => false,
        ],
        '403' => [
            'error' => 'Non dovresti essere qui.',
            'description' => 'Potresti comunque provare tornando indietro.',
            'link' => false,
        ],
        '401' => [
            'error' => 'Non dovresti essere qui.',
            'description' => 'Potresti comunque provare tornando indietro. O forse effettuando il login.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Pagina Mancante',
            'description' => 'Mi spiace, ma la pagina che hai richiesto non è qui!',
            'link' => false,
        ],
        '500' => [
            'error' => 'Oh no! Qualcosa si è rotto! ;_;',
            'description' => 'Siamo notificati automaticamente di qualsiasi errore.',
            'link' => false,
        ],
        'fatal' => [
            'error' => 'Oh no! Qualcosa si è rotto (gravemente)! ;_;',
            'description' => 'Siamo notificati automaticamente di qualsiasi errore.',
            'link' => false,
        ],
        '503' => [
            'error' => 'Chiuso per manutenzione!',
            'description' => 'La manutenzione normalmente richiede dai 5 secondi fino a 10 minuti. Se siamo chiusi per più tempo, controlla :link per ulteriori informazioni.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => 'Nel caso, ecco un codice che puoi dare al supporto!',
    ],

    'popup_login' => [
        'login' => [
            'email' => 'indirizzo email',
            'forgot' => 'Ho dimenticato i miei dati',
            'password' => 'password',
            'title' => 'Accedi per procedere',

            'error' => [
                'email' => "Il nome utente o l'indirizzo email non esiste",
                'password' => 'Password errata',
            ],
        ],

        'register' => [
            'info' => 'Ha bisogno di un account, signore. Perchè non ne ha ancora uno?',
            'title' => 'Non hai un account?',
        ],
    ],

    'popup_user' => [
        'links' => [
            'profile' => 'Mio Profilo',
            'logout' => 'Disconnettiti', // Base text changed from "Log Out" to "Sign Out", please check.
        ],
    ],
];
