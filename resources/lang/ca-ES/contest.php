<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Competeix de més maneres que només pressionant cercles.',
        'large' => 'Tornejos de la comunitat',
    ],

    'index' => [
        'nav_title' => 'llistat',
    ],

    'voting' => [
        'login_required' => 'Sisplau, inicia sessió per a votar.',
        'over' => 'La votació per aquest torneig ha finalitzat',
        'show_voted_only' => 'Mostra els votats',

        'best_of' => [
            'none_played' => "No sembla que hagis jugat cap beatmap per a qualificar-te per al torneig!",
        ],

        'button' => [
            'add' => 'Vota',
            'remove' => 'Eliminar vot',
            'used_up' => 'Ja has fet servir tots els teus vots',
        ],

        'progress' => [
            '_' => ':used / :max vots utilitzats',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Heu de jugar tots els beatmaps a les llistes de joc especificades abans de votar',
            ],
        ],
    ],
    'entry' => [
        '_' => 'entrada',
        'login_required' => 'Si us plau, inicieu la sessió per participar al concurs.',
        'silenced_or_restricted' => 'No pots accedir a tornejos mentre estràs silenciat o restringit.',
        'preparation' => 'Estem preparant aquest torneig. Sisplau, espera una mica!',
        'drop_here' => 'Deixa anar la teva inscripció aquí',
        'download' => 'Descarregar .osz',
        'wrong_type' => [
            'art' => 'Només fitxers .jpg i .png s\'accepten per aquest torneig.',
            'beatmap' => 'Només fitxers .osu s\'accepten per aquest torneig.',
            'music' => 'Només fitxer .mp3 s\'accepten per aquest torneig.',
        ],
        'wrong_dimensions' => 'Les inscripcions per aquest torneig han de ser :widthx:height',
        'too_big' => 'Les inscripcions per aquest torneig només poden ser fins a :limit.',
    ],
    'beatmaps' => [
        'download' => 'Descarregar entrada',
    ],
    'vote' => [
        'list' => 'vots',
        'count' => ':count_delimited vot |:count_delimited vots',
        'points' => ':count_delimited punt|:count_delimited punts',
    ],
    'dates' => [
        'ended' => 'Finalitzat :date',
        'ended_no_date' => 'Finalitzat',

        'starts' => [
            '_' => 'Comença :date',
            'soon' => 'aviat™',
        ],
    ],
    'states' => [
        'entry' => 'Entrada oberta',
        'voting' => 'Votació iniciada',
        'results' => 'Resultats fora',
    ],
];
