<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Competi in altri modi oltre che a cliccare cerchi.',
        'large' => 'Contest della Comunità',
    ],

    'index' => [
        'nav_title' => 'lista',
    ],

    'judge' => [
        'comments' => 'commenti',
        'hide_judged' => 'nascondi le voci valutate',
        'nav_title' => 'giudice',
        'no_current_vote' => 'non hai ancora votato.',
        'update' => 'aggiorna',
        'validation' => [
            'missing_score' => 'punteggio mancante',
            'contest_vote_judged' => 'non puoi votare nei concorsi con valutazione',
        ],
        'voted' => 'Hai già presentato un voto per questa voce.',
    ],

    'judge_results' => [
        '_' => 'Risultati della valutazione',
        'creator' => 'autore',
        'score' => 'Punteggio',
        'score_std' => '',
        'total_score' => 'punteggio totale',
        'total_score_std' => '',
    ],

    'voting' => [
        'judge_link' => 'Sei un giudice di questo concorso. Valuta qui le iscrizioni!',
        'judged_notice' => 'Questo concorso sta utilizzando il sistema di valutazione, i giudici stanno attualmente analizzando le voci.',
        'login_required' => 'Effettua il login per poter votare.',
        'over' => 'Le votazioni per questo contest sono terminate',
        'show_voted_only' => 'Mostra votati',

        'best_of' => [
            'none_played' => "Sembra che tu non abbia giocato nessuna beatmap che si qualifica per questo contest!",
        ],

        'button' => [
            'add' => 'Vota',
            'remove' => 'Rimuovi voto',
            'used_up' => 'Hai usato tutti i tuoi voti',
        ],

        'progress' => [
            '_' => ':used / :max voti utilizzati',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'È necessario giocare tutte le beatmap nelle playlist specificate prima di votare',
            ],
        ],
    ],

    'entry' => [
        '_' => 'iscrizione',
        'login_required' => 'Effettua il login per poter entrare nel contest.',
        'silenced_or_restricted' => 'Non puoi entrare nei contest se sei limitato o silenziato.',
        'preparation' => 'Attualmente stiamo preparando il contest. Aspettate con pazienza!',
        'drop_here' => 'Trascina la tua iscrizione qui',
        'download' => 'Scarica .osz',

        'wrong_type' => [
            'art' => 'Solo file .jpg e .png sono accettati per questo contest.',
            'beatmap' => 'Solo file .osu sono accettati per questo contest.',
            'music' => 'Solo file .mp3 sono accettati per questo contest.',
        ],

        'wrong_dimensions' => 'Le iscrizioni per questo concorso devono essere :widthx:height',
        'too_big' => 'Le iscrizioni per questo contest non possono essere più grandi di :limit.',
    ],

    'beatmaps' => [
        'download' => 'Scarica Iscrizione',
    ],

    'vote' => [
        'list' => 'voti',
        'count' => ':count_delimited voto|:count_delimited voti',
        'points' => ':count_delimited punto|:count_delimited punti',
        'points_float' => ':points punti',
    ],

    'dates' => [
        'ended' => 'Terminato il giorno :date',
        'ended_no_date' => 'Terminato',

        'starts' => [
            '_' => 'Inizia :date',
            'soon' => 'presto™',
        ],
    ],

    'states' => [
        'entry' => 'Iscrizioni Aperte',
        'voting' => 'Votazione Iniziata',
        'results' => 'Risultati Pubblicati',
    ],

    'show' => [
        'admin' => [
            'page' => '',
        ],
    ],
];
