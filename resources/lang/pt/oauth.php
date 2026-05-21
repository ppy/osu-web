<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Cancelar',

    'authorise' => [
        'app_owner' => 'uma aplicação de :owner',
        'request' => 'está a solicitar permissão para aceder à sua conta.',
        'scopes_title' => 'Esta aplicação será capaz de:',
        'title' => 'Pedido de autorização',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Tem a certeza de que deseja revogar as permissões deste cliente?',
        'scopes_title' => 'Esta aplicação pode:',
        'owned_by' => 'Pertencente a :user',
        'none' => 'Sem clientes',

        'revoked' => [
            'false' => 'Revogar acesso',
            'true' => 'Acesso revogado',
        ],
    ],

    'client' => [
        'id' => 'ID do cliente',
        'name' => 'Nome da aplicação',
        'redirect' => 'URLs de retorno da aplicação',
        'reset' => 'Repor a chave secreta do cliente',
        'reset_failed' => 'Falha ao repor a chave secreta do cliente',
        'secret' => 'Chave secreta do cliente',

        'secret_visible' => [
            'false' => 'Mostrar a chave secreta do cliente',
            'true' => 'Ocultar a chave secreta do cliente',
        ],
    ],

    'new_client' => [
        'header' => 'Registar uma nova aplicação OAuth',
        'register' => 'Registar aplicação',
        'terms_of_use' => [
            '_' => 'Ao usar a API, está a concordar com o que está em :link.',
            'link' => 'Termos de uso',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Tem a certeza que quer eliminar este cliente?',
        'confirm_reset' => 'Tem a certeza que deseja redefinir a chave secreta do cliente? Isto irá revogar todos os tokens existentes.',
        'new' => 'Nova aplicação OAuth',
        'none' => 'Sem clientes',

        'revoked' => [
            'false' => 'Eliminar',
            'true' => 'Eliminados',
        ],
    ],
];
