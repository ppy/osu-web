<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'availability' => [
        'disabled' => 'Este beatmap no está actualmente disponible para descargar.',
        'parts-removed' => 'Partes de este beatmap han sido eliminadas por la solicitud de su creador o un titular de derechos de autor.',
        'more-info' => 'Más información.',
    ],

    'index' => [
        'title' => 'Listado de Beatmaps',
        'guest_title' => '',
    ],

    'show' => [
        'discussion' => 'Discusión',

        'details' => [
            'made-by' => 'creado por ',
            'submitted' => 'publicado el ',
            'updated' => 'actualizado el ',
            'ranked' => 'rankeado el ',
            'approved' => 'aprobado el ',
            'qualified' => 'calificado el ',
            'loved' => 'amado el ',
            'logged-out' => '¡Necesitas iniciar sesión para descargar beatmaps!',
            'download' => [
                '_' => 'Descargar',
                'video' => 'con video',
                'no-video' => 'sin video',
                'direct' => '',
            ],
            'favourite' => 'Marcar como favorito',
            'unfavourite' => 'Desmarcar como favorito',
            'favourited_count' => '+ ¡1 persona más!|+ ¡:count personas más!',
        ],
        'stats' => [
            'cs' => 'Tamaño de Círculo',
            'cs-mania' => 'Cantidad de Teclas',
            'drain' => 'Drenado de HP',
            'accuracy' => 'Precisión',
            'ar' => 'Velocidad de aproximación',
            'stars' => 'Estrellas de Dificultad',
            'total_length' => 'Duración',
            'bpm' => '',
            'count_circles' => 'Número de Círculos',
            'count_sliders' => 'Número de Deslizadores',
            'user-rating' => 'Valoración de los Usuarios',
            'rating-spread' => 'Desglose de valoraciones',
            'nominations' => 'Nominaciones',
            'playcount' => 'Veces jugado',
        ],
        'info' => [
            'description' => 'Descripción',
            'genre' => 'Género',
            'language' => 'Idioma',
            'no_scores' => 'Los datos todavía están siendo calculados...',
            'points-of-failure' => 'Puntos de Fracaso',
            'source' => 'Fuente',
            'success-rate' => 'Tasa de éxito',
            'tags' => 'Etiquetas',
            'unranked' => 'Beatmap no rankeado',
        ],
        'scoreboard' => [
            'achieved' => 'logrado :when',
            'country' => 'Ranking Nacional',
            'friend' => 'Ranking de Amigos',
            'global' => 'Ranking Global',
            'supporter-link' => '¡Clic <a href=":link">aquí</a> para ver todas las increíbles características que obtienes!',
            'supporter-only' => '¡Necesitas ser supporter para acceder a los rankings entre amigos y de tu país!',
            'title' => 'Puntuaciones',

            'headers' => [
                'accuracy' => 'Precisión',
                'combo' => 'Combo máx.',
                'miss' => 'Fallos',
                'mods' => '',
                'player' => 'Jugador',
                'pp' => '',
                'rank' => '',
                'score_total' => 'Puntuación total',
                'score' => 'Puntuación',
            ],

            'no_scores' => [
                'country' => '¡Nadie de tu país ha marcado una puntuación en este mapa aún!',
                'friend' => '¡Ninguno de tus amigos ha marcado una puntuación en este mapa aún!',
                'global' => 'Sin puntuaciones aún. ¿Tal vez deberías intentar marcar alguna?',
                'loading' => 'Cargando puntuaciones...',
                'unranked' => 'Beatmap no rankeado.',
            ],
            'score' => [
                'first' => 'Liderando',
                'own' => 'Tu mejor puntuación',
            ],
        ],
    ],
];
