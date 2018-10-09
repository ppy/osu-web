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
    'discussion-posts' => [
        'store' => [
            'error' => 'Error al guardar la publicación',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Error al actualizar los votos.',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'permitir kudosu',
        'delete' => 'eliminar',
        'deleted' => 'Eliminado por :editor :delete_time',
        'deny_kudosu' => 'denegar kudosu',
        'edit' => 'editar',
        'edited' => 'Última edición por :editor :update_time',
        'kudosu_denied' => 'Negado de obtener kudosu.',
        'message_placeholder_deleted_beatmap' => 'Esta dificultad se ha eliminado, por lo que ya puede ser discutida.',
        'message_type_select' => 'Seleccionar tipo de comentario',
        'reply_notice' => 'Presione enter para responder.',
        'reply_placeholder' => 'Escribe tu respuesta aquí',
        'require-login' => 'Inicia sesión para publicar o responder',
        'resolved' => 'Resuelto',
        'restore' => 'restaurar',
        'title' => 'Discusiones',

        'collapse' => [
            'all-collapse' => 'Desplegar todo',
            'all-expand' => 'Expandir todo',
        ],

        'empty' => [
            'empty' => '¡Sin discusiones aún!',
            'hidden' => 'Ninguna discusión coincide con el filtro seleccionado.',
        ],

        'message_hint' => [
            'in_general' => 'Esta publicación irá a la discusión general del Beatmapset. Para modificar este Beatmap, comienca el mensaje con una marca de tiempo (Ej: 00:12:345).',
            'in_timeline' => 'Para modificar varias marcas de tiempo, publíca varias veces (una publicación por marca de tiempo).',
        ],

        'message_placeholder' => [
            'general' => 'Escribe aquí para publicar en General (:version)',
            'generalAll' => 'Escribe aquí para publicar en General (todas las dificultades)',
            'timeline' => 'Escribe aquí para publicar en la Línea de tiempo (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Descalificación',
            'hype' => '¡Hype!',
            'mapper_note' => 'Nota',
            'nomination_reset' => 'Reiniciar Nominación',
            'praise' => 'Elogio',
            'problem' => 'Problema',
            'suggestion' => 'Sugerencia',
        ],

        'mode' => [
            'events' => 'Historial',
            'general' => 'General :scope',
            'timeline' => 'Línea de tiempo',
            'scopes' => [
                'general' => 'Esta dificultad',
                'generalAll' => 'Todas las dificultades',
            ],
        ],

        'new' => [
            'timestamp' => 'Marca de tiempo',
            'timestamp_missing' => '¡Usa Ctrl+C en el modo de edición y pega tu mensaje para agregar una marca de tiempo!',
            'title' => 'Nueva Discusión',
        ],

        'show' => [
            'title' => ':title mappeado por :mapper',
        ],

        'sort' => [
            '_' => 'Ordenado por:',
            'created_at' => 'tiempo de creación',
            'timeline' => 'línea de tiempo',
            'updated_at' => 'última actualización',
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
            'approved' => '¡Este beatmap fue aprobado el :date!',
            'graveyard' => "Este beatmap no se ha actualizado desde el :date y muy probablemente haya sido abandonado por el creador...",
            'loved' => '¡Este Beatmap fue agregado a Amados el :date!',
            'ranked' => '¡Este Beatmap fue rankeado el :date!',
            'wip' => 'Nota: Este Beatmap fue marcado como trabajo en proceso por el creador.',
        ],

    ],

    'hype' => [
        'button' => '¡Hypear este Beatmap!',
        'button_done' => '¡Hypeado!',
        'confirm' => "¿Estás seguro? Esto usará uno de tus :n Hype restantes y no se puede deshacer.",
        'explanation' => '¡Hypea este Beatmap para hacerlo más visible para la nominación y el ranking!',
        'explanation_guest' => '¡Inicia sesión y Hypea este Beatmap para hacerlo más visible para la nominación y el ranking!',
        'new_time' => "Obtendrás otro hype :new_time.",
        'remaining' => 'Te quedan :remaining Hypes.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Tren del Hype',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Dejar comentarios',
    ],

    'nominations' => [
        'disqualification_prompt' => '¿Motivo de la descalificación?',
        'disqualified_at' => 'Descalificado :time_ago (:reason).',
        'disqualified_no_reason' => 'motivo no especificado',
        'disqualify' => 'Descalificar',
        'incorrect_state' => 'Error al realizar esa acción, intente actualizando la página.',
        'love' => '',
        'love_confirm' => '',
        'nominate' => 'Nominar',
        'nominate_confirm' => '¿Nominar este Beatmap?',
        'nominated_by' => 'nominado por :users',
        'qualified' => 'Se estima que será rankeado el :date, si no se encuentra ningún problema.',
        'qualified_soon' => 'Se estima que será rankeado pronto, si no se encuentra ningún problema.',
        'required_text' => 'Nominaciones: :current/:required',
        'reset_message_deleted' => 'eliminado',
        'title' => 'Estado de Nominación',
        'unresolved_issues' => 'Todavía hay problemas sin resolver que deben abordarse primero.',

        'reset_at' => [
            'nomination_reset' => 'Reinicio del proceso de nominación: time_ago por: usuario a causa de un nuevo problema :discusión (:mensaje).',
            'disqualify' => 'Descalificado :time_ago por :user a causa del nuevo problema :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => '¿Estás seguro? Publicar un nuevo problema reiniciará todas las nominaciones.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'escribe en palabras clave...',
            'login_required' => 'Inicia sesión para buscar.',
            'options' => 'Más opciones de búsqueda',
            'supporter_filter' => 'Filtrar por :filters requiere un tag activo de osu!supporter',
            'not-found' => 'no hay resultados',
            'not-found-quote' => '...nop, nada encontrado.',
            'filters' => [
                'general' => 'General',
                'mode' => 'Modo',
                'status' => 'Categorías',
                'genre' => 'Género',
                'language' => 'Idioma',
                'extra' => 'Adicional',
                'rank' => 'Rango conseguido',
                'played' => 'Jugado',
            ],
            'sorting' => [
                'title' => 'título',
                'artist' => 'artista',
                'difficulty' => 'dificultad',
                'updated' => 'actualizado',
                'ranked' => 'rankeado',
                'rating' => 'calificación',
                'plays' => 'veces jugadas',
                'relevance' => 'relevancia',
                'nominations' => 'nominaciones',
            ],
            'supporter_filter_quote' => [
                '_' => 'Necesitas un :link activo para filtrar por :filters',
                'link_text' => 'tag de osu!supporter',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Dificultades recomendadas',
        'converts' => 'Incluir beatmaps convertidos',
    ],
    'mode' => [
        'any' => 'Cualquiera',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Cualquiera',
        'ranked-approved' => 'Rankeados y Aprobados',
        'approved' => 'Aprobados',
        'qualified' => 'Calificados',
        'loved' => 'Amados',
        'faves' => 'Favoritos',
        'pending' => '',
        'graveyard' => 'Abandonados',
        'my-maps' => 'Mis mapas',
    ],
    'genre' => [
        'any' => 'Cualquiera',
        'unspecified' => 'Sin especificar',
        'video-game' => 'Videojuego',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Otro',
        'novelty' => 'Novedad',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electrónica',
    ],
    'mods' => [
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        '9K' => '9K',
        'AP' => 'Auto Pilot',
        'DT' => 'Doble Time',
        'EZ' => 'Easy Mode',
        'FI' => 'Fade In',
        'FL' => 'Flashlight',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'Sin mods',
        'PF' => 'Perfecto',
        'Relax' => 'Relax',
        'SD' => 'Muerte Súbita',
        'SO' => 'Spun Out',
        'TD' => 'Dispositivo touch',
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
        'instrumental' => 'Instrumental',
        'other' => 'Otro',
    ],
    'played' => [
        'any' => 'Cualquiera',
        'played' => 'Jugado',
        'unplayed' => 'No jugado',
    ],
    'extra' => [
        'video' => 'Contiene video',
        'storyboard' => 'Contiene storyboard',
    ],
    'rank' => [
        'any' => 'Cualquiera',
        'XH' => 'SS Plateada',
        'X' => 'SS',
        'SH' => 'S Plateada',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
