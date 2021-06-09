<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Error al actualizar los votos.',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'permitir kudosu',
        'beatmap_information' => 'Página del mapa',
        'delete' => 'eliminar',
        'deleted' => 'Eliminado por :editor :delete_time',
        'deny_kudosu' => 'negar kudosu',
        'edit' => 'editar',
        'edited' => 'Última edición por :editor :update_time',
        'guest' => 'Dificultad de invitado por :user',
        'kudosu_denied' => 'Negado de obtener kudosu.',
        'message_placeholder_deleted_beatmap' => 'Esta dificultad ha sido eliminada, por lo que ya no puede ser discutida.',
        'message_placeholder_locked' => 'La discusión para este mapa ha sido desactivada.',
        'message_placeholder_silenced' => "No puede publicar una discusión mientras esté silenciado.",
        'message_type_select' => 'Seleccionar tipo de comentario',
        'reply_notice' => 'Presione enter para responder.',
        'reply_placeholder' => 'Escriba su respuesta aquí',
        'require-login' => 'Inicia sesión para publicar o responder',
        'resolved' => 'Resuelto',
        'restore' => 'restaurar',
        'show_deleted' => 'Mostrar eliminados',
        'title' => 'Discusiones',

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
                'unlock' => '¿Seguro que desea desbloquearla?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Esta publicación irá a la discusión general del set de mapas. Para moddear este mapa, empieza un mensaje con una marca de tiempo (por ejemplo, 00:12:345).',
            'in_timeline' => 'Para moddear varias marcas de tiempo, publique varias veces (un mensaje por marca de tiempo).',
        ],

        'message_placeholder' => [
            'general' => 'Escriba aquí para publicar en General (:version)',
            'generalAll' => 'Escriba aquí para publicar en General (Todas las dificultades)',
            'review' => 'Escriba aquí para publicar una revisión',
            'timeline' => 'Escriba aquí para publicar en la Línea de tiempo (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Descalificación',
            'hype' => '¡Hype!',
            'mapper_note' => 'Nota',
            'nomination_reset' => 'Restablecimiento de nominación',
            'praise' => 'Elogio',
            'problem' => 'Problema',
            'review' => 'Revisión',
            'suggestion' => 'Sugerencia',
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
            'pin' => 'Anclar',
            'timestamp' => 'Marca de tiempo',
            'timestamp_missing' => '¡Usa Ctrl+C en el modo de edición y pega tu mensaje para agregar una marca de tiempo!',
            'title' => 'Nueva discusión',
            'unpin' => 'Desanclar',
        ],

        'review' => [
            'new' => 'Nueva revisión',
            'embed' => [
                'delete' => 'Eliminar',
                'missing' => '[DISCUSIÓN ELIMINADA]',
                'unlink' => 'Desvincular',
                'unsaved' => 'No guardado',
                'timestamp' => [
                    'all-diff' => 'Las publicaciones en "Todas las dificultades" no pueden tener marcas de tiempo.',
                    'diff' => 'Si el comentario de :type empieza con una marca de tiempo, se mostrará en la Línea de tiempo.',
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
            'loved' => '¡Este mapa fue agregado a Amados el :date!',
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
        'confirm' => "¿Está seguro? Esto usará uno de sus :n hype restantes y no puede deshacerse.",
        'explanation' => '¡Hypea este mapa para hacerlo más visible para la nominación y la clasificación!',
        'explanation_guest' => '¡Inicia sesión y hypea este mapa para hacerlo más visible para la nominación y la clasificación!',
        'new_time' => "Obtendrás otro hype :new_time.",
        'remaining' => 'Te quedan :remaining Hypes.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Tren del hype',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Dejar comentarios',
    ],

    'nominations' => [
        'delete' => 'Eliminar',
        'delete_own_confirm' => '¿Está seguro? El mapa será eliminado y serás redirigido de vuelta a tu perfil.',
        'delete_other_confirm' => '¿Está seguro? El mapa será eliminado y serás redirigido de vuelta al perfil de usuario.',
        'disqualification_prompt' => '¿Motivo de la descalificación?',
        'disqualified_at' => 'Descalificado :time_ago (:reason).',
        'disqualified_no_reason' => 'motivo no especificado',
        'disqualify' => 'Descalificar',
        'incorrect_state' => 'Error al realizar esa acción, intente actualizar la página.',
        'love' => 'Amar',
        'love_confirm' => '¿Te gusta este mapa?',
        'nominate' => 'Nominar',
        'nominate_confirm' => '¿Nominar este mapa?',
        'nominated_by' => 'nominado por :users',
        'not_enough_hype' => "No hay suficiente hype.",
        'remove_from_loved' => 'Remover de Amados',
        'remove_from_loved_prompt' => 'Motivo para remover de Amados:',
        'required_text' => 'Nominaciones: :current/:required',
        'reset_message_deleted' => 'eliminado',
        'title' => 'Estado de nominación',
        'unresolved_issues' => 'Todavía hay problemas sin resolver que deben abordarse primero.',

        'rank_estimate' => [
            '_' => 'Se estima que este mapa se clasificará :date si no se encuentran problemas. Es el número :position en la :queue.',
            'queue' => 'cola de clasificación',
            'soon' => 'pronto',
        ],

        'reset_at' => [
            'nomination_reset' => 'El proceso de nominación se ha restablecido :time_ago por :user a causa del nuevo problema :discussion (:message).',
            'disqualify' => 'Descalificado :time_ago por :user a causa del nuevo problema :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => '¿Está seguro? Publicar un nuevo problema restablecerá el proceso de nominación.',
            'disqualify' => '¿Está seguro? Esto eliminará el mapa de la calificación y restablecerá el proceso de nominación.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'escriba en palabras clave...',
            'login_required' => 'Inicie sesión para buscar.',
            'options' => 'Más opciones de búsqueda',
            'supporter_filter' => 'Filtrar por :filters requiere un tag activo de osu!supporter',
            'not-found' => 'no hay resultados',
            'not-found-quote' => '... nop, nada encontrado.',
            'filters' => [
                'extra' => 'Adicional',
                'general' => 'General',
                'genre' => 'Género',
                'language' => 'Idioma',
                'mode' => 'Modo',
                'nsfw' => 'Contenido explícito',
                'played' => 'Jugado',
                'rank' => 'Rango obtenido',
                'status' => 'Categorías',
            ],
            'sorting' => [
                'title' => 'Título',
                'artist' => 'Artista',
                'difficulty' => 'Dificultad',
                'favourites' => 'Favoritos',
                'updated' => 'Actualizado',
                'ranked' => 'Tiempo clasificado',
                'rating' => 'Calificación',
                'plays' => 'Veces jugado',
                'relevance' => 'Relevancia',
                'nominations' => 'Nominaciones',
            ],
            'supporter_filter_quote' => [
                '_' => 'Necesitas un :link activo para filtrar por :filters',
                'link_text' => 'tag de osu!supporter',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Incluir mapas convertidos',
        'follows' => 'Mapeadores suscritos',
        'recommended' => 'Dificultades recomendadas',
    ],
    'mode' => [
        'all' => 'Todos',
        'any' => 'Cualquier',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Cualquier',
        'approved' => 'Aprobados',
        'favourites' => 'Favoritos',
        'graveyard' => 'Abandonados',
        'leaderboard' => 'Tiene tablas de clasificación',
        'loved' => 'Amados',
        'mine' => 'Mis mapas',
        'pending' => 'Pendiente y trabajo en progreso',
        'qualified' => 'Calificados',
        'ranked' => 'Clasificados',
    ],
    'genre' => [
        'any' => 'Cualquier',
        'unspecified' => 'no especificado',
        'video-game' => 'videojuego',
        'anime' => 'anime',
        'rock' => 'rock',
        'pop' => 'pop',
        'other' => 'otro',
        'novelty' => 'novedad',
        'hip-hop' => 'hip hop',
        'electronic' => 'electrónica',
        'metal' => 'metal',
        'classical' => 'clásica',
        'folk' => 'folk',
        'jazz' => 'jazz',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => 'Relax',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => 'Puntuación V2',
    ],
    'language' => [
        'any' => 'Cualquiera',
        'english' => 'inglés',
        'chinese' => 'chino',
        'french' => 'francés',
        'german' => 'alemán',
        'italian' => 'italiano',
        'japanese' => 'japonés',
        'korean' => 'coreano',
        'spanish' => 'español',
        'swedish' => 'sueco',
        'russian' => 'ruso',
        'polish' => 'polaco',
        'instrumental' => 'instrumental',
        'other' => 'otro',
        'unspecified' => 'no especificado',
    ],

    'nsfw' => [
        'exclude' => 'Esconder',
        'include' => 'Mostrar',
    ],

    'played' => [
        'any' => 'Cualquier',
        'played' => 'Ya jugado',
        'unplayed' => 'No jugado',
    ],
    'extra' => [
        'video' => 'Contiene vídeo',
        'storyboard' => 'Contiene storyboard',
    ],
    'rank' => [
        'any' => 'Cualquier',
        'XH' => 'SS Plateada',
        'X' => '',
        'SH' => 'S Plateada',
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
