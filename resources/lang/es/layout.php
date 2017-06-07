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
    'defaults' => [
        'page_description' => 'osu! - ¡El ritmo está a solo un *clic* de distancia!  Con Ouendan/EBA, Taiko y modos de juego originales, así como un editor de niveles totalmente funcional.',
    ],

    'menu' => [
        'home' => [
            '_' => 'inicio',
            'account-edit' => 'ajustes',
            'getChangelog' => 'listado de cambios',
            'getDownload' => 'descargar',
            'getIcons' => 'iconos',
            'getNews' => 'novedades',
            'index' => 'osu!',
            'supportTheGame' => 'apoya el juego',
            'password-reset-index' => 'reestablecer contraseña',
        ],
        'help' => [
            '_' => 'ayuda',
            'getFaq' => 'preguntas frecuentes',
            'getSupport' => 'soporte',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'show' => 'información',
            'index' => 'listado',
            'artists' => 'artistas destacados',
            // 'getPacks' => 'packs',
            // 'getCharts' => 'charts',
        ],
        'beatmapsets' => [
            '_' => 'beatmapsets',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'rankings',
            'charts' => 'charts',
        ],
        'community' => [
            '_' => 'comunidad',
            'dev' => 'osu!dev',
            'getForum' => 'foro',
            'getChat' => 'chat',
            'getSupport' => 'soporte',
            'getLive' => 'live',
            'contests' => 'concursos',
            'profile' => 'perfil',
            'tournaments' => 'torneos',
            'tournaments-index' => 'torneos',
            'tournaments-show' => 'información de torneos',
            'forum-topic-watches-index' => 'suscripciones',
            'forum-topics-create' => 'foro',
            'forum-topics-show' => 'foro',
            'forum-forums-index' => 'foro',
            'forum-forums-show' => 'foro',
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
            'show' => 'match',
        ],
        'error' => [
            '_' => 'error',
            '404' => 'no encontrado',
            '403' => 'prohibido',
            '401' => 'no autorizado',
            '405' => 'no encontrado',
            '500' => 'algo va mal',
            '503' => 'mantenimiento',
        ],
        'user' => [
            '_' => 'usuario',
            'getLogin' => 'iniciar sesión',
            'disabled' => 'desactivado',

            'register' => 'registrarse',
            'reset' => 'reiniciar',
            'new' => 'nuevo',

            'messages' => 'Mensajes',
            'settings' => 'Opciones',
            'logout' => 'Salir',
            'help' => 'Ayuda',
        ],
        'store' => [
            '_' => 'tienda',
            'getListing' => 'listado',
            'getCart' => 'carro',

            'getCheckout' => 'caja',
            'getInvoice' => 'factura',
            'getProduct' => 'producto',

            'new' => 'nuevo',
            'home' => 'inicio',
            'index' => 'inicio',
            'thanks' => 'gracias',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'portadas del foro',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'órdenes',
            'orders-show' => 'órdenes',
        ],
        'admin' => [
            '_' => 'admin',
            'root' => 'índice',
            'logs-index' => 'registro',
            'beatmapsets' => [
                '_' => 'beatmapsets',
                'covers' => 'portadas',
                'show' => 'detalles',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'General',
            'home' => 'Inicio',
            'changelog' => 'Listado de Cambios',
            'beatmaps' => 'Lista de Beatmaps',
            'download' => 'Descarga osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Ayuda y Comunidad',
            'faq' => 'Preguntas Frecuentes',
            'forum' => 'Foros de la Comunidad',
            'livestreams' => 'Transmisiones en vivo',
            'report' => 'Reportar un Error',
        ],
        'support' => [
            '_' => 'Apoyar osu!',
            'tags' => 'Supporter',
            'merchandise' => 'Mercancías',
        ],
        'legal' => [
            '_' => 'Estatus Legal',
            'copyright' => 'Copyright (DMCA)',
            'osu_status' => '@osustatus',
            'server_status' => 'Estado del Servidor',
            'terms' => 'Términos de Servicio',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Página no encontrada',
            'description' => '¡Lo sentimos, la página que has solicitado no está aquí!',
            'link' => false,
        ],
        '403' => [
            'error' => 'No deberías estar aquí.',
            'description' => 'Aunque podrías intentar volver atrás.',
            'link' => false,
        ],
        '401' => [
            'error' => 'No deberías estar aquí.',
            'description' => 'Aunque podrías intentar volver atrás. O iniciar sesión.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Página no encontrada',
            'description' => '¡Lo sentimos, la página que has solicitado no está aquí!',
            'link' => false,
        ],
        '500' => [
            'error' => '¡Oh no! ¡Algo se ha roto! ;_;',
            'description' => 'Hemos sido notificados del error.',
            'link' => false,
        ],
        'fatal' => [
            'error' => '¡Oh no! ¡Algo se ha roto (gravemente)! ;_;',
            'description' => 'Hemos sido notificados del error.',
            'link' => false,
        ],
        '503' => [
            'error' => '¡En mantenimiento!',
            'description' => 'El mantenimiento normalmente tarda entre 5 segundos y 10 minutos. Si continúa pasado ese tiempo, haz clic en :link para más información.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => '¡Por si acaso, aquí tienes un código que puedes dar a soporte técnico!',
    ],

    'popup_login' => [
        'login' => [
            'email' => 'correo electrónico',
            'forgot' => 'He olvidado mis datos',
            'password' => 'contraseña',
            'title' => 'Regístrate para continuar',

            'error' => [
                'email' => 'El nombre de usuario o correo electrónico no existe',
                'password' => 'Contraseña incorrecta',
            ],
        ],

        'register' => [
            'info' => 'Necesitas una cuenta, amigo. ¿Por qué aún no tienes una?',
            'title' => '¿No tienes una cuenta?',
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Ajustes',
            'logout' => 'Cerrar sesión',
            'profile' => 'Mi perfil',
        ],
    ],

    'popup_search' => [
        'initial' => '¡Escribe para buscar!',
    ],
];
