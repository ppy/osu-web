<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Cancelar',

    'authorise' => [
        'request' => 'está a solicitar permissão para aceder à tua conta.',
        'scopes_title' => 'Esta aplicação será capaz de:',
        'title' => 'Pedido de autorização',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Tens a certeza de que desejas revogar as permissões deste cliente?',
        'scopes_title' => 'Esta aplicação pode:',
        'owned_by' => 'Proprietário de :user',
        'none' => 'Sem clientes',

        'revoked' => [
            'false' => 'Revogar acesso',
            'true' => 'Acesso revogado',
        ],
    ],

    'client' => [
        'id' => 'ID do cliente',
        'name' => 'Nome da aplicação',
        'redirect' => 'URL da recolha da aplicação',
        'reset' => 'Redefinir o segredo do cliente',
        'reset_failed' => 'Falha ao redefinir o segredo do cliente',
        'secret' => 'Segredo do cliente',

        'secret_visible' => [
            'false' => 'Mostrar o segredo do cliente',
            'true' => 'Ocultar o segredo do cliente',
        ],
    ],

    'new_client' => [
        'header' => 'Registar uma nova aplicação OAuth',
        'register' => 'Aplicação de registo',
        'terms_of_use' => [
            '_' => 'Ao usares a API, estás a aceitar o que está neste :link.',
            'link' => 'Termos de uso',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Tens a certeza que queres eliminar este cliente?',
        'confirm_reset' => 'Tens a certeza que desejas redefinir o segredo do cliente? Isto irá revogar todos os tokens existentes.',
        'new' => 'Nova aplicação OAuth',
        'none' => 'Sem clientes',

        'revoked' => [
            'false' => 'Eliminar',
            'true' => 'Eliminados',
        ],
    ],
];
