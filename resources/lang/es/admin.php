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

    'beatmapsets' => [
        'covers' => [
            'regenerate' => 'Regenerar',
            'regenerating' => 'Regenerando...',
            'remove' => 'Eliminar',
            'removing' => 'Eliminando...',
        ],
        'show' => [
            'covers' => 'Administrar Portadas de los Beatmap',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'activar',
                'activate_confirm' => '¿activar modding v2 para este beatmap?',
                'active' => 'activo',
                'inactive' => 'inactivo',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Eliminar',

                'forum-name' => 'Foro #:id: :name',

                'no-cover' => 'Portada no definida',

                'submit' => [
                    'save' => 'Guardar',
                    'update' => 'Actualizar',
                ],

                'title' => 'Lista de portadas',

                'type-title' => [
                    'default-topic' => 'Portada del tema por defecto',
                    'main' => 'Portada de foro',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Observador de Registro',
        ],
    ],

    'pages' => [
        'root' => [
            'title' => 'Consola de Administración',

            'sections' => [
                'forum' => 'Foro',
                'general' => 'General',
                'store' => 'Tienda',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Listado de Pedidos',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Este usuario está actualmente restringido.',
            'message' => '(solo los administradores pueden ver esto)',
        ],
    ],

];
