<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Compite de más formas que solo presionando círculos.',
        'large' => 'Concursos de la comunidad',
    ],

    'index' => [
        'nav_title' => 'listado',
    ],

    'judge' => [
        'comments' => 'comentarios',
        'hide_judged' => 'ocultar las inscripciones evaluadas',
        'nav_title' => 'evaluar',
        'no_current_vote' => 'aún no has votado.',
        'update' => 'actualizar',
        'validation' => [
            'missing_score' => 'puntuación faltante',
            'contest_vote_judged' => 'no puedes votar en concursos ya evaluados',
        ],
        'voted' => 'Ya has votado por esta opción.',
    ],

    'judge_results' => [
        '_' => 'Resultados de la evaluación',
        'creator' => 'creador',
        'score' => 'Puntuación',
        'score_std' => '',
        'total_score' => 'puntuación total',
        'total_score_std' => '',
    ],

    'voting' => [
        'judge_link' => 'Eres un juez en este concurso. ¡Evalúa las inscripciones aquí!',
        'judged_notice' => 'Este concurso está utilizando el sistema de evaluación, los jueces están procesando actualmente las inscripciones.',
        'login_required' => 'Inicia sesión para votar.',
        'over' => 'El plazo de votación para este concurso ha finalizado',
        'show_voted_only' => 'Mostrar mis votos',

        'best_of' => [
            'none_played' => "¡Parece que no has jugado ningún mapa que cumpla con los requisitos de este concurso!",
        ],

        'button' => [
            'add' => 'Votar',
            'remove' => 'Quitar voto',
            'used_up' => 'Ya has usado todos tus votos',
        ],

        'progress' => [
            '_' => ':used / :max votos usados',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Debes jugar todos los mapas en las listas de juego especificadas antes de votar',
            ],
        ],
    ],

    'entry' => [
        '_' => 'inscripción',
        'login_required' => 'Inicia sesión para participar en el concurso.',
        'silenced_or_restricted' => 'No puedes participar en los concursos mientras estés restringido o silenciado.',
        'preparation' => 'Estamos preparando este concurso actualmente. ¡Espera pacientemente!',
        'drop_here' => 'Suelta tu inscripción aquí',
        'download' => 'Descargar archivo .osz',

        'wrong_type' => [
            'art' => 'Solo se aceptan archivos .jpg y .png en este concurso.',
            'beatmap' => 'Solo se aceptan archivos .osu en este concurso.',
            'music' => 'Solo se aceptan archivos .mp3 en este concurso.',
        ],

        'wrong_dimensions' => 'Los envíos para este concurso deben ser de :widthx:height',
        'too_big' => 'Los envíos para este concurso solo pueden ser de hasta :limit.',
    ],

    'beatmaps' => [
        'download' => 'Descargar inscripción',
    ],

    'vote' => [
        'list' => 'votos',
        'count' => ':count_delimited voto|:count_delimited votos',
        'points' => ':count_delimited punto|:count_delimited puntos',
        'points_float' => '',
    ],

    'dates' => [
        'ended' => 'Finalizó el :date',
        'ended_no_date' => 'Finalizado',

        'starts' => [
            '_' => 'Comienza el :date',
            'soon' => 'soon™',
        ],
    ],

    'states' => [
        'entry' => 'Inscripción abierta',
        'voting' => 'Votación iniciada',
        'results' => 'Resultados',
    ],
];
