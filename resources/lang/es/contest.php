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
    'header' => [
        'small' => 'Compite de más formas que solo presionando círculos.',
        'large' => 'Concursos de la comunidad',
    ],

    'index' => [
        'nav_title' => 'listado',
    ],

    'voting' => [
        'over' => 'Las votaciones para este concurso ya han terminado',
        'login_required' => 'Por favor, inicia sesión para votar.',

        'best_of' => [
            'none_played' => "¡No parece que hayas jugado algún beatmap que califique para este concurso!",
        ],

        'button' => [
            'add' => 'Votar',
            'remove' => 'Quitar voto',
            'used_up' => 'Ya has usado todos tus votos',
        ],
    ],
    'entry' => [
        '_' => 'participación',
        'login_required' => 'Por favor, inicia sesión para entrar al concurso.',
        'silenced_or_restricted' => 'No puedes entrar a concursos mientras estas restringido o silenciado.',
        'preparation' => 'Estamos preparando este concurso actualmente. Por favor, ¡Espera pacientemente!',
        'over' => '¡Gracias por su participación! Los envíos se han cerrado para este concurso y la votación se abrirá pronto.',
        'limit_reached' => 'Has alcanzado el límite de entradas para este concurso',
        'drop_here' => 'Suelta tu entrada aquí',
        'download' => 'Descargar archivo .osz',
        'wrong_type' => [
            'art' => 'Solo se aceptan archivos .jpg y .png en este concurso.',
            'beatmap' => 'Solo se aceptan archivos .osu en este concurso.',
            'music' => 'Solo se aceptan archivos .mp3 en este concurso.',
        ],
        'too_big' => 'Tu archivo no puede exceder el siguiente tamaño: :limit.',
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

        'starts' => [
            '_' => 'Empezó el :date',
            'soon' => 'pronto',
        ],
    ],
    'states' => [
        'entry' => 'Registros Abiertos',
        'voting' => 'Votación Iniciada',
        'results' => 'Resultados',
    ],
];
