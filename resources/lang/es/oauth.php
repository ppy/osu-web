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
    'cancel' => 'Cancelar',

    'authorise' => [
        'request' => 'está pidiendo permiso para entrar en tu cuenta.',
        'scopes_title' => 'Esta aplicación podrá:',
        'title' => 'Solicitud de autorización',
    ],

    'authorized_clients' => [
        'confirm_revoke' => '¿Estás seguro que deseas revocar los permisos de este cliente?',
        'scopes_title' => 'Esta aplicación puede:',
        'owned_by' => 'Propiedad de :user',
        'none' => 'No hay clientes',

        'revoked' => [
            'false' => 'Revocar Acceso',
            'true' => 'Acceso revocado',
        ],
    ],

    'client' => [
        'id' => 'ID cliente',
        'name' => 'Nombre de Aplicación',
        'redirect' => 'URL de llamada de Aplicación',
        'secret' => 'Secreto del Cliente',
    ],

    'new_client' => [
        'header' => 'Registre una nueva aplicación OAuth',
        'register' => 'Registro de aplicación',
        'terms_of_use' => [
            '_' => 'Al usar la API, usted acepta los :link.',
            'link' => 'Términos de Uso',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => '¿Está seguro que desea eliminar este cliente?',
        'new' => 'Nueva aplicación OAuth',
        'none' => 'Sin Clientes',

        'revoked' => [
            'false' => 'Eliminar',
            'true' => 'Eliminado',
        ],
    ],
];
