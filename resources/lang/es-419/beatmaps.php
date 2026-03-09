<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_ruleset' => 'Modo de juego especificado no válido.',

    'change_owner' => [
        'too_many' => 'Demasiados mappers invitados.',
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Error al actualizar los votos',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'permitir kudosu',
        'beatmap_information' => 'Página del mapa',
        'delete' => 'eliminar',
        'deleted' => 'Eliminado por :editor :delete_time.',
        'deny_kudosu' => 'negar kudosu',
        'edit' => 'editar',
        'edited' => 'Última vez editado por :editor :update_time.',
        'guest' => 'Dificultad de invitado por :user',
        'kudosu_denied' => 'Negado de obtener kudosu.',
        'message_placeholder_deleted_beatmap' => 'Esta dificultad ha sido eliminada, por lo que ya no puede ser discutida.',
        'message_placeholder_locked' => 'La discusión para este mapa ha sido desactivada.',
        'message_placeholder_silenced' => "No puedes publicar una discusión mientras estés silenciado.",
        'message_type_select' => 'Seleccionar tipo de comentario',
        'reply_notice' => 'Presiona enter para responder.',
        'reply_resolve_notice' => 'Presiona enter para responder. Presiona ctrl+enter para responder y resolver.',
        'reply_placeholder' => 'Escribe tu respuesta aquí',
        'require-login' => 'Inicia sesión para publicar o responder',
        'resolved' => 'Resuelto',
        'restore' => 'restaurar',
        'show_deleted' => 'Mostrar eliminados',
        'title' => 'Discusiones',
        'unresolved_count' => ':count_delimited problemas sin resolver',

        'collapse' => [
            'all-collapse' => 'Contraer todo',
            'all-expand' => 'Expandir todo',
        ],

        'empty' => [
            'empty' => '¡Aún no hay discusiones!',
            'hidden' => 'Ninguna discusión coincide con el filtro seleccionado.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Bloquear discusión',
                'unlock' => 'Desbloquear discusión',
            ],

            'prompt' => [
                'lock' => 'Motivo del bloqueo',
                'unlock' => '¿Seguro que quieres desbloquearla?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Esta publicación irá a la discusión general del mapa. Para modear esta dificultad, empieza un mensaje con una marca de tiempo (por ejemplo, 00:12:345).',
            'in_timeline' => 'Para modear varias marcas de tiempo, publica varias veces (un mensaje por marca de tiempo).',
        ],

        'message_placeholder' => [
            'general' => 'Escribe aquí para publicar en General (:version)',
            'generalAll' => 'Escribe aquí para publicar en General (Todas las dificultades)',
            'review' => 'Escribe aquí para publicar una revisión',
            'timeline' => 'Escribe aquí para publicar en Línea de tiempo (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Descalificar',
            'hype' => '¡Hype!',
            'mapper_note' => 'Nota',
            'nomination_reset' => 'Restablecimiento de nominación',
            'praise' => 'Elogio',
            'problem' => 'Problema',
            'problem_warning' => 'Informar un problema',
            'review' => 'Revisión',
            'suggestion' => 'Sugerencia',
        ],

        'message_type_title' => [
            'disqualify' => 'Publicar descalificación',
            'hype' => '¡Publicar hype!',
            'mapper_note' => 'Publicar nota',
            'nomination_reset' => 'Eliminar todas las nominaciones',
            'praise' => 'Publicar elogio',
            'problem' => 'Publicar problema',
            'problem_warning' => 'Publicar problema',
            'review' => 'Publicar revisión',
            'suggestion' => 'Publicar sugerencia',
        ],

        'mode' => [
            'events' => 'Historial',
            'general' => 'General :scope',
            'reviews' => 'Revisiones',
            'timeline' => 'Línea de tiempo',
            'scopes' => [
                'general' => 'Esta dificultad',
                'generalAll' => 'Todas las dificultades',
            ],
        ],

        'new' => [
            'pin' => 'Fijar',
            'timestamp' => 'Marca de tiempo',
            'timestamp_missing' => '¡utiliza ctrl-c en el modo de edición y pega tu mensaje para añadir una marca de tiempo!',
            'title' => 'Nueva discusión',
            'unpin' => 'Desfijar',
        ],

        'review' => [
            'new' => 'Nueva revisión',
            'embed' => [
                'delete' => 'Eliminar',
                'missing' => '[DISCUSIÓN ELIMINADA]',
                'unlink' => 'Desvincular',
                'unsaved' => 'Sin guardar',
                'timestamp' => [
                    'all-diff' => 'Las publicaciones en «Todas las dificultades» no pueden tener marcas de tiempo.',
                    'diff' => 'Si esta publicación empieza con una marca de tiempo, se mostrará en la línea de tiempo.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'insertar párrafo',
                'praise' => 'insertar elogio',
                'problem' => 'insertar problema',
                'suggestion' => 'insertar sugerencia',
            ],
        ],

        'show' => [
            'title' => ':title mapeado por :mapper',
        ],

        'sort' => [
            'created_at' => 'Tiempo de creación',
            'timeline' => 'Línea de tiempo',
            'updated_at' => 'Última actualización',
        ],

        'stats' => [
            'deleted' => 'Eliminado',
            'mapper_notes' => 'Notas',
            'mine' => 'Mío',
            'pending' => 'Pendiente',
            'praises' => 'Elogios',
            'resolved' => 'Resuelto',
            'total' => 'Todo',
        ],

        'status-messages' => [
            'approved' => '¡Este mapa fue aprobado el :date!',
            'graveyard' => "Este mapa no ha sido actualizado desde el :date por lo que fue abandonado...",
            'loved' => '¡Este mapa se añadió a amados el :date!',
            'ranked' => '¡Este mapa fue clasificado el :date!',
            'wip' => 'Nota: Este mapa fue marcado como trabajo en proceso por el creador.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Aún no hay votos negativos',
                'up' => 'Aún no hay votos positivos',
            ],
            'latest' => [
                'down' => 'Últimos votos negativos',
                'up' => 'Últimos votos positivos',
            ],
        ],
    ],

    'hype' => [
        'button' => '¡Hypear este mapa!',
        'button_done' => '¡Hypeado!',
        'confirm' => "¿Estás seguro? Esto usará uno de tus :n hypes restantes y no se puede deshacer.",
        'explanation' => '¡Hypea este mapa para hacerlo más visible para la nominación y la clasificación!',
        'explanation_guest' => '¡Inicia sesión y hypea este mapa para hacerlo más visible para la nominación y la clasificación!',
        'new_time' => "Obtendrás otro hype en :new_time.",
        'remaining' => 'Te quedan :remaining hypes.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Tren del hype',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Deja tu comentario',
    ],

    'nominations' => [
        'already_nominated' => 'Ya has nominado este mapa.',
        'cannot_nominate' => 'No puedes nominar este modo de juego del mapa.',
        'delete' => 'Eliminar',
        'delete_own_confirm' => '¿Estás seguro? Este mapa será eliminado y se te redirigirá de vuelta a tu perfil.',
        'delete_other_confirm' => '¿Estás seguro? El mapa será eliminado y se te redirigirá de vuelta al perfil del usuario.',
        'disqualification_prompt' => '¿Motivo de la descalificación?',
        'disqualified_at' => 'Descalificado :time_ago (:reason).',
        'disqualified_no_reason' => 'motivo no especificado',
        'disqualify' => 'Descalificar',
        'incorrect_state' => 'Se ha producido un error al realizar esa acción, intenta actualizar la página.',
        'love' => 'Amar',
        'love_choose' => 'Elige la dificultad para amado',
        'love_confirm' => '¿Amar este mapa?',
        'nominate' => 'Nominar',
        'nominate_confirm' => '¿Nominar este mapa?',
        'nominated_by' => 'nominado por :users',
        'not_enough_hype' => "No hay suficiente hype.",
        'remove_from_loved' => 'Eliminar de amados',
        'remove_from_loved_prompt' => 'Motivo para eliminarlo de amado:',
        'required_text' => 'Nominaciones: :current/:required',
        'reset_message_deleted' => 'eliminado',
        'title' => 'Estado de nominación',
        'unresolved_issues' => 'Todavía hay problemas sin resolver que deben abordarse primero.',

        'rank_estimate' => [
            '_' => 'Se estima que este mapa se clasificará :date si no se encuentran problemas. Es el número :position en la :queue.',
            'unresolved_problems' => 'Este mapa no puede salir de la sección de calificados hasta que se resuelvan :problems.',
            'problems' => 'estos problemas',
            'on' => 'el :date',
            'queue' => 'cola de clasificación',
            'soon' => 'pronto',
        ],

        'reset_at' => [
            'nomination_reset' => 'El proceso de nominación se ha restablecido :time_ago por :user a causa del nuevo problema :discussion (:message).',
            'disqualify' => 'Descalificado :time_ago por :user a causa del nuevo problema :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => '¿Estás seguro? Esto sacará el mapa de la calificación y restablecerá el proceso de nominación.',
            'nomination_reset' => '¿Estás seguro? Publicar un nuevo problema restablecerá todas las nominaciones.',
            'problem_warning' => '¿Seguro que quieres reportar un problema en este mapa? Esto alertará a los Beatmap Nominators.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'escribe en palabras clave...',
            'login_required' => 'Inicia sesión para buscar.',
            'options' => 'Más opciones de búsqueda',
            'rank_filter_note' => '',
            'supporter_filter' => 'Filtrar por :filters requiere una etiqueta de osu!supporter activa',
            'not-found' => 'no hay resultados',
            'not-found-quote' => '...nop, no se encontró nada.',
            'filters' => [
                'extra' => 'Adicional',
                'general' => 'General',
                'genre' => 'Género',
                'language' => 'Idioma',
                'mode' => 'Modo',
                'nsfw' => 'Contenido explícito',
                'played' => 'Jugado',
                'rank' => 'Grado obtenido',
                'status' => 'Categorías',
            ],
            'sorting' => [
                'title' => 'Título',
                'artist' => 'Artista',
                'difficulty' => 'Dificultad',
                'favourites' => 'Favoritos',
                'updated' => 'Actualizado',
                'ranked' => 'Tiempo clasificado',
                'rating' => 'Valoración',
                'plays' => 'Veces jugado',
                'relevance' => 'Relevancia',
                'nominations' => 'Nominaciones',
            ],
            'supporter_filter_quote' => [
                '_' => 'Necesitas una :link activa para filtrar por :filters',
                'link_text' => 'etiqueta de osu!supporter',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Incluir mapas convertidos',
        'featured_artists' => 'Artistas destacados',
        'follows' => 'Mappers suscritos',
        'recommended' => 'Dificultades recomendadas',
        'spotlights' => 'Mapas destacados',
    ],
    'mode' => [
        'all' => 'Todos',
        'any' => 'Cualquiera',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
        'undefined' => 'no establecido',
    ],
    'status' => [
        'any' => 'Cualquiera',
        'approved' => 'Aprobados',
        'favourites' => 'Favoritos',
        'graveyard' => 'Abandonados',
        'leaderboard' => 'Tiene tabla de clasificación',
        'loved' => 'Amados',
        'mine' => 'Mis mapas',
        'pending' => 'Pendiente',
        'wip' => 'WIP',
        'qualified' => 'Calificados',
        'ranked' => 'Clasificados',
    ],
    'genre' => [
        'any' => 'Cualquiera',
        'unspecified' => 'No especificado',
        'video-game' => 'Videojuego',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Otro',
        'novelty' => 'Novedad',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electrónica',
        'metal' => 'Metal',
        'classical' => 'Clásica',
        'folk' => 'Folk',
        'jazz' => 'Jazz',
    ],
    'language' => [
        'any' => 'Cualquiera',
        'english' => 'Inglés',
        'chinese' => 'Chino',
        'french' => 'Francés',
        'german' => 'Alemán',
        'italian' => 'Italiano',
        'japanese' => 'Japonés',
        'korean' => 'Coreano',
        'spanish' => 'Español',
        'swedish' => 'Sueco',
        'russian' => 'Ruso',
        'polish' => 'Polaco',
        'instrumental' => 'Instrumental',
        'other' => 'Otro',
        'unspecified' => 'No especificado',
    ],

    'nsfw' => [
        'exclude' => 'Ocultar',
        'include' => 'Mostrar',
    ],

    'played' => [
        'any' => 'Cualquiera',
        'played' => 'Ya jugado',
        'unplayed' => 'No jugado',
    ],
    'extra' => [
        'video' => 'Tiene video',
        'storyboard' => 'Tiene storyboard',
    ],
    'rank' => [
        'any' => 'Cualquiera',
        'XH' => 'SS plateada',
        'X' => '',
        'SH' => 'S plateada',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Veces jugado: :count',
        'favourites' => 'Favoritos: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Todas',
        ],
    ],
];
