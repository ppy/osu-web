<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Scarica ora',
        'online' => '<strong>:players</strong> giocatori online in <strong>:games</strong> partite',
        'peak' => 'Picco, :count utenti online',
        'players' => '<strong>:count</strong> utenti registrati',
        'title' => 'benvenuto',
        'see_more_news' => 'guarda più notizie',

        'slogan' => [
            'main' => 'il miglior gioco di ritmo free-to-win',
            'sub' => 'il ritmo è solo ad un click di distanza',
        ],
    ],

    'search' => [
        'advanced_link' => 'Ricerca avanzata',
        'button' => 'Cerca',
        'empty_result' => 'Nessun risultato!',
        'keyword_required' => 'È necessaria una parola chiave di ricerca',
        'placeholder' => 'digita per cercare',
        'title' => 'Cerca',

        'beatmapset' => [
            'login_required' => 'Accedi per cercare beatmap',
            'more' => 'altri :count risultati di ricerca delle beatmap',
            'more_simple' => 'Vedi più risultati di ricerca delle beatmap',
            'title' => 'Beatmap',
        ],

        'forum_post' => [
            'all' => 'Tutti i forum',
            'link' => 'Cerca nel forum',
            'login_required' => 'Accedi per cercare nel forum',
            'more_simple' => 'Vedi più risultati di ricerca del forum',
            'title' => 'Forum',

            'label' => [
                'forum' => 'cerca nel forum',
                'forum_children' => 'includi subforum',
                'topic_id' => 'discussione #',
                'username' => 'autore',
            ],
        ],

        'mode' => [
            'all' => 'tutto',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'giocatore',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'Accedi per cercare utenti',
            'more' => 'altri :count risultati di ricerca di giocatori',
            'more_simple' => 'Vedi più risultati di ricerca di giocatori',
            'more_hidden' => 'La ricerca di giocatori è limitata a :max giocatori. Prova a ridefinire la ricerca.',
            'title' => 'Giocatori',
        ],

        'wiki_page' => [
            'link' => 'Cerca nella wiki',
            'more_simple' => 'Vedi più risultati di ricerca della wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "iniziamo<br>subito!",
        'action' => 'Scarica osu!',

        'help' => [
            '_' => 'se hai problemi ad avviare il gioco o a registrarti l\'account, :help_forum_link oppure :support_button.',
            'help_forum_link' => 'visita il forum di assistenza',
            'support_button' => 'contatta il supporto',
        ],

        'os' => [
            'windows' => 'per Windows',
            'macos' => 'per macOS',
            'linux' => 'per Linux',
        ],
        'mirror' => 'mirror',
        'macos-fallback' => 'utenti macOS',
        'steps' => [
            'register' => [
                'title' => 'registrati',
                'description' => 'segui le istruzioni quando avvii il gioco per accedere o creare un nuovo account',
            ],
            'download' => [
                'title' => 'scarica il gioco',
                'description' => 'clicca il bottone sopra per scaricare l\'installer, poi avvialo!',
            ],
            'beatmaps' => [
                'title' => 'ottieni beatmap',
                'description' => [
                    '_' => ':browse la vasta libreria di beatmap create dagli utenti e inizia a giocare!',
                    'browse' => 'esplora',
                ],
            ],
        ],
        'video-guide' => 'video guida',
    ],

    'user' => [
        'title' => 'dashboard',
        'news' => [
            'title' => 'Notizie',
            'error' => 'Errore nel caricamento delle notizie, prova a riavviare la pagina?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Amici Online',
                'games' => 'Partite',
                'online' => 'Utenti Online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nuove Beatmap Classificate',
            'popular' => 'Beatmap Popolari',
            'by_user' => 'di :user',
        ],
        'buttons' => [
            'download' => 'Scarica osu!',
            'support' => 'Supporta osu!',
            'store' => 'osu!store',
        ],
    ],
];
