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
    'availability' => [
        'disabled' => 'Este Beatmap no está actualmente disponible para descargar.',
        'parts-removed' => 'Algunas partes de este beatmap se han eliminado a petición del creador o de un titular de derechos de autor.',
        'more-info' => 'Compruebe aquí para más información.',
    ],

    'index' => [
        'title' => 'Listado de Beatmaps',
        'guest_title' => 'Mapas',
    ],

    'show' => [
        'discussion' => 'Discusión',

        'details' => [
            'favourite' => 'Marcar como favorito',
            'logged-out' => '¡Necesitas iniciar sesión antes de descargar cualquier beatmap!',
            'mapped_by' => 'mapeado por :mapper',
            'unfavourite' => 'Desmarcar como favorito',
            'updated_timeago' => 'actualizado por última vez el :timeago',

            'download' => [
                '_' => 'Descargar',
                'direct' => 'osu!direct',
                'no-video' => 'sin Video',
                'video' => 'con Video',
            ],

            'login_required' => [
                'bottom' => 'para acceder a más características',
                'top' => 'Iniciar sesión',
            ],
        ],

        'favourites' => [
            'limit_reached' => '¡Tienes demasiados mapas favoritos! Por favor, desmarca algunos antes de volver a intentarlo.',
        ],

        'hype' => [
            'action' => 'Apoya este mapa si te gusto para ayudarlo a legar a <strong>Ranked</strong>.',

            'current' => [
                '_' => 'El mapa esta :status.',

                'status' => [
                    'pending' => 'pendiente',
                    'qualified' => 'calificado',
                    'wip' => 'trabajo en progreso',
                ],
            ],

            'disqualify' => [
                '_' => 'Si encuentras un problema con este mapa, por favor descalifícalo :link.',
                'button_title' => 'Descalifica un mapa calificado.',
            ],

            'report' => [
                '_' => 'Si encuentras un problema con este mapa, por favor repórtalo :link para alertar al equipo.',
                'button' => 'Reportar un problema',
                'button_title' => 'Informe de un problema en un mapa calificado.',
                'link' => 'aquí',
            ],
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
            'unranked' => 'Mapa no clasificado',
        ],

        'scoreboard' => [
            'achieved' => 'logrado :when',
            'country' => 'Clasificación Nacional',
            'friend' => 'Clasificación entre Amigos',
            'global' => 'Clasificación Global',
            'supporter-link' => '¡Clic <a href=":link">aquí</a> para ver todas las increíbles características que obtienes!',
            'supporter-only' => '¡Necesitas ser un osu!supporter para acceder a las clasificaciones nacionales y entre amigos!',
            'title' => 'Tabla de puntuaciones',

            'headers' => [
                'accuracy' => 'Precisión',
                'combo' => 'Combo máximo',
                'miss' => 'Fallos',
                'mods' => 'Mods',
                'player' => 'Jugador',
                'pp' => 'pp',
                'rank' => 'Puesto',
                'score_total' => 'Puntuación total',
                'score' => 'Puntuación',
            ],

            'no_scores' => [
                'country' => '¡Nadie de tu país ha marcado una puntuación en este mapa aún!',
                'friend' => '¡Ninguno de tus amigos ha marcado una puntuación en este mapa aún!',
                'global' => 'Sin puntuaciones aún. ¿Tal vez deberías intentar establecer alguna?',
                'loading' => 'Cargando puntuaciones...',
                'unranked' => 'Mapa no clasificado.',
            ],
            'score' => [
                'first' => 'A la cabeza',
                'own' => 'Tu mejor puntuación',
            ],
        ],

        'stats' => [
            'cs' => 'Tamaño del Círculo',
            'cs-mania' => 'Cantidad de Teclas',
            'drain' => 'Drenado de HP',
            'accuracy' => 'Precisión',
            'ar' => 'Velocidad de aproximación',
            'stars' => 'Estrellas de Dificultad',
            'total_length' => 'Duración',
            'bpm' => 'BPM',
            'count_circles' => 'Número de Círculos',
            'count_sliders' => 'Número de Deslizadores',
            'user-rating' => 'Valoración de los Usuarios',
            'rating-spread' => 'Desglose de valoraciones',
            'nominations' => 'Nominaciones',
            'playcount' => 'Veces jugado',
        ],

        'status' => [
            'ranked' => 'Clasificado',
            'approved' => 'Aprobado',
            'loved' => 'Amado',
            'qualified' => 'Calificado',
            'wip' => 'WIP',
            'pending' => 'Pendiente',
            'graveyard' => 'Abandonado',
        ],
    ],
];
