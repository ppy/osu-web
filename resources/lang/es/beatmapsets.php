<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Este mapa no está actualmente disponible para su descarga.',
        'parts-removed' => 'Partes de este mapa han sido eliminadas a petición de su creador o un titular de derechos de autor.',
        'more-info' => 'Haga clic aquí para obtener más información.',
    ],

    'index' => [
        'title' => 'Listado de Mapas',
        'guest_title' => 'Mapas',
    ],

    'panel' => [
        'download' => [
            'all' => 'descargar',
            'video' => 'descargar con vídeo',
            'no_video' => 'descargar sin vídeo',
            'direct' => 'abrir en osu!direct',
        ],
    ],

    'show' => [
        'discussion' => 'Discusión',

        'details' => [
            'favourite' => 'Marcar como favorito',
            'logged-out' => '¡Necesitas iniciar sesión antes de descargar cualquier mapa!',
            'mapped_by' => 'mapeado por :mapper',
            'unfavourite' => 'Desmarcar como favorito',
            'updated_timeago' => 'actualizado por última vez :timeago',

            'download' => [
                '_' => 'Descargar',
                'direct' => 'osu!direct',
                'no-video' => 'sin vídeo',
                'video' => 'con vídeo',
            ],

            'login_required' => [
                'bottom' => 'para acceder a más características',
                'top' => 'Iniciar sesión',
            ],
        ],

        'details_date' => [
            'approved' => 'aprobado :timeago',
            'loved' => 'amado :timeago',
            'qualified' => 'calificado :timeago',
            'ranked' => 'clasificado :timeago',
            'submitted' => 'enviado :timeago',
            'updated' => 'actualizado por última vez :timeago',
        ],

        'favourites' => [
            'limit_reached' => '¡Tienes demasiados mapas favoritos! Por favor, desmarca algunos antes de volver a intentarlo.',
        ],

        'hype' => [
            'action' => 'Hypea este mapa si te gustó jugarlo para ayudar a que progrese al estado de <strong>Clasificado</strong>.',

            'current' => [
                '_' => 'Este mapa está actualmente :status.',

                'status' => [
                    'pending' => 'pendiente',
                    'qualified' => 'calificado',
                    'wip' => 'en proceso de elaboración',
                ],
            ],

            'disqualify' => [
                '_' => 'Si encuentras un problema con este mapa, por favor descalifícalo :link.',
            ],

            'report' => [
                '_' => 'Si encuentras un problema con este mapa, por favor repórtalo :link para alertar al equipo.',
                'button' => 'Reportar un problema',
                'link' => 'aquí',
            ],
        ],

        'info' => [
            'description' => 'Descripción',
            'genre' => 'Género',
            'language' => 'Idioma',
            'no_scores' => 'Los datos todavía están siendo calculados...',
            'points-of-failure' => 'Puntos de fracaso',
            'source' => 'Fuente',
            'success-rate' => 'Tasa de éxito',
            'tags' => 'Etiquetas',
        ],

        'scoreboard' => [
            'achieved' => 'logrado :when',
            'country' => 'Clasificación Nacional',
            'friend' => 'Clasificación entre Amigos',
            'global' => 'Clasificación Global',
            'supporter-link' => '¡Clic <a href=":link">aquí</a> para ver todas las características de lujo que ofrece!',
            'supporter-only' => '¡Debe ser un osu!supporter para acceder a las clasificaciones nacionales y entre amigos!',
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
                'time' => 'Tiempo',
            ],

            'no_scores' => [
                'country' => '¡Nadie de tu país ha marcado una puntuación en este mapa aún!',
                'friend' => '¡Ninguno de tus amigos ha marcado una puntuación en este mapa aún!',
                'global' => 'Sin puntuaciones aún. ¿Tal vez deberías intentar establecer alguna?',
                'loading' => 'Cargando puntuaciones...',
                'unranked' => 'Mapa no clasificado.',
            ],
            'score' => [
                'first' => 'Liderando',
                'own' => 'Tu mejor puntuación',
            ],
        ],

        'stats' => [
            'cs' => 'Tamaño del círculo',
            'cs-mania' => 'Cantidad de teclas',
            'drain' => 'Drenado de HP',
            'accuracy' => 'Precisión',
            'ar' => 'Velocidad de aproximación',
            'stars' => 'Estrellas de dificultad',
            'total_length' => 'Duración (Duración del drenaje: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Número de círculos',
            'count_sliders' => 'Número de deslizadores',
            'user-rating' => 'Valoración de los usuarios',
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
