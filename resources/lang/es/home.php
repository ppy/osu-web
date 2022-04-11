<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Descargar ahora',
        'online' => '<strong>:players</strong> actualmente en línea en <strong>:games</strong> partidas',
        'peak' => 'Pico, :count usuarios en línea',
        'players' => '<strong>:count</strong> usuarios registrados',
        'title' => 'bienvenido',
        'see_more_news' => 'ver más novedades',

        'slogan' => [
            'main' => 'el mejor juego de ritmo gratis',
            'sub' => 'el ritmo está a un solo clic de distancia',
        ],
    ],

    'search' => [
        'advanced_link' => 'Búsqueda avanzada',
        'button' => 'Buscar',
        'empty_result' => '¡No se ha encontrado nada!',
        'keyword_required' => 'Se requiere una palabra clave de búsqueda',
        'placeholder' => 'escriba para buscar',
        'title' => 'buscar',

        'beatmapset' => [
            'login_required' => 'Inicie sesión para buscar mapas',
            'more' => 'Hay :count mapas más en los resultados',
            'more_simple' => 'Ver más resultados de mapas',
            'title' => 'Mapas',
        ],

        'forum_post' => [
            'all' => 'Todos los foros',
            'link' => 'Busca en el foro',
            'login_required' => 'Inicie sesión para buscar en el foro',
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
            'beatmapset' => 'mapa',
            'forum_post' => 'foro',
            'user' => 'jugador',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'Inicie sesión para buscar usuarios',
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

        'help' => [
            '_' => 'si tiene problemas para iniciar el juego o para obtener una cuenta, :help_forum_link o :support_button.',
            'help_forum_link' => 'consulte el foro de ayuda',
            'support_button' => 'contacte al soporte técnico',
        ],

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
        'video-guide' => 'guía en vídeo',
    ],

    'user' => [
        'title' => 'panel',
        'news' => [
            'title' => 'Novedades',
            'error' => 'Error al cargar las novedades, ¿intente actualizar la página?...',
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
];
