<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Cancelar',

    'authorise' => [
        'app_owner' => 'una aplicación de :owner',
        'request' => 'está solicitando permiso para acceder a tu cuenta.',
        'scopes_title' => 'Esta aplicación podrá:',
        'title' => 'Solicitud de autorización',
    ],

    'authorized_clients' => [
        'confirm_revoke' => '¿Seguro que deseas revocar los permisos de este cliente?',
        'scopes_title' => 'Esta aplicación puede:',
        'owned_by' => 'Propiedad de :user',
        'none' => 'No hay clientes',

        'revoked' => [
            'false' => 'Revocar acceso',
            'true' => 'Acceso revocado',
        ],
    ],

    'client' => [
        'id' => 'ID del cliente',
        'name' => 'Nombre de la aplicación',
        'redirect' => 'URL de llamada de la aplicación',
        'reset' => 'Restablecer cliente secreto',
        'reset_failed' => 'No se pudo restablecer el cliente secreto',
        'secret' => 'Cliente secreto',

        'secret_visible' => [
            'false' => 'Mostrar cliente secreto',
            'true' => 'Ocultar cliente secreto',
        ],
    ],

    'new_client' => [
        'header' => 'Registra una nueva aplicación OAuth',
        'register' => 'Registrar la aplicación',
        'terms_of_use' => [
            '_' => 'Al usar la API, aceptas los :link.',
            'link' => 'términos de uso',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => '¿Seguro que deseas eliminar este cliente?',
        'confirm_reset' => '¿Seguro que deseas restablecer el cliente secreto? Esto revocará todos los tokens existentes.',
        'new' => 'Nueva aplicación OAuth',
        'none' => 'No hay clientes',

        'revoked' => [
            'false' => 'Eliminar',
            'true' => 'Eliminado',
        ],
    ],
];
