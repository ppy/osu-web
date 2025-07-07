<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Riproduci in automatico la traccia successiva',
    ],

    'defaults' => [
        'page_description' => 'osu! - Il ritmo è a distanza di un *click*!  Con Ouendan/EBA, Taiko e modalità di gioco originali con un editor di livelli dotato di ogni funzionalità.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'set di beatmap',
            'beatmapset_covers' => 'copertine dei set di beatmap',
            'contest' => 'concorso',
            'contests' => 'concorsi',
            'root' => 'console',
        ],

        'artists' => [
            'index' => 'lista',
        ],

        'beatmapsets' => [
            'show' => 'dettagli',
            'discussions' => 'discussione',
        ],

        'changelog' => [
            'index' => 'lista',
        ],

        'help' => [
            'index' => 'indice',
            'sitemap' => 'Mappa del sito',
        ],

        'store' => [
            'cart' => 'carrello',
            'orders' => 'cronologia ordini',
            'products' => 'prodotti',
        ],

        'tournaments' => [
            'index' => 'lista',
        ],

        'users' => [
            'modding' => 'modding',
            'playlists' => 'playlist',
            'realtime' => 'multigiocatore',
            'show' => 'dettagli',
        ],
    ],

    'gallery' => [
        'close' => 'Chiudi (Esc)',
        'fullscreen' => 'Passa a schermo intero',
        'zoom' => 'Zoom in/out',
        'previous' => 'Precedente (freccia sinistra)',
        'next' => 'Successivo (freccia destra)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmap',
        ],
        'community' => [
            '_' => 'comunità',
            'dev' => 'sviluppo',
        ],
        'help' => [
            '_' => 'aiuto',
            'getAbuse' => 'segnala un abuso',
            'getFaq' => 'domande frequenti',
            'getRules' => 'regole',
            'getSupport' => 'davvero, mi serve aiuto!',
        ],
        'home' => [
            '_' => 'home',
            'team' => 'team',
        ],
        'rankings' => [
            '_' => 'classifiche',
        ],
        'store' => [
            '_' => 'negozio',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Generale',
            'home' => 'Home',
            'changelog-index' => 'Note di rilascio',
            'beatmaps' => 'Lista Beatmap',
            'download' => 'Scarica osu!',
        ],
        'help' => [
            '_' => 'Aiuto e Comunità',
            'faq' => 'Domande Frequenti',
            'forum' => 'Forum della Comunità',
            'livestreams' => 'Live',
            'report' => 'Segnala un problema',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Legale e Status',
            'copyright' => 'Copyright (DMCA)',
            'jp_sctl' => '',
            'privacy' => 'Privacy',
            'rules' => '',
            'server_status' => 'Stato del Server',
            'source_code' => 'Codice Sorgente',
            'terms' => 'Termini di Servizio',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Parametro di richiesta non valido',
            'description' => '',
        ],
        '404' => [
            'error' => 'Pagina Mancante',
            'description' => "Mi spiace, ma la pagina che hai richiesto non è qui!",
        ],
        '403' => [
            'error' => "Non dovresti essere qui.",
            'description' => 'Puoi comunque provare a tornare indietro.',
        ],
        '401' => [
            'error' => "Non dovresti essere qui.",
            'description' => 'Puoi comunque provare a tornare indietro. Oppure effettuando il login.',
        ],
        '405' => [
            'error' => 'Pagina Mancante',
            'description' => "Mi spiace, ma la pagina che hai richiesto non è qui!",
        ],
        '422' => [
            'error' => 'Parametro richiesta non valido',
            'description' => '',
        ],
        '429' => [
            'error' => 'Limite di richieste superato',
            'description' => '',
        ],
        '500' => [
            'error' => 'Oh no! Qualcosa si è rotto! ;_;',
            'description' => "Siamo notificati automaticamente per qualsiasi errore.",
        ],
        'fatal' => [
            'error' => 'Oh no! Qualcosa si è rotto (gravemente)! ;_;',
            'description' => "Siamo notificati automaticamente per qualsiasi errore.",
        ],
        '503' => [
            'error' => 'Chiuso per manutenzione!',
            'description' => "La manutenzione normalmente richiede dai 5 secondi fino a 10 minuti. Se siamo chiusi per più tempo, controlla :link per ulteriori informazioni.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Nel caso, ecco un codice che puoi dare al supporto!",
    ],

    'popup_login' => [
        'button' => 'accedi / registrati',

        'login' => [
            'forgot' => "Ho dimenticato i miei dati",
            'password' => 'password',
            'title' => 'Accedi Per Continuare',
            'username' => 'nome utente',

            'error' => [
                'email' => "Il nome utente o l'indirizzo email non esiste",
                'password' => 'Password errata',
            ],
        ],

        'register' => [
            'download' => 'Scarica',
            'info' => 'Scarica osu! per creare il tuo account!',
            'title' => "Non hai un account?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Impostazioni',
            'follows' => 'Iscrizioni',
            'friends' => 'Amici',
            'legacy_score_only_toggle' => 'Modalità lazer',
            'legacy_score_only_toggle_tooltip' => 'La modalità lazer mostra i punteggi di lazer con un nuovo algoritmo dei punti',
            'logout' => 'Esci',
            'profile' => 'Profilo',
            'scoring_mode_toggle' => 'Punteggio classico',
            'scoring_mode_toggle_tooltip' => 'Regola i valori del punteggio per farli sembrare come il punteggio classico illimitato',
            'team' => 'Squadra',
        ],
    ],

    'popup_search' => [
        'initial' => 'Digita per cercare!',
        'retry' => 'Ricerca fallita. Clicca per riprovare.',
    ],
];
