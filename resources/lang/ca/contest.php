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

    'judge' => [
        'comments' => 'comentaris',
        'hide_judged' => 'amagar entrades avaluades',
        'nav_title' => 'avaluar',
        'no_current_vote' => 'encara no has votat.',
        'update' => 'actualitzar',
        'validation' => [
            'missing_score' => 'puntuació faltant',
            'contest_vote_judged' => 'no pots votar en concursos avaluats',
        ],
        'voted' => 'Ja has enviat un vot en aquesta entrada.',
    ],

    'judge_results' => [
        '_' => 'Resultats de l\'avaluació',
        'creator' => 'creador',
        'score' => 'Puntuació',
        'score_std' => 'Puntuació Estandarditzada',
        'total_score' => 'puntuació total',
        'total_score_std' => 'puntuació estandarditzada total',
    ],

    'voting' => [
        'judge_link' => 'Ets un avaluador d\'aquest concurs. Avalua les entrades aquí!',
        'judged_notice' => 'Aquest concurs està utilitzant el sistema d\'avaluació, els avaluadors actualment estan processant les entrades.',
        'login_required' => 'Si us plau, inicia sessió per a votar.',
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
                'incomplete_play' => 'Heu de jugar tots els mapes a les llistes de joc especificades abans de votar',
            ],
        ],
    ],

    'entry' => [
        '_' => 'entrada',
        'login_required' => 'Si us plau, inicieu la sessió per participar al concurs.',
        'silenced_or_restricted' => 'No pots accedir a tornejos mentre estràs silenciat o restringit.',
        'preparation' => 'Estem preparant aquest torneig. Si us plau, espera pacientment!',
        'drop_here' => 'Posa la teva inscripció aquí',
        'allowed_extensions' => '',
        'max_size' => '',
        'required_dimensions' => '',
        'download' => 'Descarregar .osz',
        'wrong_file_type' => '',
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
        'points_float' => ':points punts',
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

    'show' => [
        'admin' => [
            'page' => 'Veure info i entrades',
        ],
    ],
];
