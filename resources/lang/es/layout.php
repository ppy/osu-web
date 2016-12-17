<?php
/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'page_description' => 'osu! - ¡El ritmo está a solo un *clic* de distancia!  Con Ouendan/EBA, Taiko y modos de juego originales, así como un editor de niveles totalmente funcional.'
    ],
    'menu' => [
        'home' => [
            '_' => 'inicio',
            'getChangelog' => 'listado de cambios',
            'getDownload' => 'descargar',
            'getIcons' => 'iconos',
            'getNews' => 'novedades',
            'supportTheGame' => 'apoya el juego'
        ],
        'help' => [
            '_' => 'ayuda',
            'getWiki' => 'wiki',
            'getFaq' => 'preguntas frecuentes',
            'getSupport' => 'soporte'
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'show' => 'información',
            'index' => 'listado'
        ],
        'beatmapsets' => [
            '_' => 'beatmapsets',
            'discussion' => 'modding'
        ],
        'ranking' => [
            '_' => 'ranking',
            'getOverall' => 'global',
            'getCountry' => 'nacional',
            'getCharts' => 'charts',
            'getMapper' => 'mapper',
            'index' => 'global'
        ],
        'community' => [
            '_' => 'comunidad',
            'getForum' => 'foro',
            'getChat' => 'chat',
            'getSupport' => 'soporte',
            'getLive' => 'live',
            'getSlack' => 'osu!dev',
            'profile' => 'perfil',
            'tournaments' => 'torneos',
            'tournaments-index' => 'torneos',
            'tournaments-show' => 'información de torneos',
            'forum-topics-create' => 'foro',
            'forum-topics-show' => 'foro',
            'forum-forums-index' => 'foro',
            'forum-forums-show' => 'foro'
        ],
        'error' => [
            '_' => 'error',
            404 => 'no encontrado',
            403 => 'prohibido',
            401 => 'no autorizado',
            405 => 'no encontrado',
            500 => 'algo va mal',
            503 => 'mantenimiento'
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
            'help' => 'Ayuda'
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
            'thanks' => 'gracias'
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'portadas del foro'
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'órdenes',
            'orders-show' => 'órdenes'
        ],
        'admin' => [
            '_' => 'admin',
            'logs-index' => 'registro',
            'beatmapsets' => [
                '_' => 'beatmapsets',
                'covers' => 'portadas',
                'show' => 'detalles'
            ]
        ]
    ],
    'errors' => [
        404 => [
            'error' => 'Página no encontrada',
            'description' => '¡Lo sentimos, la página que has solicitado no está aquí!',
            'link' => ''
        ],
        403 => [
            'error' => 'No deberías estar aquí.',
            'description' => 'Aunque podrías intentar volver atrás.',
            'link' => ''
        ],
        401 => [
            'error' => 'No deberías estar aquí.',
            'description' => 'Aunque podrías intentar volver atrás, o iniciar sesión.',
            'link' => ''
        ],
        405 => [
            'error' => 'Página no encontrada',
            'description' => '¡Lo sentimos, la página que has solicitado no está aquí!',
            'link' => ''
        ],
        500 => [
            'error' => '¡Oh no! ¡Algo se ha roto! ;_;',
            'description' => 'Hemos sido notificados automáticamente del error.',
            'link' => ''
        ],
        'fatal' => [
            'error' => '¡Oh no! ¡Algo se ha roto (gravemente)! ;_;',
            'description' => 'Hemos sido notificados automáticamente del error.',
            'link' => ''
        ],
        503 => [
            'error' => '¡En mantenimiento!',
            'description' => 'El mantenimiento normalmente tarda entre 5 segundos y 10 minutos. Si sigue pasado ese tiempo, haz clic en :link para más información.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus'
            ]
        ],
        'reference' => '¡Por si acaso, aquí tienes un código que puedes dar a soporte técnico!'
    ]
];
