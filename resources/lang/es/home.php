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
        'placeholder' => 'escribe para buscar',
        'title' => 'buscar',

        'artist_track' => [
            'more_simple' => 'Ver más resultados de las canciones de los artistas destacados',
        ],
        'beatmapset' => [
            'login_required' => 'Inicia sesión para buscar mapas',
            'more' => 'Hay :count mapas más en los resultados',
            'more_simple' => 'Ver más resultados de mapas',
            'title' => 'Mapas',
        ],

        'forum_post' => [
            'all' => 'Todos los foros',
            'link' => 'Busca en el foro',
            'login_required' => 'Inicia sesión para buscar en el foro',
            'more_simple' => 'Ver más resultados de los foros',
            'title' => 'Foro',

            'label' => [
                'forum' => 'buscar en los foros',
                'forum_children' => 'incluir subforos',
                'include_deleted' => 'incluir publicaciones eliminadas',
                'topic_id' => 'tema #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'todos',
            'artist_track' => 'artistas destacados',
            'beatmapset' => 'mapa',
            'forum_post' => 'foro',
            'team' => 'equipos',
            'user' => 'jugador',
            'wiki_page' => 'wiki',
        ],

        'team' => [
            'login_required' => '',
            'more_simple' => 'Ver más resultados de equipos',
        ],

        'user' => [
            'login_required' => 'Inicia sesión para buscar usuarios',
            'more' => ':count jugadores más coinciden con la búsqueda',
            'more_simple' => 'Ver más resultados de jugadores',
            'more_hidden' => 'La búsqueda de jugadores está limitada a :max jugadores. Intenta refinar tus términos de búsqueda.',
            'title' => 'Jugadores',
        ],

        'wiki_page' => [
            'link' => 'Busca en la wiki',
            'more_simple' => 'Ver más resultados de la wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'action_lazer_info' => 'revisa esta página para más información',
        'download' => 'Descargar',
        'for_os' => 'para :os',
        'macos-fallback' => 'usuarios de macOS',
        'mirror' => 'enlace alternativo',
        'or' => 'o',
        'os_version_or_later' => ':os_version o posterior',
        'other_os' => 'otras plataformas',
        'quick_start_guide' => 'guía de inicio rápido',
        'stable_text' => 'por si estás buscando el antiguo',
        'tagline_1' => '¡Vamos a',
        'tagline_2' => 'empezar!',
        'video-guide' => 'guía en vídeo',

        'help' => [
            '_' => 'si tienes problemas para iniciar el juego o para obtener una cuenta, :help_forum_link o :support_button.',
            'help_forum_link' => 'consulta el foro de ayuda',
            'support_button' => 'contacta al soporte',
        ],

        'os' => [
            'windows' => 'para Windows',
            'macos' => 'para macOS',
            'linux' => 'para Linux',
        ],
        'steps' => [
            'register' => [
                'title' => 'obtener una cuenta',
                'description' => 'sigue las instrucciones cuando inicies el juego para iniciar sesión o crear una nueva cuenta',
            ],
            'download' => [
                'title' => 'instalar el juego',
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
    ],

    'user' => [
        'title' => 'panel',
        'news' => [
            'title' => 'Novedades',
            'error' => 'Error al cargar las novedades, ¿prueba a actualizar la página?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Amigos en línea',
                'games' => 'Partidas',
                'online' => 'Usuarios en línea',
            ],
        ],
        'beatmaps' => [
            'daily_challenge' => 'Mapa del desafío diario',
            'new' => 'Nuevos mapas clasificados',
            'popular' => 'Mapas populares',
            'by_user' => 'por :user',
            'resets' => 'nuevo mapa :ends',
        ],
        'buttons' => [
            'download' => 'Descargar osu!',
            'support' => 'Apoyar a osu!',
            'store' => 'osu!store',
        ],
        'livestream' => [
            'title' => '',
        ],
        'show' => [
            'admin' => [
                'page' => 'Abrir la consola de administración',
            ],
        ],
    ],
];
