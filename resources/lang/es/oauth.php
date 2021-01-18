<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Cancelar',

    'authorise' => [
        'request' => 'está solicitando permiso para acceder a su cuenta.',
        'scopes_title' => 'Esta aplicación podrá:',
        'title' => 'Solicitud de autorización',
    ],

    'authorized_clients' => [
        'confirm_revoke' => '¿Seguro que desea revocar los permisos de este cliente?',
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
        'reset' => 'Restablecer secreto de cliente',
        'reset_failed' => 'No se pudo restablecer el secreto de cliente',
        'secret' => 'Secreto de cliente',

        'secret_visible' => [
            'false' => 'Mostrar secreto de cliente',
            'true' => 'Ocultar secreto de cliente',
        ],
    ],

    'new_client' => [
        'header' => 'Registre una nueva aplicación OAuth',
        'register' => 'Registro de aplicación',
        'terms_of_use' => [
            '_' => 'Al usar la API, usted acepta los :link.',
            'link' => 'términos de uso',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => '¿Seguro que desea eliminar este cliente?',
        'confirm_reset' => '¿Seguro que desea restablecer el secreto de cliente? Esto revocará todos los tokens existentes.',
        'new' => 'Nueva aplicación OAuth',
        'none' => 'No hay clientes',

        'revoked' => [
            'false' => 'Eliminar',
            'true' => 'Eliminado',
        ],
    ],
];
