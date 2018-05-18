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
        'page_description' => 'osu! - Il ritmo è ad un *click* di distanza!  Con Ouendan/EBA, Taiko e originali modalità di gameplay, oltre che un editor di livelli completamente funzionale.',
    ],

    'menu' => [
        'home' => [
            '_' => 'home',
            'account-edit' => '',
            'friends-index' => '',
            'changelog-index' => '',
            'changelog-show' => '',
            'getDownload' => 'download',
            'getIcons' => 'icone',
            'groups-show' => '',
            'index' => '',
            'legal-show' => '',
            'news-index' => '',
            'news-show' => '',
            'password-reset-index' => '',
            'search' => '',
            'supportTheGame' => 'sostieni il gioco',
            'team' => '',
        ],
        'help' => [
            '_' => 'aiuto',
            'getFaq' => 'domande comuni',
            'getRules' => '',
            'getSupport' => 'supporto',
            'getWiki' => 'wiki',
            'wiki-show' => '',
        ],
        'beatmaps' => [
            '_' => 'beatmap',
            'artists' => 'artisti in primo piano',
            'beatmap_discussion_posts-index' => '',
            'beatmap_discussions-index' => '',
            'beatmapset-watches-index' => '',
            'beatmapset_discussion_votes-index' => '',
            'beatmapset_events-index' => '',
            'index' => 'lista',
            'packs' => '',
            'show' => 'informazioni',
        ],
        'beatmapsets' => [
            '_' => 'beatmapsets',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'rank',
            'index' => '',
            'performance' => '',
            'charts' => 'charts',
            'score' => '',
            'country' => '',
            'kudosu' => '',
        ],
        'community' => [
            '_' => 'comunità',
            'dev' => '',
            'getForum' => 'forum',
            'getChat' => 'chat',
            'getLive' => 'dirette',
            'contests' => 'concorsi',
            'profile' => 'profilo',
            'tournaments' => 'tornei',
            'tournaments-index' => 'tornei',
            'tournaments-show' => 'informazioni sul torneo',
            'forum-topic-watches-index' => 'Iscrizioni ai Topic',
            'forum-topics-create' => 'forum',
            'forum-topics-show' => 'forum',
            'forum-forums-index' => 'forum',
            'forum-forums-show' => 'forum',
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
            'logout' => 'Disconnettiti',
            'help' => 'Aiuto',
            'modding-history-discussions' => '',
            'modding-history-events' => '',
            'modding-history-index' => '',
            'modding-history-posts' => '',
            'modding-history-votesGiven' => '',
            'modding-history-votesReceived' => '',
        ],
        'store' => [
            '_' => 'negozio',
            'checkout-show' => '',
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
            'beatmapsets-covers' => '',
            'logs-index' => 'log',
            'root' => '',

            'beatmapsets' => [
                '_' => 'beatmapsets',
                'show' => 'dettagli',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Generale',
            'home' => 'Home',
            'changelog-index' => '',
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
            'merchandise' => 'Merchandise',
        ],
        'legal' => [
            '_' => 'Legale e Status',
            'copyright' => 'Copyright (DMCA)',
            'server_status' => 'Stato del Server',
            'terms' => 'Termini di Servizio',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Pagina Mancante',
            'description' => "Mi spiace, ma la pagina che hai richiesto non è qui!",
        ],
        '403' => [
            'error' => "Non dovresti essere qui.",
            'description' => 'Potresti comunque provare tornando indietro.',
        ],
        '401' => [
            'error' => "Non dovresti essere qui.",
            'description' => 'Potresti comunque provare tornando indietro. O forse effettuando il login.',
        ],
        '405' => [
            'error' => 'Pagina Mancante',
            'description' => "Mi spiace, ma la pagina che hai richiesto non è qui!",
        ],
        '500' => [
            'error' => 'Oh no! Qualcosa si è rotto! ;_;',
            'description' => "Siamo notificati automaticamente di qualsiasi errore.",
        ],
        'fatal' => [
            'error' => 'Oh no! Qualcosa si è rotto (gravemente)! ;_;',
            'description' => "Siamo notificati automaticamente di qualsiasi errore.",
        ],
        '503' => [
            'error' => 'Chiuso per manutenzione!',
            'description' => "La manutenzione normalmente richiede dai 5 secondi fino a 10 minuti. Se siamo chiusi per più tempo, controlla :link per ulteriori informazioni.",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Nel caso, ecco un codice che puoi dare al supporto!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'indirizzo email',
            'forgot' => "Ho dimenticato i miei dati",
            'password' => 'password',
            'title' => 'Accedi per procedere',

            'error' => [
                'email' => "Il nome utente o l'indirizzo email non esiste",
                'password' => 'Password errata',
            ],
        ],

        'register' => [
            'info' => "Ha bisogno di un account, signore. Perchè non ne ha ancora uno?",
            'title' => "Non hai un account?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => '',
            'friends' => '',
            'logout' => 'Disconnettiti',
            'profile' => 'Mio Profilo',
        ],
    ],

    'popup_search' => [
        'initial' => '',
        'retry' => '',
    ],
];
