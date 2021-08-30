<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Reproducir la siguiente pista automáticamente',
    ],

    'defaults' => [
        'page_description' => 'osu! - ¡El ritmo está a solo un *clic* de distancia! Con Ouendan/EBA, Taiko y modos de juego originales, así como un editor de niveles totalmente funcional.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'set de mapas',
            'beatmapset_covers' => 'portadas del set de mapas',
            'contest' => 'concurso',
            'contests' => 'concursos',
            'root' => 'consola',
            'store_orders' => 'administrador de tienda',
        ],

        'artists' => [
            'index' => 'listado',
        ],

        'changelog' => [
            'index' => 'listado',
        ],

        'help' => [
            'index' => 'índice',
            'sitemap' => 'Mapa del sitio',
        ],

        'store' => [
            'cart' => 'carrito',
            'orders' => 'historial de pedidos',
            'products' => 'productos',
        ],

        'tournaments' => [
            'index' => 'listado',
        ],

        'users' => [
            'modding' => 'modding',
            'multiplayer' => 'multijugador',
            'show' => 'información',
        ],
    ],

    'gallery' => [
        'close' => 'Cerrar (Esc)',
        'fullscreen' => 'Activar/Desactivar pantalla completa',
        'zoom' => 'Zoom Acercar/Alejar',
        'previous' => 'Anterior (flecha izquierda)',
        'next' => 'Siguiente (flecha derecha)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'mapas',
        ],
        'community' => [
            '_' => 'comunidad',
            'dev' => 'desarrollo',
        ],
        'help' => [
            '_' => 'ayuda',
            'getAbuse' => 'notificar abuso',
            'getFaq' => 'preguntas frecuentes',
            'getRules' => 'reglas',
            'getSupport' => 'no, en serio, ¡necesito ayuda!',
        ],
        'home' => [
            '_' => 'inicio',
            'team' => 'equipo',
        ],
        'rankings' => [
            '_' => 'clasificaciones',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'tienda',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'General',
            'home' => 'Inicio',
            'changelog-index' => 'Lista de cambios',
            'beatmaps' => 'Lista de mapas',
            'download' => 'Descargar osu!',
        ],
        'help' => [
            '_' => 'Ayuda y comunidad',
            'faq' => 'Preguntas frecuentes',
            'forum' => 'Foros de la comunidad',
            'livestreams' => 'Transmisiones en vivo',
            'report' => 'Informar de un problema',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Legal y estado',
            'copyright' => 'Derechos de autor (DMCA)',
            'privacy' => 'Privacidad',
            'server_status' => 'Estado del servidor',
            'source_code' => 'Código fuente',
            'terms' => 'Términos',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Parámetro de solicitud no válido',
            'description' => '',
        ],
        '404' => [
            'error' => 'Página no encontrada',
            'description' => "¡Lo sentimos, la página que has solicitado no está aquí!",
        ],
        '403' => [
            'error' => "No deberías estar aquí.",
            'description' => 'Aunque podrías intentar volver atrás.',
        ],
        '401' => [
            'error' => "No deberías estar aquí.",
            'description' => 'Aunque podrías intentar volver atrás. O quizá iniciar sesión.',
        ],
        '405' => [
            'error' => 'Página no encontrada',
            'description' => "¡Lo sentimos, la página que has solicitado no está aquí!",
        ],
        '422' => [
            'error' => 'Parámetro de solicitud no válido',
            'description' => '',
        ],
        '429' => [
            'error' => 'Se ha superado el límite de frecuencia',
            'description' => '',
        ],
        '500' => [
            'error' => '¡Oh no! ¡Algo se ha roto! ;_;',
            'description' => "Somos notificados automáticamente de cada error.",
        ],
        'fatal' => [
            'error' => '¡Oh no! ¡Algo se ha roto (gravemente)! ;_;',
            'description' => "Somos notificados automáticamente de cada error.",
        ],
        '503' => [
            'error' => '¡Fuera de servicio por mantenimiento!',
            'description' => "El mantenimiento normalmente tarda entre 5 segundos y 10 minutos. Si continúa pasado ese tiempo, ve :link para más información.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "¡Por si acaso, aquí tienes un código que le puedes dar al soporte técnico!",
    ],

    'popup_login' => [
        'button' => 'iniciar sesión / registrarse',

        'login' => [
            'forgot' => "He olvidado mis datos",
            'password' => 'contraseña',
            'title' => 'Iniciar sesión para continuar',
            'username' => 'nombre de usuario',

            'error' => [
                'email' => "El nombre de usuario o correo electrónico no existe",
                'password' => 'Contraseña incorrecta',
            ],
        ],

        'register' => [
            'download' => 'Descargar',
            'info' => '¡Descargue osu! para crear su propia cuenta!',
            'title' => "¿No tienes una cuenta?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Configuración',
            'follows' => 'Listas de seguimiento',
            'friends' => 'Amigos',
            'logout' => 'Cerrar sesión',
            'profile' => 'Mi perfil',
        ],
    ],

    'popup_search' => [
        'initial' => '¡Escriba para buscar!',
        'retry' => 'Búsqueda fallida. Haz clic aquí para reintentar.',
    ],
];
