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
    'defaults' => [
        'page_description' => 'osu! - El ritmo está a solo un *clic* de distancia! Con Ouendan/EBA, Taiko y modos de juego originales, así como un editor de niveles totalmente funcional.',
    ],

    'menu' => [
        'home' => [
            '_' => 'inicio',
            'account-edit' => 'ajustes',
            'friends-index' => 'amigos',
            'changelog-index' => 'lista de Cambios',
            'changelog-build' => 'compilación',
            'getDownload' => 'descargar',
            'getIcons' => 'iconos',
            'groups-show' => 'grupos',
            'index' => 'panel',
            'legal-show' => 'información',
            'news-index' => 'noticias',
            'news-show' => 'noticias',
            'password-reset-index' => 'reestablecer contraseña',
            'search' => 'buscar',
            'supportTheGame' => 'apoya el juego',
            'team' => 'equipo',
        ],
        'help' => [
            '_' => 'ayuda',
            'getFaq' => 'preguntas frecuentes',
            'getRules' => 'reglas',
            'getSupport' => 'no, en serio, ¡necesito ayuda!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'artistas destacados',
            'beatmap_discussion_posts-index' => 'publicaciones de discusión del beatmap',
            'beatmap_discussions-index' => 'discusiones del beatmap',
            'beatmapset-watches-index' => 'lista de seguimiento del modding',
            'beatmapset_discussion_votes-index' => 'votos de la discusión del beatmap',
            'beatmapset_events-index' => 'eventos del beatmap',
            'index' => 'listado',
            'packs' => 'paquetes',
            'show' => 'información',
        ],
        'beatmapsets' => [
            '_' => 'beatmapsets',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'rankings',
            'index' => 'rendimiento',
            'performance' => 'rendimiento',
            'charts' => 'charts',
            'score' => 'puntuación',
            'country' => 'país',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'comunidad',
            'dev' => 'desarrollo',
            'getForum' => 'foros',
            'getChat' => 'chat',
            'getLive' => 'en vivo',
            'contests' => 'concursos',
            'profile' => 'perfil',
            'tournaments' => 'torneos',
            'tournaments-index' => 'torneos',
            'tournaments-show' => 'información de torneos',
            'forum-topic-watches-index' => 'suscripciones',
            'forum-topics-create' => 'foros',
            'forum-topics-show' => 'foros',
            'forum-forums-index' => 'foros',
            'forum-forums-show' => 'foros',
        ],
        'multiplayer' => [
            '_' => 'multijugador',
            'show' => 'partida',
        ],
        'error' => [
            '_' => 'error',
            '404' => 'no encontrado',
            '403' => 'prohibido',
            '401' => 'no autorizado',
            '405' => 'página faltante',
            '500' => 'algo se rompió',
            '503' => 'mantenimiento',
        ],
        'user' => [
            '_' => 'usuario',
            'getLogin' => 'iniciar sesión',
            'disabled' => 'desactivado',

            'register' => 'registrarse',
            'reset' => 'recuperar',
            'new' => 'nuevo',

            'messages' => 'Mensajes',
            'settings' => 'Ajustes',
            'logout' => 'Cerrar sesión',
            'help' => 'Ayuda',
            'modding-history-discussions' => 'discusiones sobre modding',
            'modding-history-events' => 'eventos sobre modding',
            'modding-history-index' => 'historial de moddding del usuario',
            'modding-history-posts' => 'publicaciones de modding del usuario',
            'modding-history-votesGiven' => 'votos dados sobre modding del usuario',
            'modding-history-votesReceived' => 'votos recibidos sobre modding del usuario',
        ],
        'store' => [
            '_' => 'tienda',
            'checkout-show' => 'caja',
            'getListing' => 'listado',
            'cart-show' => 'carrito',

            'getCheckout' => 'caja',
            'getInvoice' => 'factura',
            'products-show' => 'producto',

            'new' => 'nuevo',
            'home' => 'inicio',
            'index' => 'inicio',
            'thanks' => 'gracias',
        ],
        'admin-forum' => [
            '_' => 'administrador::foro',
            'forum-covers-index' => 'portadas del foro',
        ],
        'admin-store' => [
            '_' => 'administrador::tienda',
            'orders-index' => 'órdenes',
            'orders-show' => 'órden',
        ],
        'admin' => [
            '_' => 'administrador',
            'beatmapsets-covers' => 'portadas de los beatmap',
            'logs-index' => 'registro',
            'root' => 'índice',

            'beatmapsets' => [
                '_' => 'sets de beatmaps',
                'show' => 'detalles',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'General',
            'home' => 'Inicio',
            'changelog-index' => 'Lista de Cambios',
            'beatmaps' => 'Lista de Beatmaps',
            'download' => 'Descargar osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Ayuda y Comunidad',
            'faq' => 'Preguntas Frecuentes',
            'forum' => 'Foros de la Comunidad',
            'livestreams' => 'Transmisiones en vivo',
            'report' => 'Reportar un Error',
        ],
        'legal' => [
            '_' => 'Estatus Legal',
            'copyright' => 'Derechos de autor (DMCA)',
            'privacy' => 'Privacidad',
            'server_status' => 'Estado del Servidor',
            'source_code' => 'Código Fuente',
            'terms' => 'Términos de Servicio',
        ],
    ],

    'errors' => [
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
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "¡Por si acaso, aquí tienes un código que le puedes dar al soporte técnico!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'correo electrónico',
            'forgot' => "He olvidado mis datos",
            'password' => 'contraseña',
            'title' => 'Iniciar sesión para continuar',

            'error' => [
                'email' => "El nombre de usuario o correo electrónico no existe",
                'password' => 'Contraseña incorrecta',
            ],
        ],

        'register' => [
            'info' => "Necesita una cuenta, señor. ¿Por qué aún no tiene una?",
            'title' => "¿No tienes una cuenta?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Ajustes',
            'friends' => 'Amigos',
            'logout' => 'Cerrar sesión',
            'profile' => 'Mi perfil',
        ],
    ],

    'popup_search' => [
        'initial' => '¡Escribe para buscar!',
        'retry' => 'Búsqueda fallida. Haz clic aquí para reintentar.',
    ],
];
