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
    'landing' => [
        'download' => 'Descargar ahora',
        'online' => '<strong>:players</strong> actualmente en línea en <strong>:games</strong> partidas',
        'peak' => ':count usuarios en línea',
        'players' => '<strong>:count</strong> usuarios registrados',

        'slogan' => [
            'main' => 'juego de ritmo gratis',
            'sub' => 'el ritmo está solo a un clic de distancia',
        ],
    ],

    'search' => [
        'advanced_link' => 'Búsqueda avanzada',
        'button' => 'Buscar',
        'empty_result' => '¡No se ha encontrado nada!',
        'missing_query' => 'Cada palabra clave requiere de al menos :n carácteres',
        'title' => 'Resultados de la búsqueda',

        'beatmapset' => [
            'more' => 'Hay :count beatmaps más en los resultados',
            'more_simple' => 'Ver más resultados de beatmaps',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Todos los foros',
            'link' => 'Busca en el foro',
            'more_simple' => 'Ver más resultados de los foros',
            'title' => 'Foro',

            'label' => [
                'forum' => 'buscar en los foros',
                'forum_children' => 'incluir subforos',
                'topic_id' => 'tema #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'todos',
            'beatmapset' => 'beatmap',
            'forum_post' => 'foro',
            'user' => 'jugador',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count jugadores más coinciden con la búsqueda',
            'more_simple' => 'Ver más resultados de los jugadores',
            'more_hidden' => 'La búsqueda de jugadores está limitada a :max jugadores. Refine tus términos de búsqueda.',
            'title' => 'Jugadores',
        ],

        'wiki_page' => [
            'link' => 'Busca en la wiki',
            'more_simple' => 'Ver más resultados de la wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => '¡vamos a<br>empezar!',
        'action' => 'Descargar osu!',
        'os' => [
            'windows' => 'para Windows',
            'macos' => 'para macOS',
            'linux' => 'para Linux',
        ],
        'mirror' => 'respaldo',
        'macos-fallback' => 'usuarios de macOS',
        'steps' => [
            'register' => [
                'title' => 'crea una cuenta',
                'description' => 'sigue las instrucciones cuando empiezes el juego para iniciar sesión o crear una cuenta',
            ],
            'download' => [
                'title' => 'descarga el juego',
                'description' => 'haz clic en el botón de arriba para descargar el instalador, luego ¡ejecútalo!',
            ],
            'beatmaps' => [
                'title' => 'obtén beatmaps',
                'description' => [
                    '_' => ':browse a la gran librería de beatmaps creados por otros usuarios y ¡empieza a jugar!',
                    'browse' => 'echa un vistazo',
                ],
            ],
        ],
        'video-guide' => 'video guía',
    ],

    'user' => [
        'title' => 'panel',
        'news' => [
            'title' => 'Novedades',
            'error' => 'Error al cargar las novedades, ¿intenta refrescar la página?...',
        ],
        'header' => [
            'welcome' => '¡Hola, <strong>:username</strong>!',
            'messages' => 'Tienes 1 nuevo mensaje|Tienes :count nuevos mensajes',
            'stats' => [
                'friends' => 'Amigos en línea',
                'games' => 'Partidas',
                'online' => 'Usuarios en línea',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nuevos Beatmaps Aprobados',
            'popular' => 'Beatmaps Populares',
            'by' => 'por',
            'plays' => ':count veces jugado',
        ],
        'buttons' => [
            'download' => 'Descarga osu!',
            'support' => 'Apoya osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => '¡Wow!',
        'subtitle' => '¡Parece que estás pasando un buen rato! :D',
        'body' => [
            'part-1' => '¿Sabías que osu! está activo sin publicidad y confía en sus jugadores para apoyar su desarrollo y costos de mantenimiento?',
            'part-2' => '¿También sabías que con apoyar osu! obtienes varias funciones útiles, como <strong>descargar beatmaps dentro del juego</strong> que automáticamente se activará en partidas multijugador y de espectador?',
        ],
        'find-out-more' => '¡Haz clic para más información!',
        'download-starting' => 'Oh, y no te preocupes - la descarga ya comenzó por ti ;)',
    ],
];
