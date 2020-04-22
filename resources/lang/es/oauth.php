<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'reset' => '',
        'reset_failed' => '',
        'secret' => 'Secreto del Cliente',

        'secret_visible' => [
            'false' => '',
            'true' => '',
        ],
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
        'confirm_reset' => '',
        'new' => 'Nueva aplicación OAuth',
        'none' => 'No hay clientes',

        'revoked' => [
            'false' => 'Eliminar',
            'true' => 'Eliminado',
        ],
    ],
];
