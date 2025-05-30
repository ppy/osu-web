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
            'more_simple' => '',
        ],
        'beatmapset' => [
            'login_required' => 'Inicia sesión para buscar mapas',
            'more' => 'Hay :count mapas más en los resultados',
            'more_simple' => 'Ver más resultados de mapas',
            'title' => 'Mapas',
        ],

        'forum_post' => [
            'all' => 'Todos los foros',
            'link' => 'Buscar en el foro',
            'login_required' => 'Inicia sesión para buscar en el foro',
            'more_simple' => 'Ver más resultados de los foros',
            'title' => 'Foro',

            'label' => [
                'forum' => 'buscar en el foro',
                'forum_children' => 'incluir subforos',
                'include_deleted' => 'incluir publicaciones eliminadas',
                'topic_id' => 'tema #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'todos',
            'artist_track' => '',
            'beatmapset' => 'mapa',
            'forum_post' => 'foro',
            'team' => '',
            'user' => 'jugador',
            'wiki_page' => 'wiki',
        ],

        'team' => [
            'more_simple' => '',
        ],

        'user' => [
            'login_required' => 'Inicia sesión para buscar usuarios',
            'more' => ':count jugadores más coinciden con la búsqueda',
            'more_simple' => 'Ver más resultados de jugadores',
            'more_hidden' => 'La búsqueda de jugadores está limitada a :max jugadores. Intenta refinar tus términos de búsqueda.',
            'title' => 'Jugadores',
        ],

        'wiki_page' => [
            'link' => 'Buscar en la wiki',
            'more_simple' => 'Ver más resultados de la wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'action' => 'Descargar osu!',
        'action_lazer' => 'Descargar osu!(lazer)',
        'action_lazer_description' => 'la próxima gran actualización de osu!',
        'action_lazer_info' => 'revisa esta página para más información',
        'action_lazer_title' => 'probar osu!(lazer)',
        'action_title' => 'descargar osu!',
        'for_os' => 'para :os',
        'macos-fallback' => 'usuarios de macOS',
        'mirror' => 'enlace alternativo',
        'or' => 'o',
        'os_version_or_later' => ':os_version o posterior',
        'other_os' => 'otras plataformas',
        'quick_start_guide' => 'guía de inicio rápido',
        'tagline' => "¡vamos a<br>empezar!",
        'video-guide' => 'guía en video',

        'help' => [
            '_' => 'si tienes problemas al iniciar el juego o al crear una cuenta, :help_forum_link o :support_button.',
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
                'title' => 'crear una cuenta',
                'description' => 'sigue las instrucciones al iniciar el juego para iniciar sesión o crear una cuenta nueva',
            ],
            'download' => [
                'title' => 'instalar el juego',
                'description' => '¡haz clic en el botón de arriba para descargar el instalador y luego poder ejecutarlo!',
            ],
            'beatmaps' => [
                'title' => 'obtener mapas',
                'description' => [
                    '_' => '¡:browse por la amplia biblioteca de mapas creados por los usuarios y empieza a jugar!',
                    'browse' => 'navega',
                ],
            ],
        ],
    ],

    'user' => [
        'title' => 'panel',
        'news' => [
            'title' => 'Novedades',
            'error' => 'Error al cargar las novedades, intenta actualizar la página...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Amigos en línea',
                'games' => 'Partidas',
                'online' => 'Usuarios en línea',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nuevos mapas clasificados',
            'popular' => 'Mapas populares',
            'by_user' => 'por :user',
        ],
        'buttons' => [
            'download' => 'Descargar osu!',
            'support' => 'Apoyar a osu!',
            'store' => 'osu!store',
        ],
    ],
];
