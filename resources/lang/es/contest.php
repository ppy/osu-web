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
        'hide_judged' => 'ocultar entradas evaluadas',
        'nav_title' => 'evaluar',
        'no_current_vote' => 'aún no has votado.',
        'update' => 'actualizar',
        'validation' => [
            'missing_score' => 'puntuación faltante',
            'contest_vote_judged' => 'no puedes votar en concursos ya evaluados',
        ],
        'voted' => 'Ya has enviado un voto en esta entrada.',
    ],

    'judge_results' => [
        '_' => 'Resultados de la evaluación',
        'creator' => 'creador',
        'score' => 'Puntuación',
        'total_score' => 'puntuación total',
    ],

    'voting' => [
        'judge_link' => 'Eres un evaluador de este concurso. ¡Evalúa las entradas aquí!',
        'judged_notice' => 'Este concurso está usando el sistema de evaluación, los evaluadores actualmente están procesando las entradas.',
        'login_required' => 'Inicie sesión para votar.',
        'over' => 'Las votaciones para este concurso ya han terminado',
        'show_voted_only' => 'Mostrar votado',

        'best_of' => [
            'none_played' => "¡No parece que hayas jugado a ningún mapa que califique para este concurso!",
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
        '_' => 'entrada',
        'login_required' => 'Inicia sesión para participar en el concurso.',
        'silenced_or_restricted' => 'No puedes participar en los concursos mientras estés restringido o silenciado.',
        'preparation' => 'Estamos preparando este concurso actualmente. ¡Espera pacientemente!',
        'drop_here' => 'Suelta tu entrada aquí',
        'download' => 'Descargar archivo .osz',

        'wrong_type' => [
            'art' => 'Solo se aceptan archivos .jpg y .png en este concurso.',
            'beatmap' => 'Solo se aceptan archivos .osu en este concurso.',
            'music' => 'Solo se aceptan archivos .mp3 en este concurso.',
        ],

        'wrong_dimensions' => 'Las entradas para este concurso deben ser :widthx:height',
        'too_big' => 'Las entradas para este concurso solo pueden ser de hasta :limit.',
    ],

    'beatmaps' => [
        'download' => 'Descargar entrada',
    ],

    'vote' => [
        'list' => 'votos',
        'count' => ':count_delimited voto|:count_delimited votos',
        'points' => ':count_delimited punto|:count_delimited puntos',
    ],

    'dates' => [
        'ended' => 'Finalizó el :date',
        'ended_no_date' => 'Finalizado',

        'starts' => [
            '_' => 'Comienza :date',
            'soon' => 'pronto™',
        ],
    ],

    'states' => [
        'entry' => 'Entrada abierta',
        'voting' => 'Votación iniciada',
        'results' => 'Resultados',
    ],
];
