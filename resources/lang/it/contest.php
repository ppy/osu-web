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

    'voting' => [
        'over' => 'Le votazioni per questo contest sono terminate',
        'login_required' => 'Per favore effettua il login per votare.',

        'best_of' => [
            'none_played' => "Sembra che tu non abbia giocato nessuna beatmap che si qualifica per questo contest!",
        ],

        'button' => [
            'add' => 'Vota',
            'remove' => 'Rimuovi voto',
            'used_up' => 'Hai usato tutti i tuoi voti',
        ],
    ],
    'entry' => [
        '_' => 'iscrizione',
        'login_required' => 'Per favore effettua il login per entrare nel contest.',
        'silenced_or_restricted' => 'Non puoi entrare nei contest se sei limitato o silenziato.',
        'preparation' => 'Attualmente stiamo preparando il contest. Per favore attendi con pazienza!',
        'over' => 'Grazie per le tue iscrizioni! Le richieste sono terminate per questo contest e le votazioni avverranno presto.',
        'limit_reached' => 'Hai raggiunto il limite massimo di iscrizioni per questo contest',
        'drop_here' => 'Trascina la tua iscrizione qui',
        'download' => 'Scarica .osz',
        'wrong_type' => [
            'art' => 'Solo file .jpg e .png sono accettati per questo contest.',
            'beatmap' => 'Solo file .osu sono accettati per questo contest.',
            'music' => 'Solo file .mp3 sono accettati per questo contest.',
        ],
        'too_big' => 'Le iscrizioni per questo contest non possono essere più grandi di :limit.',
    ],
    'beatmaps' => [
        'download' => 'Scarica Iscrizione',
    ],
    'vote' => [
        'list' => 'voti',
        'count' => ':count_delimited voto|:count_delimited voti',
        'points' => ':count_delimited punto|:count_delimited punti',
    ],
    'dates' => [
        'ended' => 'Terminato :date',
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
];
