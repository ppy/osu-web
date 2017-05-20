<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'message_placeholder' => 'Escribe aquí para publicar',
        'message_type_select' => 'Seleccionar Tipo de Comentario',
        'reply_placeholder' => 'Escribe tu respuesta aquí',
        'require-login' => 'Inicia sesión para publicar o responder',
        'resolved' => 'Resuelto',
        'restore' => 'restaurar',
        'title' => 'Discusiones',

        'collapse' => [
            'all-collapse' => 'Contraer todo.',
            'all-expand' => 'Expandir todo.',
        ],

        'empty' => [
            'empty' => '¡Aún no hay discusiones!',
            'hidden' => 'Ninguna discusión coincide con el filtro seleccionado.',
        ],

        'message_hint' => [
            'in_general' => 'Este post irá a la discusión general de beatmaps. Para moddear este beatmap, empieza un mensaje con marca de tiempo (ejemplo: 00:12:345).',
            'in_timeline' => 'Para moddear multiples lineas de tiempo, escríbelas múltiples veces (una publicación por marca de tiempo).',
        ],

        'message_type' => [
            'praise' => 'Elogio',
            'problem' => 'Problema',
            'suggestion' => 'Sugerencia',
        ],

        'mode' => [
            'general' => 'General',
            'timeline' => 'Línea de tiempo',
        ],

        'new' => [
            'timestamp' => 'Marca de tiempo',
            'timestamp_missing' => '¡Usa Ctrl + C en el modo de edición y pega en tu mensaje para añadir una marca de tiempo!',
            'title' => 'Nueva Discusión',
        ],

        'show' => [
            'title' => ':title mappeado por :mapper',
        ],

        'stats' => [
            'deleted' => 'Eliminado',
            'mine' => 'Propio', // I'm not aware of the context of this string, I tried from other translations (like FR) but it was the same...
            'pending' => 'Pendiente',
            'praises' => 'Elogios',
            'resolved' => 'Resuelto',
            'total' => 'Total',
        ],
    ],

    'nominations' => [
        'disqualifed-at' => 'descalificado :time_ago (:reason).',
        'disqualifed_no_reason' => 'motivo no especificado',
        'disqualification-prompt' => '¿Motivo de descalificación?',
        'disqualify' => 'Descalificar',
        'incorrect-state' => 'Error al realizar esa acción, intenta recargando la página.',
        'nominate' => 'Nominar',
        'nominate-confirm' => '¿Nominar este beatmap?',
        'qualified' => 'Se estima que será rankeado :date, si no se encuentra ningún problema.',
        'qualified-soon' => 'Se estima que será rankeado pronto, si no se encuentra ningún problema.',
        'required-text' => 'Nominaciones: :current/:required',
        'title' => 'Estado de Nominación',
    ],

    'listing' => [
        'search' => [
            'prompt' => 'escribe en palabras clave...',
            'options' => 'Más opciones de búsqueda',
            'not-found' => 'no hay resultados',
            'not-found-quote' => '... nope, nada encontrado.',
        ],
        'mode' => 'Modo',
        'status' => 'Estado de Rank',
        'mapped-by' => 'mappeado por :mapper',
        'source' => 'de :source',
        'load-more' => 'Cargar más...',
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
        'loved' => 'Amados',
        'faves' => 'Favoritos',
        'modreqs' => 'Solicitan mod',
        'pending' => 'Pendientes',
        'graveyard' => 'Cementerio',
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
        'NM' => 'No mods',
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
