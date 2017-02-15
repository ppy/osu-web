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
            'error' => 'No se ha podido guardar el post.',
        ],
    ],
    'discussion-votes' => [
        'update' => [
            'error' => 'Error al actualizar los votos.',
        ],
    ],
    'discussions' => [
        'collapse' => [
            'all-collapse' => 'Contraer todo.',
            'all-expand' => 'Expandir todo.',
        ],
        'edit' => 'editar',
        'edited' => 'Última edición por :editor :update_time',
        'empty' => [
            'empty' => '¡Aún no hay discusiones!',
            'filtered' => 'Ninguna discusión coincide con el filtro seleccionado.',
        ],
        'message_hint' => [
            'in_general' => 'Este post irá a la discusión general de beatmapset. Para moddear este beatmap, empieza un mensaje con linea de tiempo (ejemplo: 00:12:345).',
            'in_timeline' => 'Para moddear multiples lineas de tiempo, escríbelas múltiples veces (un post por linea de tiempo).',
        ],
        'message_placeholder' => 'Escribe aquí para postear',
        'message_type' => [
            'praise' => 'Elogio',
            'problem' => 'Problema',
            'suggestion' => 'Sugerencia',
        ],
        'message_type_select' => 'Selecciona un tipo de comentario',
        'mode' => [
            'general' => 'General',
            'timeline' => 'Línea de tiempo',
        ],
        'require-login' => 'Inicia sesión para postear o responder',
        'resolved' => 'Resuelto',
        'show' => [
            'title' => 'Discusión de Beatmap',
        ],
        'stats' => [
            'pending' => 'Pendiente',
            'praises' => 'Elogios',
            'resolved' => 'Resuelto',
            'total' => 'Total',
        ],
    ],
    'listing' => [
        'search' => [
            'prompt' => 'escribe en palabras clave...',
            'options' => 'Más Opciones de Búsqueda',
            'not-found' => 'no hay resultados.',
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
        'faves' => 'Favoritos',
        'modreqs' => 'Solicitan Mod',
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
        'novelty' => 'Novedoso',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electrónica',
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
