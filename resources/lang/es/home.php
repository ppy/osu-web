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
    'landing' => [
        'download' => 'Descargar ahora',
        'online' => '<strong>:players</strong> actualmente en línea en <strong>:games</strong> partidas',
        'peak' => ':count usuarios en línea',
        'players' => '<strong>:count</strong> usuarios registrados',
        'title' => 'bienvenido',
        'see_more_news' => 'ver más novedades',

        'slogan' => [
            'main' => 'el mejor juego de ritmo gratis',
            'sub' => 'el ritmo está solo a un clic de distancia',
        ],
    ],

    'search' => [
        'advanced_link' => 'Búsqueda avanzada',
        'button' => 'Buscar',
        'empty_result' => '¡No se ha encontrado nada!',
        'keyword_required' => 'Se requiere una palabra clave de búsqueda',
        'placeholder' => 'escribe para buscar',
        'title' => 'buscar',

        'beatmapset' => [
            'more' => 'Hay :count mapas más en los resultados',
            'more_simple' => 'Ver más resultados de mapas',
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
            'more_simple' => 'Ver más resultados de jugadores',
            'more_hidden' => 'La búsqueda de jugadores está limitada a :max jugadores. Intenta refinando tus términos de búsqueda.',
            'title' => 'Jugadores',
        ],

        'wiki_page' => [
            'link' => 'Busca en la wiki',
            'more_simple' => 'Ver más resultados de la wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "¡vamos a<br>empezar!",
        'action' => 'Descargar osu!',
        'os' => [
            'windows' => 'para Windows',
            'macos' => 'para macOS',
            'linux' => 'para Linux',
        ],
        'mirror' => 'link alternativo',
        'macos-fallback' => 'usuarios de macOS',
        'steps' => [
            'register' => [
                'title' => 'obtener una cuenta',
                'description' => 'sigue las instrucciones cuando inicies el juego para iniciar sesión o crear una nueva cuenta',
            ],
            'download' => [
                'title' => 'descargar el juego',
                'description' => 'haz clic en el botón de arriba para descargar el instalador, luego ¡ejecútalo!',
            ],
            'beatmaps' => [
                'title' => 'obtener mapas',
                'description' => [
                    '_' => ':browse a la gran biblioteca de mapas creados por otros usuarios y ¡empieza a jugar!',
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
            'error' => 'Error al cargar las novedades, ¿intenta recargando la página?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Amigos en línea',
                'games' => 'Partidas',
                'online' => 'Usuarios en línea',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nuevos Mapas Clasificados',
            'popular' => 'Mapas Populares',
            'by_user' => 'por :user',
        ],
        'buttons' => [
            'download' => 'Descargar osu!',
            'support' => 'Apoyar a osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => '¡Wow!',
        'subtitle' => '¡Pareces estar pasando un buen rato! :D',
        'body' => [
            'part-1' => '¿Sabías que osu! se mantiene sin publicidad y confía en sus jugadores para apoyar su desarrollo y costos de mantenimiento?',
            'part-2' => '¿También sabías que con apoyar osu! obtienes varias funciones útiles, como <strong>descargar beatmaps dentro del juego</strong> que automáticamente se activará en partidas multijugador y de espectador?',
        ],
        'find-out-more' => '¡Haz clic aquí para obtener más información!',
        'download-starting' => "Ah, y no te preocupes - tu descarga ya se ha iniciado para ti ;)",
    ],
];
