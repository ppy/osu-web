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
            'more' => 'altri :count risultati di ricerca delle beatmap',
            'more_simple' => 'Vedi più risultati di ricerca delle beatmap',
            'title' => 'Beatmap',
        ],

        'forum_post' => [
            'all' => 'Tutti i forum',
            'link' => 'Cerca nel forum',
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

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Sembra che te la stai passando bene! :D',
        'body' => [
            'part-1' => 'Sapevi che osu! è privo di pubblicità, e si basa sui giocatori per supportare il suo sviluppo e mantenimento?',
            'part-2' => 'Sapevi anche che supportando osu! ricevi nuove utili funzionalità, come ad esempio il <strong>download in gioco</strong> che si avvia in modalità spettatore e nelle partite multigiocatore?',
        ],
        'find-out-more' => 'Clicca qui per scoprire di più!',
        'download-starting' => "Oh, e non preoccuparti - il tuo download è stato già avviato per te ;)",
    ],
];
