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
            'error' => 'No se ha podido guardar la publicación.',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Error al actualizar los votos.',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'otorgar kudosu',
        'delete' => 'eliminar',
        'deleted' => 'Eliminado por :editor :delete_time',
        'deny_kudosu' => 'denegar kudosu',
        'edit' => 'editar',
        'edited' => 'Última edición por :editor :update_time',
        'kudosu_denied' => 'Negado de obtener kudosu.',
        'message_placeholder' => 'Escribe aquí para publicar',
        'message_placeholder_deleted_beatmap' => 'Esta dificultad ha sido eliminada así que ya no se puede discutir.',
        'message_type_select' => 'Seleccionar Tipo de Comentario',
        'reply_notice' => 'Presiona Enter para responder.',
        'reply_placeholder' => 'Escribe tu respuesta aquí',
        'require-login' => 'Inicia sesión para publicar o responder',
        'resolved' => 'Resuelto',
        'restore' => 'restaurar',
        'title' => 'Discusiones',

        'collapse' => [
            'all-collapse' => 'Contraer todo',
            'all-expand' => 'Expandir todo',
        ],

        'empty' => [
            'empty' => '¡Aún no hay discusiones!',
            'hidden' => 'Ninguna discusión coincide con el filtro seleccionado.',
        ],

        'message_hint' => [
            'in_general' => 'Este post irá a la discusión general de beatmaps. Para moddear este beatmap, empieza un mensaje con una marca de tiempo (ejemplo: 00:12:345).',
            'in_timeline' => 'Para moddear multiples lineas de tiempo, escríbelas múltiples veces (una publicación por marca de tiempo).',
        ],

        'message_type' => [
            'hype' => '¡Hype!',
            'mapper_note' => 'Nota',
            'praise' => 'Elogio',
            'problem' => 'Problema',
            'suggestion' => 'Sugerencia',
        ],

        'mode' => [
            'events' => 'Historial',
            'general' => 'General',
            'general_all' => 'General (todas las dificultades)',
            'timeline' => 'Línea de tiempo',
        ],

        'new' => [
            'timestamp' => 'marca de tiempo',
            'timestamp_missing' => '¡Usa Ctrl + C en el modo de edición y pega en tu mensaje para añadir una marca de tiempo!',
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
            'mine' => 'Mi autoría', //This will display in discussion for the posts you made in that discussion. Using "mío" or "míos" will not work in this case
            'pending' => 'Pendiente',
            'praises' => 'Elogios',
            'resolved' => 'Resuelto',
            'total' => 'Todo',
        ],

        'status-messages' => [
            'approved' => '¡Este beatmap fue aprobado el :date!',
            'graveyard' => 'Este mapa no ha sido actualizado desde el :date y pudo haber sido abandonado por el creador...',
            'loved' => '¡Este beatmap fue marcado como amado el :date!',
            'ranked' => '¡Este beatmap fue rankeado el :date!',
            'wip' => 'Nota: Este beatmap fue marcado como trabajo en proceso por el creador.',
        ],

    ],

   'hype' => [
        'button' => '¡Hypear este beatmap!',
        'button_done' => '¡Hypeado!',
        'confirm' => '¿Estás seguro? Esto utilizará uno de tus :n hypes restantes y no podrás deshacerlo.',
        'explanation' => '¡Hypea este beatmap para hacerlo más visible para la nominación y el ranking!',
        'explanation_guest' => '¡Inicia sesión y hypea este beatmap para hacerlo más visible para la nominación y el ranking!',
        'new_time' => 'Obtendrás otro hype :new_time.',
        'remaining' => 'Te quedan :remaining hypes.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Tren del hype',
        'title' => 'Hype',
    ],

    'nominations' => [
        'disqualification_prompt' => '¿Motivo de descalificación?',
        'disqualified_at' => 'descalificado :time_ago (:reason).',
        'disqualified_no_reason' => 'motivo no especificado',
        'disqualify' => 'Descalificar',
        'incorrect_state' => 'Error al realizar esa acción, intenta recargando la página.',
        'nominate' => 'Nominar',
        'nominate_confirm' => '¿Nominar este beatmap?',
        'nominated_by' => 'nominado por :users',
        'qualified' => 'Se estima que será rankeado el :date, si no se encuentra ningún problema.',
        'qualified_soon' => 'Se estima que será rankeado pronto, si no se encuentra ningún problema',
        'required_text' => 'Nominaciones: :current/:required',
        'reset_at' => 'Las nominaciones se reiniciaron :time_ago por el nuevo problema :discussion.',
        'reset_confirm' => '¿Estás seguro? Publicar un nuevo problema reiniciará todas las nominaciones.',
        'title' => 'Estado de Nominación',
        'unresolved_issues' => 'Todavía hay problemas sin resolver que deben ser resueltos primero.',
    ],

    'feedback' => [
        'button' => 'Dejar comentarios',
    ],

    'listing' => [
        'search' => [
            'prompt' => 'escribe en palabras clave...',
            'options' => 'Más opciones de búsqueda',
            'not-found' => 'no hay resultados',
            'not-found-quote' => '...nop, nada encontrado.',
            'filters' => [
                'general' => 'General',
                'mode' => 'Modo',
                'status' => 'Estado de aprobación',
                'genre' => 'Género',
                'language' => 'Lenguaje',
                'extra' => 'Adicional',
                'rank' => 'Rango conseguido',
            ],
        ],
        'mode' => 'Modo',
        'status' => 'Estado de Rank',
        'mapped-by' => 'mappeado por :mapper',
        'source' => 'de :source',
        'load-more' => 'Cargar más...',
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
        'pending' => 'Pendientes',
        'graveyard' => 'Sepultados',
        'my-maps' => 'Mis mapas',
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
    ],
    'mods' => [
        'NF' => 'No Fail',
        'EZ' => 'Easy Mode',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'SD' => 'Sudden Death',
        'DT' => 'Double Time',
        'Relax' => 'Relax',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'FL' => 'Flashlight',
        'SO' => 'Spun Out',
        'AP' => 'Auto Pilot',
        'PF' => 'Perfect',
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        'FI' => 'Fade In',
        '9K' => '9K',
        'NM' => 'Sin mods',
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
