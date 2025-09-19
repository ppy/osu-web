<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Reproducir la siguiente pista automáticamente',
    ],

    'defaults' => [
        'page_description' => 'osu! - ¡El ritmo está a un solo *clic* de distancia! Con Ouendan/EBA, Taiko y modos de juego originales, así como un editor de niveles totalmente funcional.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'conjunto de mapas',
            'beatmapset_covers' => 'portadas del conjunto de mapas',
            'contest' => 'concurso',
            'contests' => 'concursos',
            'root' => 'consola',
        ],

        'artists' => [
            'index' => 'listado',
        ],

        'beatmapsets' => [
            'show' => 'información',
            'discussions' => 'discusión',
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
            'playlists' => 'listas de juego',
            'realtime' => 'multijugador',
            'show' => 'información',
        ],
    ],

    'gallery' => [
        'close' => 'Cerrar (Esc)',
        'fullscreen' => 'Activar/desactivar pantalla completa',
        'zoom' => 'Acercar/alejar',
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
            'getAbuse' => 'reportar abuso',
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
        ],
        'store' => [
            '_' => 'tienda',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'General',
            'home' => 'Inicio',
            'changelog-index' => 'Registro de cambios',
            'beatmaps' => 'Lista de mapas',
            'download' => 'Descargar osu!',
        ],
        'help' => [
            '_' => 'Ayuda y comunidad',
            'faq' => 'Preguntas frecuentes',
            'forum' => 'Foros de la comunidad',
            'livestreams' => 'Transmisiones en vivo',
            'report' => 'Reportar un problema',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Legal y estado',
            'copyright' => 'Derechos de autor (DMCA)',
            'jp_sctl' => '',
            'privacy' => 'Privacidad',
            'rules' => 'Reglas',
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
            'description' => 'Aunque podrías intentar volver atrás. O tal vez iniciar sesión.',
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
            'description' => "Se nos notifica automáticamente de cada error.",
        ],
        'fatal' => [
            'error' => '¡Oh no! ¡Algo se ha roto (gravemente)! ;_;',
            'description' => "Se nos notifica automáticamente de cada error.",
        ],
        '503' => [
            'error' => '¡Fuera de servicio por mantenimiento!',
            'description' => "El mantenimiento suele durar entre 5 segundos y 10 minutos. Si permanecemos fuera de servicio durante más tiempo, consulta :link para obtener más información.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Por si acaso, ¡aquí tienes un código que le puedes dar al soporte técnico!",
    ],

    'popup_login' => [
        'button' => 'iniciar sesión / registrarme',

        'login' => [
            'forgot' => "He olvidado mis datos",
            'password' => 'contraseña',
            'title' => 'Inicia sesión para continuar',
            'username' => 'nombre de usuario',

            'error' => [
                'email' => "El nombre de usuario o la dirección de correo electrónico no existen",
                'password' => 'Contraseña incorrecta',
            ],
        ],

        'register' => [
            'download' => 'Descargar',
            'info' => '¡Descarga osu! para crear tu propia cuenta!',
            'title' => "¿No tienes una cuenta?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Configuración',
            'follows' => 'Listas de seguimiento',
            'friends' => 'Amigos',
            'legacy_score_only_toggle' => 'Modo lazer',
            'legacy_score_only_toggle_tooltip' => 'El modo lazer muestra las puntuaciones establecidas desde lazer con un nuevo algoritmo de puntuación',
            'logout' => 'Cerrar sesión',
            'profile' => 'Mi perfil',
            'scoring_mode_toggle' => 'Puntuación clásica',
            'scoring_mode_toggle_tooltip' => 'Ajusta los valores de las puntuaciones para que se parezcan más a las puntuaciones clásicas sin límite',
            'team' => 'Mi equipo',
        ],
    ],

    'popup_search' => [
        'initial' => '¡Escribe para buscar!',
        'retry' => 'Búsqueda fallida. Haz clic aquí para reintentar.',
    ],
];
