<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'availability' => [
        'disabled' => 'Este Beatmap no está actualmente disponible para descargar.',
        'parts-removed' => 'Algunas partes de este beatmap se han eliminado a petición del creador o de un titular de derechos de autor.',
        'more-info' => 'Marca aquí para más información.',
    ],

    'index' => [
        'title' => 'Listado de Beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Discusión',

        'details' => [
            'approved' => 'aprobado el ',
            'favourite' => 'Marcar como favorito este beatmapset',
            'logged-out' => '¡Necesitas iniciar sesión antes de descargar cualquier beatmap!',
            'loved' => 'amado el ',
            'mapped_by' => 'mapeado por :mapper',
            'qualified' => 'calificado el ',
            'ranked' => 'clasificado en ',
            'submitted' => 'enviado en ',
            'unfavourite' => 'Desmarcar como favorito este beatmapset',
            'updated' => 'última actualización en ',
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
            'limit_reached' => 'Tienes demasiados beatmaps en favoritos! Por favor, desmarca algunos antes de volver a intentarlo.',
        ],

        'hype' => [
            'action' => 'Apoya este mapa si te gusto para ayudarlo a legar a <strong>Ranked</strong>.',

            'current' => [
                '_' => 'El mapa esta :status.',

                'status' => [
                    'pending' => 'pendiente',
                    'qualified' => 'cualificado',
                    'wip' => 'trabajo en progreso',
                ],
            ],

            'report' => [
                '_' => '',
                'button' => '',
                'button_title' => '',
                'link' => '',
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
            'unranked' => 'Beatmap no rankeado',
        ],

        'scoreboard' => [
            'achieved' => 'logrado :when',
            'country' => 'Ranking Nacional',
            'friend' => 'Ranking de Amigos',
            'global' => 'Ranking Global',
            'supporter-link' => '¡Clic <a href=":link">aquí</a> para ver todas las increíbles características que obtienes!',
            'supporter-only' => '¡Necesitas ser supporter para acceder a los rankings entre amigos y de país!',
            'title' => 'Tabla de puntuaciones',

            'headers' => [
                'accuracy' => 'Precisión',
                'combo' => 'Combo máximo',
                'miss' => 'Fallos',
                'mods' => 'Mods',
                'player' => 'Jugador',
                'pp' => 'pp',
                'rank' => 'Rank',
                'score_total' => 'Puntuación total',
                'score' => 'Puntuación',
            ],

            'no_scores' => [
                'country' => '¡Nadie de tu país ha marcado una puntuación en este mapa aún!',
                'friend' => '¡Ninguno de tus amigos ha marcado una puntuación en este mapa aún!',
                'global' => 'Sin puntuaciones aún. ¿Tal vez deberías intentar establecer alguna?',
                'loading' => 'Cargando puntuaciones...',
                'unranked' => 'Beatmap no rankeado.',
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
    ],
];
